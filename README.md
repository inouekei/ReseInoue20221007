# アプリケーション名
Rese（リーズ）
ある企業のグループ会社の飲食店予約サービス
![image](https://user-images.githubusercontent.com/108909962/203447402-ad482c2f-1f3c-4a4e-8ac0-47ac8243c857.png)

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## 機能一覧
会員登録
ログイン
ログアウト
ユーザー情報取得
ユーザー飲食店お気に入り一覧取得
ユーザー飲食店予約情報取得
飲食店一覧取得
飲食店詳細取得
飲食店お気に入り追加
飲食店お気に入り削除
飲食店予約情報追加
飲食店予約情報削除
エリアで検索する
ジャンルで検索する
店名で検索する
予約変更
評価
バリデーション
レスポンシブデザイン
権限別ログイン
店舗代表者作成
店舗情報作成
店舗情報更新
店舗側予約情報確認
ストレージ
認証
メール送信
リマインダー
QRコード
決済機能

## 使用技術
- Laravel　8.x、MySQL

## 実行環境
- PC：Chrome/Firefox/Safari 最新バージョン
- SP：iOS/AndroidOS

## テーブル設計
下記URLを参照のこと
https://docs.google.com/spreadsheets/d/157cN3AXf7SD8C2pZxYj32Xj7_fsYsCHjwCs3p3p4qYo/edit#gid=1635115377

## ER図
下記URLを参照のこと
https://docs.google.com/spreadsheets/d/157cN3AXf7SD8C2pZxYj32Xj7_fsYsCHjwCs3p3p4qYo/edit#gid=320603785

## 環境構築
- MySQLでresedbを作成する
- ルートディレクトリにある設定ファイル.envのユーザー名、パスワードの箇所に、自分の環境にあったものを設定する
- MySQLを立ち上げてから、シーディングを行う
- トップでphp artisan serveとコマンド入力する

## シーディングされるアカウント
- （利用者権限）customer1@example.com、customer2@example.com、customer3@example.com、customer4@example.com、customer5@example.com、PWはすべて"password"
- （店舗代表者権限）manager6@example.com、manager7@example.com、manager8@example.com、manager9@example.com、manager10@example.com、PWはすべて"password"
- （管理者権限）admin@example.com、PWは"password"
