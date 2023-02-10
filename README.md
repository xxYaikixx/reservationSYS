# 開始手順

### 依存関係のInstall

```
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### sailコマンドalias設定

ローカルのシェルの種類によって、変更する。
この処理を実行しない場合は、以降のsailコマンドを``` $ ./vendor/bin/sail ```に読み替える

bashの場合
```bash
$ echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.bashrc
$ source ~/.bashrc
```

zshの場合
```zsh
$ echo "alias sail='[ -f sail ] && zsh sail || zsh vendor/bin/sail'" >> ~/.zshrc
$ source ~/.zshrc
```

### Env設定

```
$ cp .env.example .env
```

### アプリの立ち上げ

```
$ sail up -d
```

### アプリ専用UniqueKEY生成

```
$ sail artisan key:generate
```

### 初回migrateion実行

```
$ sail artisan migrate
```

### アクセスできれば完了

```
$ open http://localhost
```

# Documents
## Laravel
PHPのフルスタックMVCフレームワーク

- https://readouble.com/laravel/8.x/ja/installation.html

### View
Laravel標準ではbladeというテンプレートエンジンを使用してフロント側の開発を行う

- https://readouble.com/laravel/8.x/ja/views.html

### blade
Laravel標準のテンプレートエンジン

- https://readouble.com/laravel/8.x/ja/blade.html

### フロント
npm packageを使用して、フロントコードをビルドすることが推奨されている

- https://readouble.com/laravel/8.x/ja/mix.html

### ルーティング
- https://readouble.com/laravel/8.x/ja/routing.html

### Model
- https://readouble.com/laravel/8.x/ja/eloquent.html

### Breeze
本リポジトリでは認証機能などのLaravel標準のスターターキットが使用されている

- https://github.com/laravel/breeze
- https://readouble.com/laravel/8.x/ja/starter-kits.html#laravel-breeze

### sail
本リポジトリはDocker環境で動作させている

Dockerコンテナ内で使用するコマンドなどはsailコマンドを使用することにより、ローカルホストからショートカットキーのように使用することができる

- https://readouble.com/laravel/8.x/ja/sail.html
