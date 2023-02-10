<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    // 都道府県APIに接続
    private function fetchPrefs()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => 'Yu9YCuZxdIoA8arkpaoUhZDxyfb0RzzyhbP8S4Ye',
        ])->get('https://opendata.resas-portal.go.jp/api/v1/prefectures');
        return $response->json($key = 'result');
    }

    // 都道府県名を都道府県コードに変換
    private function convertPrefnameToPrefCode(string $prefName)
    {
        return current(array_filter($this->fetchPrefs(), fn($pref): bool => $pref['prefName'] == $prefName))['prefCode'];
    }

    // 市区町村APIに接続
    public function searchCities(Request $request)
    {
        $prefCode = $this->convertPrefnameToPrefCode($request->prefName);
        $response = Http::withHeaders([
            'X-API-KEY' => 'Yu9YCuZxdIoA8arkpaoUhZDxyfb0RzzyhbP8S4Ye',
        ])->get('https://opendata.resas-portal.go.jp/api/v1/cities');

        // 都道府県コードを元に必要な市区町村のみをフィルタリングする
        return array_map(
            fn($city): string => $city['cityName'],
            array_values(
                array_filter(
                    $response->json($key = 'result'),
                    fn($city): bool => $city['prefCode'] == $prefCode
                )
            )
        );
    }

    // クエリビルダの作成
    private function addWhere(&$restaurantsQueryBuilder, $param_content, $column)
    {
        if (!is_null($param_content)) {
            if (is_null($restaurantsQueryBuilder)) {
                $restaurantsQueryBuilder =
                is_array($param_content)
                ? Restaurant::whereIn($column, $param_content)
                : Restaurant::where($column, $param_content);
            } else {
                is_array($param_content)
                ? $restaurantsQueryBuilder->whereIn($column, $param_content)
                : $restaurantsQueryBuilder->where($column, $param_content);
            }
        }
    }

    // 検索処理
    public function search(Request $request)
    {
        $prefs = $this->fetchPrefs();
        $genres = config('genre');

        $restaurantsQueryBuilder = null;
        $this->addWhere($restaurantsQueryBuilder, $request->pref, 'pref');
        $this->addWhere($restaurantsQueryBuilder, $request->municipalities, 'municipalities');
        $this->addWhere($restaurantsQueryBuilder, $request->genre, 'genre');

        $restaurants = is_null($restaurantsQueryBuilder) ? Restaurant::all() : $restaurantsQueryBuilder->get();

        return view('service_search',
            [
                'date' => $request->date,
                'time' => $request->time,
                'counts' => $request->counts,
                'prefs' => $prefs,
                'genres' => $genres,
                'restaurants' => $restaurants,
            ],
        );
    }

}
