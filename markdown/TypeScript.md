# TypeScript

**コンパイル**

```typescript
tsc main.ts
```

**静的型付け**

```typescript
var i:number;
var i:number = 10;
var i = 10 //自動でnumber型になる

var x; //明示しないとx:anyになる
x = 10;
x = "hello"

var results:number[]; //配列の型
results = [10, 5, 3]
```

**列挙型**

```typescript
enum Signal {
    Red = 0,
    Blue = 1,
    Yellow = 2
}
enum Signal {
    Green = 5
}

var result: Signal
//if(result === signal.Yellow){...}
//if(resutl === signal['Yellow']){...}
//console.log(Signal[2]) //Yellow
```

**関数**

```typescript
//関数の型付け
function add(a:number, b:number):number {
  return a + b;
}
console.log(add(5, 3))//8

//引数をオプションに
function add2(a:number, b?:number):number {
  if(b) {
    return a + b;
  } else {
    return a + a;
  }
}
console.log(add2(5))//10

//引数にデフォルト値
function add3(a:number, b:number = 10):number {
  return a + b;
}
console.log(add3(5))//15

//アロー関数式
var add4 = (a:number, b:number):number => a + b;
console.log(add4(3,5))//15

//関数のオーバーロード
function add5(a:number, b:number):number;//シグネチャ
function add5(a:string, b:string):string;

function add5(a:any, b:any):any {
    if (typeof a === 'string' && typeof b === 'string') {
        return `${a} ${b}`;
    } else {
        return a + b;
    }
}
console.log(add5('hello', 'world'));//hello world
console.log(add5(1, 3))//4
console.log(add5('hello', 4))//コンパイルエラーになる
```

**クラス**

```typescript
class User { //メンバはpublic, protected, privateが使える
    //name: string;
    //constructor(name:string) {
    //    this.name = name;
    //}
    //　↓このようにコンストラクタは短く書ける
    constructor(public name:string) {
    }
    public sayHi():void {
        console.log(`hi I am ${this.name}`);
    }
}
var tom = new User('Tom')
tom.sayHi()

```

**getter/setter**

```typescript
class User {
  constructor(private _name:string) {//privateでクラス内のみアクセス可
  }
  //ゲッター
  get name() {
    return this._name;
  }
  //セッター
  set name(newValue:string) {
    this._name = newValue;
  }
}
var bob = new User('Bob');
bob.name = 'BoB';
console.log(bob.name);//BoB
```

**クラスの継承**

```typescript
class User {
  //protectedにすると自クラスか継承されたクラスから参照できる。
  constructor(protected _name: string) {
  }
  public sayHi():void {
    console.log(`hi ${this._name}`);
  }
}

class AdminUser extends User {
  private _age:number;
  constructor(_name:string, _age:number) {
    super(_name);
    this._age = _age
  }
  public sayHi():void {
    console.log(`my name ${this._name}`);
    console.log(`my age ${this._age}`);
    super.sayHi();
  }
}

var bob = new AdminUser('bob', 23);
bob.sayHi();
```

**静的メンバ**

```typescript
class User {
  static count:number = 10;
  static showStaicMember():void {
    console.log(User.count);
  }
}
console.log(User.count);//10 静的メンバを参照
User.showStaicMember();//10 静的メソッドを呼ぶ
```

**インターフェース**

```typescript
interface Result {
  a:number;
  b:number;
}

function getTotal(result:Result) {
  return result.a + result.b;
}

var result = {
  a: 32,
  b: 58,
  c: 'hello'
};

console.log(getTotal(result));//90
```

**インターフェースの継承**

```typescript
interface SpringResult {
    a: number;
}
interface FallResult {
    b: number;
}
//インターフェースを複数継承してみる
interface FinalResult extends SpringResult, FallResult {
    final?: number //?をつけると値がなくてもエラーにならない。
}

function getTotal(result:FinalResult) {
    if(result.final) {
        return result.a + result.b + result.final;
    } else {
        return result.a + result.b;
    }
}

var result = {
    a: 32,
    b: 58,
    final: 120
}

console.log(getTotal(result));//210
```

**インターフェースとクラスを組み合わせる**

```typescript
interface GameUser {
  score: number;
  showScore():void;
}

class User implements GameUser {//implementsを使う。
  name: string;
  score: number = 0;//インターフェースで指定されているので必ず実装が必要
  constructor(name:string) {
    this.name = name;
  }
  showScore() {//インターフェースで指定されているので必ず実装が必要
    console.log(`${this.score}`);
  }
}
```

**ジェネリクス**

```typescript
//呼び出し時に型を指定することができる。
function getArray<T>(value:T): T[] {//慣習的にTを使うことが多い
  return [value, value, value];
}
console.log(getArray<number>(3)); //[3,3,3]
console.log(getArray<string>('hello'));//['hello', 'hello', 'hello']
```

**ジェネリクスをクラスで使う**

```typescript
class MyData<T> {
  constructor(public value:T) {}
  getArray():T[] {
    return [this.value, this.value, this.value]
  }
}
var v1 = new MyData<string>('hello');
console.log(v1.getArray());
var v2 = new MyData<number>(234);
console.log(v2.getArray());
```

**ジェネリクスに制約を与える**

```typescript
interface Result {
  a:number;
  b:number;
}
interface FinalResult extends Result {
  c:string;
}

//受け入れるデータ型を指定する
class MyData<T extends Result> {
  constructor(public value:T) {}
  getArray():T[] {
    return [this.value, this.value, this.value]
  }
}
var v3 = new MyData<Result>({a: 32, b:10});
console.log(v3.getArray());
//[ { a: 32, b: 10 }, { a: 32, b: 10 }, { a: 32, b: 10 } ]

var v4 = new MyData<FinalResult>({a: 32, b: 16, c: "hello"});
console.log(v4.getArray());
//[ { a: 32, b: 16, c: 'hello' },{ a: 32, b: 16, c: 'hello' },{ a: 32, b: 16, c: 'hello' } ] ※Resultインターフェースを継承しているのでうまくいく
```

**内部モジュール**

```typescript
module UserModule {//エクスポート
  export var name = 'taguchi';
  export module AddressModule {
    export var zip = '111-1111';
  }
}
```

```typescript
///<reference path="./user.ts" />
import addr = UserModule.AddressModule;//インポート
console.log(addr.zip)
```

```shell
tsc main.js -t ES5 --out main.js
```

**外部モジュール**

```typescript
export var name = "bob"
```

```typescript
import User = require('./user');//拡張子は省略する
console.log(User.name);//bob
```

```shell
tsc -m commonjs #CommonJS方式でコンパイル
```

```shell
tsc -m amd #AMD形式でコンパイル
```