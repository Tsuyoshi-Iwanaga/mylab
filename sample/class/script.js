class Teki {
  constructor(name, hp) {
    this.name = name;
    this.hp = hp;
  }
  attack() {
    console.log(`${this.name}の攻撃`)
  }
}

//継承はextendsをつける
class Dragon extends Teki {
  constructor(name, hp) {
    super(name, hp) //super呼び出し
    console.log('がおー')
  }
  attack() { //オーバーライド
    super.attack();
    console.log('勇者は毒状態になった')
  }
  hello() {
    console.log(`${this.name}のHPは${this.hp}です。`)
  }
}

var boss = new Dragon('ドラゴン', 3000)
boss.attack();
boss.hello();

//prototypeチェーンの確認
console.log(Dragon.prototype.hasOwnProperty('hello')); // true
console.log(Dragon.prototype.hasOwnProperty('attack')); // false
console.log(Object.getPrototypeOf(Dragon.prototype) === Teki.prototype); // true
