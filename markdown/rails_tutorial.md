## 手順書/レギュレーション

### ★導入

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

gem 'rails',        '5.1.6'
gem 'puma',         '3.9.1'
gem 'sass-rails',   '5.0.6'
gem 'uglifier',     '3.2.0'
gem 'coffee-rails', '4.2.2'
gem 'jquery-rails', '4.3.1'
gem 'turbolinks',   '5.0.1'
gem 'jbuilder',     '2.6.4'

# sqlite3 gemはdevelopとtestの環境だけで使う(HerokuのDBとの競合を避けるため)
group :development, :test do
  gem 'sqlite3',      '1.3.13'
  gem 'byebug', '9.0.6', platform: :mri
end

group :development do
  gem 'web-console',           '3.5.1'
  gem 'listen',                '3.1.5'
  gem 'spring',                '2.0.2'
  gem 'spring-watcher-listen', '2.0.1'
end

# 本番ではPostgreSQLを使う
group :production do
  gem 'pg', '0.20.0'
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

```ruby

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
user.save #DBに保存
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

  