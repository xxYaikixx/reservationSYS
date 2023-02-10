<?php

namespace Database\Factories;

use app\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'family_name' => '姓のテスト',
            'last_name' => '名のテスト',
            'tel' => '0312345678',
            'mail' => 'test123@testaddress.com',
            // passwordにHash::make('Password012')を代入
            'password' => '$2y$10$M754DQ7ABarIFpJMPRFNP.mI9ZbqBg/zZTlf31p2e4Nkz5UGEFRgK',
        ];
    }
}
