# JavaScriptの基礎



## 基本的な言語仕様

### 式と文

```javascript
'text'  1  true  1+2
```

```javascript
return 1;  alert('text');
```



### 演算子

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

```javascript
var aaa;
let bbb;
const ccc;
```



### 制御構文

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



### アロー関数

- アロー関数はコンストラクタとしては使えない。
- アロー関数は**this**を引き継ぐ

```javascript
//関数宣言文
var func = function(x, y, z){ ... }

//アロー関数式
var func = (x, y, z)=>{ ... }
```



### オブジェクト指向

- クラスはJavaScriptではただの関数、ただしnewをつけないと呼び出せない。
- 処理の裏では従来と同じくprototypeにメソッドを追加する方法によって実現されている。
- **static**とメソッド名の前に書くとクラスメソッドを宣言できる。
- **extends**を使うとクラスを継承することができる。
- **super()**で親クラスのコンストラクタを、**super.メソッド()**で親クラスのメソッドを呼び出せる。
- クラスは宣言されたブロック内をスコープとして持つ ( let みたいな感じ )
- クラス式で変数にクラスを渡すこともできる。
- コンストラクタに戻り値を指定することができる。この場合はインスタンスを生成しない。

```javascript
class Teki {
    //コンストラクタ
    constructor(name){
        this.name = name;
    }
    //インスタンスメソッド
    attack(){
        console.log(`${this.name}の攻撃!`);
    }
    //クラスメソッド
    static makeTeki(name){
        return new Teki(name)
    }
}

//Tekiクラスを継承
class Boss extends Teki{
    //コンストラクタ
    constructor(name){
        super(name);
        console.log('ボスが現れた!!')
    }
    //メソッドのオーバーライド
    attack(){
        super.attack();
        console.log('毒状態になった!');
    }
}

//インスタンス生成
const slime = new Teki('スライム');
const matal = Teki.makeTeki('はぐれメタル');
const dragon = new Boss('ドラゴン'); //ボスが現れた!!

//メソッド使ってみる
slime.attack(); //スライムの攻撃!
matal.attack(); //はぐれメタルの攻撃!
dragon.attack(); //ドラゴンの攻撃! 毒状態になった!
```



### 例外処理

```javascript

```



### モジュール

```javascript
//export文
export default Module

//import文
import * from Module
```



### 非同期処理

Promise

- Promiseは非同期処理を抽象化するオブジェクト
- Promiseオブジェクトが生成 = 非同期処理の実行。
- 非同期処理内での成功/失敗は**resolve**/**reject**のどちらが呼ばれるかで判定する。
- Promiseオブジェクトは

```javascript
//Promiseを生成する関数
var func = myAsyncFunction() {
    return new Promise((resolve, reject)=>{
        //ここに非同期処理を書く
        //成功したらresolve('success!');
        //失敗したらreject('error!');
    });
};

//Promiseを使う。実行された後の処理を指定する。
func().then((msg)=>{
    console.log(msg);//success!(成功した時に呼ばれる処理)
}).catch((msg)=>{
    console.log(msg);//error!(失敗した時に呼ばれる処理)
})

//その他便利メソッド
Promise.all(iterable)//引数でPromiseを複数渡し、全て成功した時に成功となるPromiseを返す
Promise.race(iterable)//引数でPromiseを複数渡し、最初に完了したPromiseの値を返すPromiseを返す
Promise.resolve(value)//強制的に成功するプロミスを返す
Promise.reject(value)//強制的に失敗するプロミスを返す
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

### CoffeeScript

### gulp

### webpack

### Electron