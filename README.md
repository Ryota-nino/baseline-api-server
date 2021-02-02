# Baseline API Server

## Aboutについて - About Baseline

## 開発環境 - Environment

- PHP v7.3.11
- Laravel v8.4.0
- MySQL v8
- Docker v20.10.2
- docker-compose v1.27.4

## スタートガイド - Getting Started

### 環境 - Prerequisites

- Dockerがインストール済み

### インストール Installing

#### 1. dockerを実行

```
docker build baseline-api:1.0 .
```

#### 2. .env.exampleをコピーしてdb接続設定を書き込む

```
DB_CONNECTION=mysql
DB_HOST=###接続先###
DB_PORT=3306
DB_DATABASE=###データベース名###
DB_USERNAME=###ユーザ###
DB_PASSWORD=###パスワード###
```

#### 3. コンテナの中に入る

コンテナ名を調べる

```
docker ps
```

コンテナの中に入る

```
docker exec -i -t (コンテナ名) bash
```

#### 3. 初期化設定をする

```
composer install && \
php artisan key:generate && \
php artisan config:clear && \
php artisan config:cache && \
php artisan optimize && \
php artisan storage:link
php artisan migrate:fresh --seed \
```

#### 4. 実行

```
php artisan serve
```

