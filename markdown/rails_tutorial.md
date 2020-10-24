## Ruby on Rails チュートリアル

### 導入

#### Rubyとgemのバージョン確認

```shell
ruby -v
gem -v
```

#### Rubyドキュメントは重いのでダウンロードしない設定にしておく

```shell
printf "install: --no-rdoc --no-ri\nupdate:  --no-rdoc --no-ri\n" >> ~/.gemrc
```

#### Ruby on Railsのインストール

```shell
gem install rails -v 5.1.6
```

#### Railsアプリの雛形を作る

```shell
rails _5.1.6_ new hello_app
```

#### Gemfileを編集する

```ruby
source 'https://rubygems.org'

gem 'rails',                   '5.1.6'
gem 'bcrypt',                  '3.1.12'
gem 'faker',                   '1.7.3'
gem 'carrierwave',             '1.2.2'
gem 'mini_magick',             '4.7.0'
gem 'will_paginate',           '3.1.6'
gem 'bootstrap-will_paginate', '1.0.0'
gem 'bootstrap-sass',          '3.3.7'
gem 'puma',                    '3.9.1'
gem 'sass-rails',              '5.0.6'
gem 'uglifier',                '3.2.0'
gem 'coffee-rails',            '4.2.2'
gem 'jquery-rails',            '4.3.1'
gem 'turbolinks',              '5.0.1'
gem 'jbuilder',                '2.7.0'

# sqlite3 gemはdevelopとtestの環境だけで使う(HerokuのDBとの競合を避けるため)
group :development, :test do
  gem 'sqlite3', '1.3.13'
  gem 'byebug',  '9.0.6', platform: :mri
end

group :development do
  gem 'web-console',           '3.5.1'
  gem 'listen',                '3.1.5'
  gem 'spring',                '2.0.2'
  gem 'spring-watcher-listen', '2.0.1'
end

group :test do
  gem 'rails-controller-testing', '1.0.2'
  gem 'minitest',                 '5.10.3'
  gem 'minitest-reporters',       '1.1.14'
  gem 'guard',                    '2.14.1'
  gem 'guard-minitest',           '2.4.6'
end

# 本番ではPostgreSQLを使う
group :production do
  gem 'pg',   '0.20.0'
  gem 'fog',  '1.42'
end

# Windows環境ではtzinfo-dataというgemを含める必要があります
gem 'tzinfo-data', platforms: [:mingw, :mswin, :x64_mingw, :jruby]
```

#### gemをインストールする

```shell
bundle update #念の為bundleの更新
bundle install --without production #gem更新
```

#### rails serverでサーバを立ち上げてみる

```shell
rails server #これでポート3000で立ち上がる
rails server -b 0.0.0.0 -p 8080 #cloud9の場合はこれで
rails server -b $IP -p $PORT #もしくはこう
```



### ★hello, world

#### コントローラを編集する

app/controllers/application_controller.rb

```ruby
class ApplicationController < ActionController::Base
  protect_from_forgery with: :exception
  
  #ここを追加
  def hello
    render html: "hello, world!"
  end
end
```

#### ルーティングの設定

config/routes.rb

```ruby
Rails.application.routes.draw do
  root 'application#hello' #ここを追加
end
```



### ★Scaffold

#### scaffoldでデータモデルを作る

```shell
#文字列型のstirigと文字列型のemailというフィールドを持つUserテーブルを作る。
#idキーは自動で設定されるのでしなくても良い
rails generate scaffold User name:string email:string
```

#### データベースのマイグレート(更新とデータモデルの作成)

```shell
rails db:migrate
```

#### Usersリソース用のルーティング/コントローラ/モデル/ビュー (MVC / REST)

【ルーティング】config/routes.rb

```ruby
Rails.application.routes.draw do
    resources :users #データベースに登録したリソース
    root 'users#index' #usersコントローラーのindexアクションを使う
end
```

【コントローラ】app/controllers/users_controller.rb

```ruby
class UsersController < ApplicationController #継承
    def index #全てのユーザを表示(GET /users)
        @users = User.all
    end
    def show #id=1など特定のユーザを表示するページ(GET /users/1)
    def new #新規ユーザを作成するページ(GET /users/new)
    def create #ユーザを作成するアクション(POST /users)
    def edit #id=1のユーザを編集するページ(GET /users/1/edit)
    def update #id=1のユーザを更新するアクション(PATCH /users/1)
    def destroy #id=1のユーザを削除するアクション(DELETE /users/1)
...
end    #コントローラのアクションは「ページを表示する」or「データを更新する」
```

【モデル】app/models/user.rb

```ruby
class User < ApplicationRecord #継承によって色々な機能が使える。
end
```

【ビュー】app/views/users/index.html.erb

```ruby
    <% @users.each do |user| %> #@userに入っているユーザデータをループで1つずつ処理
      <tr>
        <td><%= user.name %></td>
        <td><%= user.email %></td>
      </tr>
    <% end %>
```

#### データの関連付け / バリデーション

app/models/user.rb

```ruby
class User < ApplicationRecord
    has_many :microposts #Userは複数のMicropostを持つ
end
```

app/models/micropost.rb

```ruby
class Micropost < ApplicationRecord
    belong_to :user #MicropostはUserに属する
    validates :content, length: {maximum: 140}, presence: true #文字数と存在確認バリデート
end
```

#### Railsコンソール

```shell
rails console #対話的にアプリを操作することができるツール
>> User.first.microposts
>> User.first.microposts.first.user
```

#### モデルとコントローラの継承関係

```ruby
Model < ApplicationRecord < ActiveRecord::Base
#作成したモデルオブジェクトはDBへのアクセスができ、DBのカラムをあたかもRubyの属性のように扱える。

Controller < ApplicationController < ActionController::Base
#作成したコントローラーはモデルの操作、HTTPリクエストのフィルタリング、ビューをHTML出力などができる。
#コントローラは全てApplicationControllerを継承しているので、ここに定義したルールは全てに反映される。
```



### ★静的なページの作成

#### コントローラを作る

```ruby
rails generate controller StaticPages home help
#controllers/static_pages_controller.rbが自動で生成される。
#views/static_pages/home.html.erbとviews/static_pages/help.html.erbが自動生成される。
#test/controllers/static_pages_controller_test.rbというテストファイルが自動生成される。
#config/routes.rbに"get static_pages/home", "get static_pages/help"が追加される。
```

#### railsで操作を戻す方法

```shell
rails generate model User name:string email:string
rails destroy model User #Userモデルを削除する
```

```shell
rails db:migrate
rails db:rollback #一個戻す
rails db:migrate VERSION=0 #最初に戻す
```

#### aboutページの追加(①まずテストを書く)

```ruby
test "should get about" do
    get static_pages_about_url
    assert_response :success
end
```

#### aboutページの追加(②ルーティングを設定する)

```ruby
get  'static_pages/help'
get  'static_pages/about' #ここに追加, static_pages_about_urlというヘルパーが使えるようになる
root 'application#hello'
```

#### aboutページの追加(③controllerにアクションを設定)

```ruby
def about
end #これだけでrailsではviews/static_pages/about.html.erbを表示するようになる。
```

#### aboutページの追加(④ビューを作る)

```shell
touch app/views/static_pages/about.html.erb #コマンドラインでファイル作るとかっこいい
```

#### セレクタの有無と内容をテストする

```ruby
assert_select "title", "Home | Ruby on Rails Tutorial Sample App"
```

#### テストが実行される直前に実行されるメソッドを定義

```ruby
def setup
    @base_title = "Ruby on Rails Tutorial Sample App"
end #テスト内では#{@base_title}で参照できる
```

#### ビューの中で変数を使う

```ruby
<% provide(:title, "Home") %>
<!DOCTYPE html>
<html>
  <head>
    <title><%= yield(:title) %> | Ruby on Rails Tutorial Sample App</title>
  </head>
```

#### ビューの仕組み

```shell
#これが大本のビューテンプレート<%= yield %>に各ビューの内容が埋め込まれる。
app/views/layouts/application.html.erb

#パーシャル(個別のビュー)が<% yield %>となっているコンテンツ部分に挿入される
app/views/static_pages/home.html.erbなど
```

### rootのルーティングを変更

```ruby
root 'static_pages#home' #ここを変更 root_urlというヘルパーが使えるようになる
get 'static_pages/home'
```

```ruby
test "should get root" do #root用のテスト
    get root_url
    assert_response :success
end
```



### ★Rubyの文法

#### ヘルパー

```ruby
#app/helper/application_helper.rb

#モジュール、他ファイルからincludeで呼び出せるがrailsでは自動でやってくれる
module ApplicationHelper

#関数定義、rubyでは関数内でreturnを使わない時、デフォルトで最後に評価された式がreturnされる
def full_title(page_title = '') #引数のデフォルト値
    base_title = "Ruby on Rails Tutorial Sample App"
    if page_title.empty?
        bese_title
    else
        page_title + "|" + bese_title
    end
end
```

```ruby
<title><%= full_title(yield(:title)) %></title> #レイアウトビュー内で使う
```

#### ブロック

```ruby
(1..5).each { |i| puts 2 * i }
(1..5).map { |i| i**2 } #[1, 4, 9, 16, 25]

(1..5).each do |i|
   puts 2 * i
end

%w[A B C].map { |char| char.downcase } #["a", "b", "c"]
%w[A B C].map(&:downcase) #symbol-to-proc記法、これは上と同じ意味
```

#### ハッシュ / シンボル

```ruby
user = { :name => "Michael Hartl", :email => "michael@example.com" }
user = { name : "Michael Hartl", email : "michael@example.com" }

user[:name] #"mhartl@example.com"
```

```shell
puts :name.inspect
p :name #上と同じ
```

#### メソッド呼び出し

```ruby
#rubyでは引数のカッコ、末尾の引数がオブジェクトの時の{}を省略できる。
stylesheet_link_tag 'application', media: 'all', 'data-turbolinks-track': 'reload'
stylesheet_link_tag('application', media: 'all', 'data-turbolinks-track': 'reload')
stylesheet_link_tag('application', { media: 'all', 'data-turbolinks-track': 'reload'})
```

#### クラス

```ruby
s = String.new('foobar')
s.class #String
s.class.superclass #Object
s.class.superclass.superclass #BasicObject
s.class.superclass.superclass.superclass #nil
```

```ruby
class User
    attr_accessor :name, :email #アクセサ getterとsetter
    
    def initialize(attribute = {}) #いわゆるコンストラクタ
        @name = attribute[:name]
        @email = attribute[:email]
    end
    
    def formatted_email #インスタンスメソッド
        "#{@name} #{@email}"
    end
end

user = User.new(name: "Michael Hartl", email: "mhartl@example.com")
```



### ★レイアウト

#### リンク、画像、パーシャル

```ruby
<%= link_to "Home", root_path, id: "logo" %>
#root_pathならルートパス、root_urlなら絶対パスを返す
```

```ruby
<%= image_tag("rails.png", alt: "Rails logo") %>
```

```ruby
<%= render 'layouts/header' %> #拡張子は省略可能
```

#### ルーティングのカスタマイズ

```ruby
Rails.application.routes.draw do
  root 'static_pages#home'
  get  '/help',    to: 'static_pages#help'
  get  '/about',   to: 'static_pages#about'
  get  '/contact', to: 'static_pages#contact'
end
```

#### レイアウトのリンクをチェックするテスト

```ruby
test "layout links" do
  get root_path
  assert_template 'static_pages/home' #テンプレートのテスト
  assert_select "a[href=?]", root_path, count: 2 #リンクと個数のテスト
  assert_select "a[href=?]", help_path
  assert_select "a[href=?]", about_path
  assert_select "a[href=?]", contact_path
end
```



### ★Userモデルの作成

#### モデルの作成

```shell
rails generate model User name:string email:string #モデル名は単数系にする
```

#### マイグレーション

```sell
rails db:migrate
```

#### ロールバック

```shell
rails db:rollback
```

#### railsコンソール(サンドボックスモードで立ち上げる)

```shell
rail console --sandbox
```

#### railsコンソール上で新しいユーザモデルを作ってみる

```ruby
user = User.new(name: "tarou", email: "aaa@gmail.com")
user.valid? #有効性チェック
user.save #DBに保存(保存するまではただメモリ上にあるだけ)
user.name
user.email
user.id #マジックカラム(id)
user.created_at #マジックカラム(作成日時)
user.updated_at #マジックカラム(更新日時)

user2 = User.create(name: "tarou", email: "bbb@gmail.com") #モデル作成とDB保存を同時にする
user2.destroy #DBからuser2を削除
user2 #destroyしてもまだメモリ上には存在する

User.find(1) #1番目のユーザを検索
User.find(3) #3番目のユーザを検索(存在しないので例外が発生する)
User.find_by(email: "bbb@gmail.com")
User.first
User.all #ActiveRecord::Relationというイテレータで全てのユーザを返してくれる
User.all.length #データの個数を返してくれる

user.email = "ccc.gmail.com" #メモリ上で更新
user.save #DBに保存
user.reload #DBの情報をもとに再読み込みする
user.update_attributes(name: "bob", email: "ccc@gmial.com") #まとめて更新、保存
user.update_attribute(:name, "michel") #特定の属性だけを更新、保存

user.errors.full_messages #エラーが起きた時のメッセージを確認する
```

#### バリデーション

app/models/user.rb

```ruby
class User < ApplicationRecord
  before_save { email.downcase! } #登録する前に小文字にする(クラス内なのでselfは省略できる)  
    
  validates :name, presence: true, length: { maximum: 50 }
    
  validates :email, presence: true, length: { maximum: 255 },
             format: { with: /\A[\w+\-.]+@[a-z\d\-]+(\.[a-z\d\-]+)*\.[a-z]+\z/i },
             uniqueness: { case_sensitive: false }, #大文字小文字を区別せず一意にする
    
  has_secure_password #セキュアなパスワードを持つ
  validates :password, presence: true, length: { minimum: 6 }
end
```

#### DBに新しくマイグレーションを追加する(2重クリック対策)

```shell
rails generate migration add_index_to_users_email
```

```ruby
class AddIndexToUserEmail < ActiveRecord::Migration[5.0]
    def change
        add_index :users, :emails, unique: true #emailにインデックスを張り、同時に一意性を保証
    end
end
```

#### セキュアなパスワードを設定する

```shell
#DBのカラムにpassword_digestというカラムを追加するためのマイグレーション
rails generate migration add_password_digest_to_users password_digest:string
rails db:migrate
```

```ruby
gem 'bcrypt', '3.1.12' #bcryptというハッシュ関数を追加
bundle install
```

```ruby
User.create(name: "hanako", email: "hana@example.com",password: "foobar", password_confirmation: "foobar") #パスワード付きでユーザを作る

user = User.find_by(email: "hana@example.com")
user.password_digest #ハッシュ化されたパスワードが表示

user.authenticate("morimori") #パスワードが違うのでfalse
!!user.authenticate("foobar") #正しいパスワードを与えたのでtrue
```

※モデル内にhas_secure_passwordを指定したときの挙動

- ハッシュ化したパスワードをpassword_digestという属性でDBに保存できるようになる。
- Userインスタンスはpasswordとpassword_confirmationという属性を持つようになる。
- passwordとpassword_confirmationの存在性、一致性のバリデーションが追加される。
- user.authenticate('パスワード文字列')というメソッドを使えるようになる。ture/falseを返す。 



### ★ユーザ登録

#### デバッグ機能をつける

/app/views/layouts/application.html.erb

```ruby
<%= debug(params) if Rails.env.development? %> #開発環境のみ表示させる
```

#### Userリソースのルーティングを設定する

```ruby
Rails.application.routes.draw do
  root 'static_pages#home'
  get  '/help',    to: 'static_pages#help'
  get  '/about',   to: 'static_pages#about'
  get  '/contact', to: 'static_pages#contact'
  get  '/signup',  to: 'users#new'
  resources :users #追記(index,show,new,create,edit,update,destroyアクション自動で追加)
end
```

#### コントローラーとビューを設定する

app/controllers/users_controller.rb

```ruby
class UserController < ApplicationController
    def show
        @user = User.find(param[:id])#/users/:idから取得した値がはいる。@userはビューで利用可
    end
    
    def new
        @user = User.new #空のユーザオブジェクトを@userに入れておく
    end
end
```

#### デバッカー

```ruby
def show
  @user = User.find(params[:id])
  debugger #ここでコードが止まって、この時の@userの値をコンソールで確認することができる
end
```

#### Gravatar画像を表示する

app/helper/users_helper.rb

```ruby
module UsersHelper
  def gravatar_for(user)
      gravatar_id = Digest::MD5::hexdigest(user.email.downcase)
      gravatar_url = "https://secure.gravatar.com/avatar/#{gravatar_id}"
      image_tag(gravatar_url, alt: user.name, class: "gravatar")
  end
end
#GravatarはメールアドレスをMD5という仕組みでハッシュ化している。
#RubyではDigestライブラリのhexdigestメソッドを使うとMD5のハッシュ化が実現する。
```

app/views/users/show.html.erb

```ruby
<% provide(:title, @user.name) %>
<h1>
  <%= gravatar_for @user %>
  <%= @user.name %>
</h1>
```

#### 新規登録用のフォームをつくる

app/views/users/new.html.erb

```ruby
<% provide(:title, 'Signup') %>
<% form_for(@user) do |f| %>
  <% f.label :name %>
  <% f.text_field :name %>

  <% f.label :email %>
  <% f.email_field :email %>

  <% f.label :password %>
  <% f.password_field :password %>

  <% f.label :password_confirmation "Confirmation" %>
  <% f.password_field :password_confirmation %>

  <% f.submit "" :name %>
<% end %>
```

↓こういうHTMLが生成される

(/usersにpostメソッドで送る。name="user[name]"などの値はハッシュ形式でparams[:user]に入っている。

```html
<form action="/users" class="new_user" id="new_user" method="post">
  <label for="user_name">Name</label>
  <input id="user_name" name="user[name]" type="text" /> ...
```





### ★Git

#### Gitの設定

```shell
git --version #gitが入っているか確認
```

```shell
#初期設定
git config --global user.name "Your Name"
git config --global user.email your.email@example.com
```

#### Gitで初期コミットまで

```shell
git init #初期化
git add -A #ステージングにアップ
git status #状態を確認
git commit -m "Initialize repository" #commit
git log --oneline #gitのコミットログを見る
```

#### ※何か間違って消した時の戻し方

```shell
rm -rf app/controllers/ #rm -rfで強制的にディレクトリを消す
ls app/controllers/ #No such file or directory

git checkout -f #前のコミットに戻す(-fフラグで現在の作業ツリーの変更を強制的に上書きして元に戻す)
```

#### 公開鍵を表示する(ssh接続する場合)

```shell
cat ~/.ssh/id_rsa.pub #ssh-rsa AAAAB3NzaC1yc...
ssh-keygen #まだ鍵がない時はつくる
```

#### GithubやBitbucketの画面にてSSH鍵の設定をする

```shell
各サービスの画面で設定
```

#### 新しいリポジトリを作る

```
各サービスの画面で設定
```

#### リモートのリポジトリにpush

```shell
git remote add origin git@bitbucket.org:～/sample_app.git #リモート設定
git push -u origin --all #push
```

#### 新しいブランチを作ってソース修正を行う

```shell
git checkout -b ブランチ名 #ブランチを作ってそちらに移動する
git branch #ブランチ一覧を確認

#(...何かしらソースを修正...)
git commit -a -m "Modify" #新規ファイルがなければaddせずこれでcommitできる。

git checkout master #masterブランチに移動
git merge ブランチ名 #今いるブランチ(master)にトピックブランチをmerge
git branch -d ブランチ名 #ブランチ削除
git branch -D ブランチ名 #ブランチ削除(mergeしてなくても消す)

git push origin master #push
```



### ★デプロイ

#### HerokuCLIを導入する

[Heroku toolbelt](https://devcenter.heroku.com/articles/heroku-cli)

```shell
heroku --version #herokuが入っているか確認

sudo snap install --classic heroku #Ubunth 16+
curl https://cli-assets.heroku.com/install.sh | sh #standalone
source <(curl -sL https://cdn.learnenough.com/heroku_install)#cloud9
```

#### Herokuにログイン

```shell
heroku login #ログイン
heroku keys:add #SSHキーを登録
```

#### Herokuアプリの作成

```shell
heroku create
```

#### Herokuにデプロイ

```shell
git push heroku master
heroku open #cloud9でなければこれでも開ける
```

#### Herokuのデータベースをマイグレーション

```shell
heroku run rails db:migrate
```

#### Herokuアプリのリネーム

```shell
heroku rename rails-tutorial-hello #アプリ名はHeroku内でユニークでないとNG
```

#### Herokuのログを取る

```shell
heroku logs
```

  