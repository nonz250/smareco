# smareco
スマレジの取引情報から会員のおすすめ商品を抽出します。
## 初期セットアップ方法
### docker build
```bash
docker-compose build
```

### docker起動
```bash
docker-compose up -d
```

### Composerパッケージインストール
```bash
docker-compose run --rm composer install
```

### Nodeパッケージインストール
```bash
docker-compose run --rm node npm i
```

### 開発モードCompile
```bash
docker-compose run --rm node npm run dev
```

## コマンド一覧
### PHPコマンド
```bash
docker-compose exec php php {options}

# ex.) artisan
docker-compose exec php php artisan {command}
```

### Composer
```bash
docker-compose run --rm composer {command}

# ex.) install
docker-compose run --rm composer install
```

### Node
```bash
docker-compose run --rm node {command}

# ex.) npm install
docker-compose run --rm node npm install

# ex.) 開発モードCompile
docker-compose run --rm node npm run dev

# ex.) 公開モードCompile
docker-compose run --rm node npm run prod

# ex.) 監視モードCompile
docker-compose run --rm node npm run watch
```

### Eslint
```bash
# コードチェック
docker-compose run --rm node npm run eslint

# コード自動修正
docker-compose run --rm node npm run eslint-fix
```

### PHP-CS-FIXER
```bash
# コードチェック
docker-compose run --rm php-cs-fixer

# コード自動修正
docker-compose run --rm php-cs-fixer fix -vv
```
