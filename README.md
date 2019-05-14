# Welcomeゼミ
- セキュリティ by PHP
    - <https://qiita.com/chrischris0801/items/a8beaeffb58b618d64a4>
## Todoリスト
1. PHPってなあに？？？？？？
    - PHP入門 -> 本を使うよー()
2. セキュリティってなあに？？
    - https://qiita.com/chrischris0801/items/a8beaeffb58b618d64a4
3. 発表準備
    - パワポつかうやで
4. 発表(5/25, 5/31)

## 活動日
- 毎週木曜日の例会のあと
    - 19:30~

## やっておいてほしいリスト
1. PHPとは？をちょっと調べといてね〜
    -PHPとは
    HTMLへの埋め込み型プログラミング言語
    プログラムの結果をブラウザソフトに返す、所謂Webプログラミングに利用されるモノ
    -PHPでできること、具体的アプリケーション例
    ウェブログ(所謂「ブログ」)、ショッピングカート(amazonみたいな？)、フォームメール(アンケートとか申し込みとか？)、アクセス解析、アクセスカウンタ、掲示板(5chとか)
    -PHPの仕組み
    
    
    
    
    http://www.php-labo.net/tutorial/ready/
    -  phpです。

### 1回目
- macにdockerを入れる
- dockerにPHPの環境をつくる
- 図書館に行きます

1. docker for mac 入れる
- <https://qiita.com/kurkuru/items/127fa99ef5b2f0288b81>
- docker version
- docker-compose version
---
1. `welcome-seminar`っていう名前のディレクトリを作ってください
2. 
```text
├── docker-compose.yml
├── nginx
│   └── nginx.conf
├── php
│   ├── Dockerfile
│   └── php.ini
├── mysql
│   └── data
└── www
    └── html
        └── index.php
```
---
2. phpの環境入れる
- <https://qiita.com/sitmk/items/f911be7ffa4f29293fd5>

3. `docker-compose up -d`
4. `docker ps -a`
5. `docker-compose stop`

`hello world`が表示されたのでOK
***1回目オワリ***

- ターミナルはつけっぱ
    - docker-compose起動、`index.php`に色々書き写す

### 2回目(5/13)
## 本日やること
# 完成させます！！
急で申し訳ない😢

## 本日の流れ
- 僕が上回生会議で軟禁されてる間にちょっとした問題的なのを考えてもらいます
- スライドの大まかな作成
    - (ただ、発表が木曜なのでもしかすると...)

## 1. とりあえず環境の更新から
- [GoogleDriveのリンク](dev.io)
- zipぶちこんできて解凍、ファイル配置
- ***dockerを立ち上げて見てみる(復習)***
- ルート：<http://localhost:5963>
    - ログインID:`hoge`
    - パスワード:`password`

## 2. 僕が軟禁されてる間にやってほしいこと
## その１
- Dockerを立ち上げた後ログイン、<http://localhost:5963/login_success.php> に入れば成功
- 怪しい名前入力フォームにまず自分の名前入力 -> まんま出力されたらOK
- 次に
```htmlmixed=
<form action="login_success.php" method="POST" name ="warui_form">
<input type="hidden" name="お名前" value='<script>alert("悪意のあるjavascript");</script>'> </form>
<a href="https://www.kantei.go.jp/" onclick="document.warui_form.submit();return false;" >小銭稼ぎたい方はこちらをクリック！</a>
```
をコピペして送信ボタンﾎﾟﾁｰ
- [小銭を稼ぎたい方はこちらをクリック！]() とか言うクソ怪しいリンクが表示されて、クリックすると[首相官邸](https://www.kantei.go.jp/)に飛べば成功
### この一連をXSS(クロスサイトスクリプティング)と言います
#### コレを防ぐための方法を簡単にまとめてくださいな

-> 

---

### ただですね...
これ実は本当にデーターベースに接続していないのでマジのやつではない<br>
-> データベースの設定をします(後ほど)

## その２
- `login_success.php`の一番下の ***次→*** をクリック
- <http://localhost:5963/update.php>に切り替わる

## データーベースの設定
- MySQLを使います
- 実はもうコレ既にdocker-composeに入ってるので今はインストール必要無し
### 手順
- いつもどおりdocker起動、コンテナ起動
- mysqlのコンテナの中に入らないとdb(データベース)が操作できないので、
1. `docker ps -a`でコンテナのID確認
2. `docker exec -it <コンテナID> bash`
コレでmysqlのコンテナの中に入れる(試しに`mysql --version`って打つと色々出てくる)
- 次にmysqlのコンソールの中に入ります
- `mysql -u root -p`と打つとパスワード入力求められるので`password`と入力
-> `access denied`とかなんたら言われなかったら★侵☆入★成☆功★

```shell
mysql>
# こんな感じで表示されてるはず
```

- このままだと僕たちが操作して好きなように出来るdbがないので作ります
- `create database welcome_seminar;`と入力
(セミコロン(`;`)忘れない、名前はアンダーバー(`_`)区切りで入力)
- `show databases;`で確認
```text
mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
| welcome_seminar    |
+--------------------+
5 rows in set (0.02 sec)
```
みたいな感じで出力されたらおｋ
- 次にルートで操作すると色々やばいのでユーザー作ります
- `grant all on welcome_seminar.* to 'php_user'@'localhost' identified by 'root';`
これで`php_user`って名前のユーザーが出来る、権限全部盛りなのでほぼルート
- `SELECT user, host FROM mysql.user;`で確認
```text
mysql> SELECT user, host FROM mysql.user;      
+---------------+-----------+
| user          | host      |
+---------------+-----------+
| root          | %         |
| mysql.session | localhost |
| mysql.sys     | localhost |
| php_user      | localhost |
| root          | localhost |
+---------------+-----------+
5 rows in set (0.00 sec)
```
みたいな感じなり
- 一旦`\q`でログアウト
- `mysql -u php_user -p`でログイン
    - パスワード：`root`
ちょっとくどくど長いんで巻きでやっていきます
- `use welcome-seminar`で使用dbに標準合わせる
- `create table users(id int auto_increment not null primary key, user_name varchar(32), password varchar(32));`
    - とりあえずコレ入力してくさだいすまそ
    - テーブルとカラムを作っています
- `insert into users(user_name, password) values('rits', 'ritsumeikan');`
    - とりあえずこr
    - さっき作ったテーブルとカラムにデータぶちこんでます
```text
mysql> select * from users;
+----+-----------+-------------+
| id | user_name | password    |
+----+-----------+-------------+
|  1 | rits      | ritsumeikan |
+----+-----------+-------------+
1 row in set (0.00 sec)
```
こんな感じなったらおｋ〜〜〜〜〜〜<br>
![](https://i.imgur.com/Ct39ps7.png)
