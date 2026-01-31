# Mental Health Tracker

メンタルヘルスの日々の記録を管理し、セルフケアをサポートするWebアプリケーション

## 概要
日々の気分、睡眠時間、服薬状況を記録し、必要に応じて認知行動療法の手法を用いて思考を整理することで、自己管理とメンタルヘルスケアをサポートするツールです。
Laravel学習の一環として開発しています。

## 開発の目的
- Laravel/PHPの学習
- CRUD操作の実装経験

## 主な機能
### ダッシュボード
- 統計情報の表示（総記録数、今週の平均気分・睡眠・服薬率）
- 過去7日間の気分推移グラフ
- 最近の記録3件の表示

### メンタルヘルス記録
- 日々の記録のCRUD操作
  - 気分スコア（1-10）
  - 睡眠時間
  - 服薬記録
  - 日記・メモ
- 過去30日間の推移グラフ（気分スコア・睡眠時間）
- 記録の詳細表示

### 心の整理（認知行動療法）
- 7つのコラム法による思考記録
  - 状況
  - 気分・感情（強さ0-100%）
  - 自動思考
  - 根拠
  - 反証
  - 適応的思考
  - その後の気分
- 部分的な記入でも保存可能
- ヘルプ機能で使い方を確認

### 認証・セキュリティ
- ユーザー登録・ログイン
- プロフィール管理
- 自分の記録のみ閲覧・編集可能

## 使用技術
- **バックエンド**: PHP 8.3, Laravel 12
- **フロントエンド**: Blade, Tailwind CSS, Chart.js
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
n-haruhi
