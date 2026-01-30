# Mental Health Tracker

メンタルヘルスの日々の記録を管理するWebアプリケーション

## 概要
日々の気分、睡眠時間、服薬状況を記録し、自己管理をサポートするツールです。
Laravel学習の一環として開発しています。

## 開発の目的
- Laravel/PHPの学習
- CRUD操作の実装経験

## 主な機能
- ユーザー登録・認証
- メンタルヘルス記録のCRUD操作
  - 気分スコア（1-10）
  - 睡眠時間
  - 服薬記録
  - 自由記述メモ
- レスポンシブデザイン

## 使用技術
- **バックエンド**: PHP 8.3, Laravel 12
- **フロントエンド**: Blade, Tailwind CSS
- **データベース**: SQLite
- **認証**: Laravel Breeze
- **開発環境**: WSL2 (Ubuntu), VSCode

## セットアップ
```bash
# リポジトリをクローン
git clone https://github.com/n-haruhi/mental-health-tracker.git
cd mental-health-tracker

# 依存パッケージをインストール
composer install
npm install

# 環境設定
cp .env.example .env
php artisan key:generate

# データベース作成とマイグレーション
touch database/database.sqlite
php artisan migrate

# フロントエンドビルド
npm run build

# サーバー起動
php artisan serve
```

## 作成者
n-harui

