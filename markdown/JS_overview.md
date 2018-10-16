# JavaScriptの整理



## 基本的な言語仕様



### 式と文

<span style="color:green;">評価され値を返すものは**式**</span>

```javascript
'text'  1  true  1+2
```

<span style="color:green;">式を組み合わせて作られた処理の一単位が**文**</span>

```javascript
return 1;  alert('text');
```



### 演算子

<span style="color:green;">データと組み合わせて式を作るもの</span>

算術演算子

```javascript
+  -  /  *  %
```

代入演算子

```javascript
=  +=  -=  /=  *=  %=
```

関係演算子

```javascript
==  !=  ===  !==  >  <  >=  <=
```

単項演算子

```javascript
++i  i++ --i  i--
```

三項演算子

```javascript
条件式 : Trueの時 ? Falseの時
```



### データ型

<span style="color:green;">プログラム上で使うことができるデータの形式</span>

文字列

```javascript
"text"  'text'
```

数値

```javascript
1  1.02
```

真偽値

```javascript
true  false
```

配列

```javascript
var arr1 = new Array("aaa","bbb","ccc");
var arr2 = ['aaa', 'bbb', 'ccc'];
```

オブジェクト(連想配列、ハッシュ)

```javascript
var obj1 = new Object();
var obj2 = {
    "aaa": "test",
    "bbb": 123
};
```



### 変数 / 定数

<span style="color:green;">一時的にデータを保存しておいて、後から再度そのデータにアクセスできるようにラベルをつけたもの</span>

```javascript
var aaa;
let bbb;
const ccc;
```



### 制御構文

<span style="color:green;">式の値によって処理を分岐したりループしたりなど、プログラムの流れを制御するもの</span>

if文

```javascript
a = 20;
if(a >= 10){
    alert(a + "は10以上です");
}else{
    alert(a + "は10より小さいです");
}
```

while文 / do while文

```javascript
//while文
var i = 0;
while(true){
    i++;
    if(i < 2){
        continue;
    }
    alert(i);
    if(i > 5){
        break;
    }
}

//do while文
var i=0;
do{
    alert(i);
    i++;
}while(i < 3);
```

for文

```javascript
var members = ["aaa", "bbb", "ccc", "ddd", "eee", "ddd"];

for(var i=0; i < members.length; i++){
    alert(members[i]);
}
```



### 関数

<span style="color:green;">いくつかの処理を抽象化し、再利用できるようにしたもの</span>

```javascript

```



### オブジェクト指向

<span style="color:green;">オブジェクトごとに処理をまとめてプログラムを構成する手法</span>

クラス

```javascript

```



### 例外処理

<span style="color:green;">プログラム上でエラーが発生した場合にどうするかを事前に指定し、処理が適切に継続するようにすること</span>

```javascript

```



### モジュール

<span style="color:green;">JavaScriptを部品として細かく分割し管理すること</span>

```javascript

```



### 非同期処理

<span style="color:green;">時間がかかる処理Aを行う場合、その終了を待たずに次の処理を進める代わりに、処理Aが終わったタイミングで次はこれをやってねという後続の処理を予め指定しておくこと</span>

Promise

```javascript

```

async/await

```javascript

```



## WebAPI(ブラウザ)



### DOM



### Ajax



### イベント



## サーバサイド(Node.js)



## ライブラリ / フレームワーク / ツール / AltJS



### jQuery



### React.js



### Vue.js



### AngularJS



### TypeScript

JavaScriptで型を使うことができたりAltJS



### CoffeeScript

JavaScriptを簡単にかけるようにしたAltJS



### gulp



### webpack



### Electron