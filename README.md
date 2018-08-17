# ポートフォリオ

## おすすめスポット共有サイト
おすすめスポットをユーザーが投稿し合い共有するサイトです。  
ログイン機能、検索機能、フォロー機能、お気に入り登録機能などがあります。  
投稿フォームはGoogleMapを使いユーザーが場所を登録しやすいようにしています。  
そのほかにも適宜GoogleMapを使い使いやすい工夫をしています。  

※spotファイルの中にあります。  


### ファイルの説明
   - add.php スポットを投稿するページです。
   - add_success.php スポットを投稿が成功した場合に表示されるページです。
   - index.php 投稿されたスポットを表示するページです。
   - init.sql データベースとテーブル作成する際に使ったSQL文です。
   - item_detail.php 投稿されたスポットの詳細ページです。
   - user_login.php ログインページです。
   - user_logout.php ログアウトをするページです。ログアウトした後にuser_logout_success.phpにリダイレクトします。）
   - user_logout_success.php ログアウトが成功した際に表示されるページです。
   - user_sign_up.php 新規登録のページです。
### 使用言語
  - HTML/CSS(Bootstrap)
  - javascript
  - PHP
  - SQL
### フレームワーク
  - Smarty
### 開発環境
  - ubuntu
  - apache2
  - MySQL



## 掲示板サイト
セッション認証でログインする掲示板サイトです。  
XXS、CSRF、SQLインジェクションなどのセキュリティ対策をしています。  
※internetformファイルの中にあります。  

### ファイルの説明
   - internetform.php 投稿したコメントの一覧を表示します。
   - internetform_contribution.php 投稿フォームです。
   - user_registration.php ユーザー登録をするページです。
   - user_registration_complete.php ユーザー登録が成功した時に表示されるページです。
   - user_login.php ログインページです。
   - user_logout.php ログアウトをするページです。（ログアウトした後にログインページにリダイレクトします。）
### 使用言語
  - HTML/CSS(Bootstrap)
  - PHP
  - SQL
### 開発環境
  - ubuntu
  - apache2
  - MySQL
