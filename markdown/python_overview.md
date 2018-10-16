# Python基礎

## 演算子

```python
x + y
x - y
x * y
x / y
x // y
x % y
- x
x ** y
abs(-8) -> 8
int(2.2) -> 2
float(2) -> 2.0
round(3.55, 1) -> 3.6
```

## 予約語

```python
True / False / global / None
and / or / not
if / elif / else
while / for / in / continue / break
def / lambda / return / pass / yield
class
try / finally / raise
import / from / as

is / nonlocal / del / with / assert / except / 
```

## エスケープシーケンス

```python
\(改行)
\'
\"
\r\n #-> CRLF
\n #-> LF
\t #-> タブ　
\xhh #-> 16進数で hh の文字
\uxxxx #-> 16bit Unicodeで16進数 xxxx の文字
\Uxxxxxxxx #-> 32bit Unicodeで xxxxxxxx の文字
```

## ユーザの入力を促す

```python
name = input('お名前は?') 
#->受けとった内容はすべて文字列なので、数値の場合はint()などで変換する
```

## 型変換

```python
str(15) #-> "15"
int("2") #-> 2
float("2") #-> 2.0
type(x) #-> 変数や値xの型を調べる
dir(x) #-> xが持つメソッドやプロパティを見る
```

## 条件分岐 if

```python
if num % 2 == 0:
    print('偶数')
else:
    print('奇数')
```

## 比較演算子

```python
a == b
a != b
a > b
a >= b
a < b
a <= b
```

## 三項演算子

```python
n = 3
'Odd' if (n % 2 == 0) else 'Even' # (Trueの値) if(条件) else (Falseの値)
#-> 'Even'
```

## 繰り返し while for

```python
while True:
    user = input('坪数は？')
    if user == '' or user == 'q': break   #空文字か'q'ならばループを抜ける
    tubo = int(user)
    m2 = tubo * 3.31
    s = "{0}坪は{1}平方メートルです".format(tubo, m2)
    print(s)
```

```python
for i in range(1, 16): #range(開始値, 終了値, ステップ値)
    if i % 2 == 0:
        continue
    if i > 9:
        break
    print(i)
```

## 文字列

``` python
#基本
s1 = 'hello' + 'world'
s2 = 'love' * 3
s3 = """\
今日はいい天気です。
明日もいい天気です。
しかし明後日は雨です\
"""

#フォーマット埋め込み
'年齢は{0}、性別は{1}です'.format(age, gender)
'年齢は{age}、性別は{gender}です'.format(age=22, gender='男')

#抽出
s1[0] #0番目の文字を取り出す
s1[1:4] #1番目から4番目の文字を取り出す
s1[:3] #3番目までを取り出す
s1[7:] #7番目以降を取り出す
s1[-3:] #後ろから3番目以降を取り出す
s1[::3] #最初から最後まで3文字目に出てきたものだけ取り出す

#分割
s1.split([char, [maxsplit]]) #区切り文字と最大分割数で分割してリストに、指定なければ空文字で

#連結
'連結文字'.join(list) #リストやタプル、セットを連結文字でつなげた文字列を返す

#置換
"This is a pen".replace('pen', 'note') #penをnoteに置換

#検索
str.find(txt [,start [, end]]) #txtがあれば文字位置を数値で返す。なければ-1を返す

#整形
s1.strip([charset]) #先頭と末尾にあるcharsetを削除、指定がなければ空白文字を削除する

#変換
s1.lower() #小文字に変換
s1.upper() #大文字に変換

#開始文字のチェック
s1.startswith(str [,start [,end]]) #strで始まるならTrueを返す

#文字列がすべて数字を表すかどうか
s1.isnumeric() #1, 2.2などの文字列だけならTrue
```

## 正規表現

```python
import re
reg = r'\d*'

reg.match(pattern, str) #-> strの"先頭"にマッチしていればmatchオブジェクトをなければNoneを返す。
reg.search(pattern, str) #-> strの"どこか"にマッチしていれば～以下matchと同じ
reg.split(pattern, str) #-> patternでstrを分割してリストにして返す
reg.findall(pattern, str) #-> patternにマッチするものを文字列のリストで返す 
reg.finditer(pattern, str) #-> patternにマッチするものをイテレータで返す
reg.sub(pattern, repl, str) #-> patternにマッチするものをreplに置換する
reg.compile(pattern, str) #-> patternをあらかじめコンパイルする

match.expand(template) #-> sub()メソッドと同様にマッチした文字列でtemplate文字列を置換
match.group([g]) #-> マッチしたサブグループgを返す
match.groups() #-> パターンにマッチしたすべてのサブグループの一覧を返す
match.groupdict() #-> 名前付きのサブグループを辞書型で返す
match.start([g]) #-> グループgとマッチした部分文字列の先頭のインデックスを返す
match.end([g]) #-> グループgとマッチした部分文字列の末尾のインデックスを返す
match.span([g]) #-> グループgに関して、(start, end)のタプルを返す
```

## リスト

```python
arr = [10, 20, 30, 45]

arr[0] #各要素にアクセス
arr[1] = 35 #代入

len(arr) #配列の長さを得る
sum(arr) #合計する

for i in arr: #for文で回す
    print(i)

for i, v in enumerate(arr): #index付きでfor文を回す
    print(i, v)

arr.append(55) #要素の追加
arr += [10, 21] # ＋演算子で配列を追加もできる
arr.extend([10, 21]) # 同じく配列を追加するメソッド
arr.insert(i, 10) #インデックスiの位置に10を追加

del arr[2] #2番目の要素を削除
del arr[2:4] #範囲を指定して削除
arr.remove(X) #値Xの要素を削除(最初に見つかったものだけ)
arr.clear() #リストの全要素を削除

arr[1:3] #0から数えて1番目～2番目までスライス
arr[:3] #3番目までをスライス
arr[7:] #7番目以降をスライス
arr[-3:] #後ろから3番目以降をスライス
arr[::3] #最初から最後までで3個目にでてきたものをスライス

arr.index(x) #値xのインデックス番号を返す(なかったらValueError)
arr.count(x) #リスト中に値xが何回でてくるか回数を返す
arr.sort(key, reverse) #リストを昇順に並べ替え(reverse=Trueで降順)
arr.copy() #リストのシャローコピーを返す
```

## タプル

```python
tp = (10, 20, 30) #後から変更ができないリスト
```

## セット

``` python
st = set({'aaa', 'bbb', 'ccc'}) #重複する値を持たせることができないリスト、順序もない
st2 = {'aaa', 'ddd'} #リテラルで作成

st - st2     #-> {'ccc', 'ddd'} 差分
'aaa' in st  #-> True
st | st2     #-> {'ddd', 'aaa', 'ccc', 'bbb'} まとめる
st & st2     #-> {'aaa'} 共通する値だけを取り出す
```

## 変換メソッド

```python
list(arr) #->リストに変換
tuple(arr) #->タプルに変換
set(arr) #->セットに変換
```

## 辞書型(dict)

```python
dic = {'key1': 'value1', 'key2': 'value2', 'key3': 'value3'}

dic['key1'] #要素へのアクセス
'key1' in dic #指定のkeyがあるかどうか

dic.keys() #-> キーの一覧を得る(dict_keys型)
dic.values() #->値の一覧を得る(dict_value型)
dic.items() #->キー,値の一覧を得る(dict_item型)

list(dic.keys()) #->リスト形式で得る
sorted(dic.keys()) #->ソートされた状態で得る
list(dic.items()) #->タプルのリストで一覧を得る

for key, value in dic.items(): #->for文で列挙する
    print(key, value)
```

## リスト内包表記

```python
#1～11のうち3でかけた数のうち、奇数のものだけを表示
data = [i*3 for i in range(1, 11) if i % 2 == 1] #[式 for .. in .. if ..]で使う
print(data) #->[3, 9, 15, 21, 27]
```

```python
#ifのネスト(数字の組み合わせを得る)
base = [1, 2, 4]

result = [(x, y) for x in base for y in base]
result #->[(1, 1), (1, 2), (1, 4), (2, 1), (2, 2), (2, 4), (4, 1), (4, 2), (4, 4)]

result2 = [(x, y) for x in bese for y in base if x != y] #同じ数字の組み合わせを削除
result2 #-> [(1, 2), (1, 4), (2, 1), (2, 4), (4, 1), (4, 2)]
```

```python
#リスト以外での利用
{(x + y) for x in [1, 2, 3] for y in [1, 2, 3]} #{}で囲むとセットを返す

{'h'+str(x): x*5 for x in range(1,4)} # {k:v ...}とすると辞書型になる

gen = (x**2 for x in [1, 2, 3]) #()で囲むとジェネレータ式になる
for i in gen: print(i)
```

## 関数

```python
def mul(x, y):
    '''掛け算をする関数''' #docstring
    return x * y #returnを指定しないと戻り値はNone

mul(2, 3) #-> 6
help(mul) #docstringを見る
```

## 再帰

```python
def fact(n):
    if n == 0:
        return 1
    else:
        return n * fact(n - 1)

fact(5) #-> 5*4*3*2*1 つまり120 
```

## 引数のデフォルト値

```python
def call_name(name='田中'):
    print(name)

call_name('森田')
call_name() #指定しないとデフォルトの引数が入る        
```

## 名前付き引数

```python
def calcTime(dist, speed):
    return round((dist / speed), 1)

calcTime(500, 100)
calcTime(speed=100, dist=500) #順番関係なく引数を指定できる
```

## 可変長引数

```python
def sumArg(*args):
    v = 0
    for n in args:
        v += n
    return v

sumArg(1, 2, 3)#引数がいくつでも対応できる
sumArg(1, 2, 3, 4, 5, 6, 7, 8, 9, 10) #argsにタプルで格納される仕組み
```

```python
def print_args(**kwargs):
    print(kwargs)

print_args(a=30, b=50, c=40) #辞書型の引数の場合
print_args(aa='hoge', bb='fuga') #kwargsにハッシュで格納される仕組み
```

## スコープ

```python
value = 100

def changeValue():
    global value
    value = 20

changeValue()
print('value=', value) #value=20 グローバル変数が書き換わっている
```

## 無名関数(lambda式)

```python
x2 = lambda x : x * 2 #引数 x で x*2 をreturnする関数オブジェクトを返す
x2(4) #-> 8
```

```python
#リストの要素全てに関数を適用する(map)
# map(function, iterable, ...)

nums = [1, 3, 5, 7, 9]
list(map(lambda x : x * 2, nums)) #-> [2, 6, 10, 14, 18]
list(map(lambda x : x * 3, nums)) #-> [3, 9, 15, 21, 27]
```

```python
#リストの要素から任意の要素だけを取り出す(filter)
# filter(function, iterable) 要素に関数を適用し、Trueとなるものだけを返す

nums = [1, 2, 3, 11, 12, 13, 21, 22, 23]
list(filter(lambda x : (x % 2) == 0, nums)) #->[2, 12, 22]
```

```python
#ソートする(sort)
# sorted(iterable [,key] [,reverse])

animal_list = [('ライオン', 58), ('チーター', 110), ('シマウマ', 60), ('トナカイ', 80)]
faster_list = sorted(animal_list, key=lambda ani: ani[1], reverse=True)
print(faster_list) #->[('チーター',110),('トナカイ',80),('シマウマ',60),('ライオン',58)]
```

## デコレータ

```python
#関数の実行前と後に特定の関数を実行する仕組み
#メインで実行する"関数オブジェクトそれ自体"をデコレータ関数からreturnしなくてはいけない

#処理時間を計測するデコレータ
def time_log(func):
    def wrapper(*args, **kwargs):
        import datetime #モジュールを読み込み
        start = datetime.datetime.today()
        print('--- start', func.__name__)
        result = func(*args, **kwargs)
        end = datetime.datetime.today()
        delta = end - start
        print('--- end', func.__name__, delta, 'sec')
    return wrapper

@time_log
def test1():
    import time
    print('sleep 1sec')
    time.sleep(3)

test1()        
```

## イテレータ

```python
#iterable: 反復可能な値、イテレータを生成することができるオブジェクト
range(1, 5)
[2, 4, 5]

#イテレータを得る
iter([2, 4, 5]) #->  <list_iterator object at 0x000001E0D5CF0EB8>

#イテレータから値を取り出す
i = iter([2, 4, 5])
next(i) #-> 2
next(i) #-> 4
next(i) #-> 5
next(i) #-> エラーが発生(StopIteration)
```

## ジェネレータ

```python
#指定数字以下の奇数を返すイテレータを作成
def genOdd(max):
    i = 1
    while i <= max:
        yield i
        i += 2

it = genOdd(30) #最大30までのイテレータオブジェクトを得る
for v in it: print(v, end=",") #要素を取り出す
```

```python
#指定数字以下の素数を返すイテレータを作成
def genPrime(max):
    num = 2
    while (num <= max):
        is_prime = True
        for i in range(2, num):
            if(num % i) == 0:
                is_prime = False
        
        if(is_prime): yield num
        num += 1

it = genPrime(50) #最大50までのイテレータオブジェクトを得る
for i in it: print(i, end=',') #要素を取り出す
```

## 例外処理

```python
s = input('100で割る分母を入力してください。※0以外')
try:
    v = 100 / float(s)
    print(v)
except ValueError as e: #適切な値が入ってこなかった場合
    print(e)
except ZeroDivisionError as e: #値が0で割り算ができない場合
    print(e)
except:
    print('その他のエラー')
finally:
    print('処理を終了します') #エラー有無に関係なく実行される処理
    
#任意のタイミングでエラーを発生させる
raise Exception('hello, error')
```

## モジュール

```python
import hoge #hoge.pyをインポート
from hoge import aaa, bbb, ccc #hoge.pyの中の特定要素を取り込む

import hoge as h #hogeをhという別名で取り込む
from hoge import aaa as a, bbb as b, ccc as c #それぞれa, b, cという別名で取り込む
from hoge import * #要素全てを取り込む

import lib.hoge #異なる階層にあるlib/hoge.pyをインポート
```

```python
#日付計算ができる標準モジュールdatetimeの使い方
import datetime

today = datetime.date.today()
print(today) #->2018-10-15

t = datetime.datetime.now()
print(t.strftime('%Y/%m/%d %H:%M:%S')) #-> 2018/10/15 22:56:54

# %Y -> 西暦4桁
# %m -> 月(2桁)
# %d -> 日付(2桁)
# %H -> 24h表記で時間(2桁)
# %I -> 12h表記で時間(2桁)
# %M -> 分(2桁)
# %S -> 秒(2桁)
# %p -> AM/PM
# %w -> 曜日を表す数字(0:日曜, 1:月曜...6:土曜)
# %a -> 曜日名の短縮形(Sun, Mon, Tue...Sat)
# %% -> 文字'%'

#一週間足す
today + datetime.timedelta(weeks=1) #->　datetime.date(2018, 10, 22)

#3日前
today - datetime.timedelta(days=3) #-> datetime.date(2018, 10, 12)

#日付の差
datetime.date(2018,3,3) - datetime.date(2017,3,3) #-> datetime.timedelta(365)
```

```shell
# PyPI経由で外部モジュールをインストールする
$ pip install パッケージ名, パッケージ名... #パッケージをインストールする
$ pip uninstall パッケージ名 #パッケージをアンインストール
$ pip install -U pip #pip自体をアップデートする
```

## クラス

```python

```

## 継承

```python

```

```python
#多重継承
```

## オーバーライド

```python

```

## ゲッター / セッター

```python

```

## 特殊メソッド

```python

```

## 抽象基底クラス

```python

```