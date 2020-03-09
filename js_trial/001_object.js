//<基本>コンストラクタでオブジェクトを作る
//===============================================
;(function(){

  function Yuusha(name) {
    this._name = name;
    this._hp = 100;
  }
  
  Yuusha.prototype.greeding = function() {
    console.log(`My name is ${this._name}. / HP is ${this._hp}.`);
  };
  
  Yuusha.prototype.attack = function() {
    this._hp -= 20;
    console.log(`Attack!! hp is ${this._hp}`);
  };
  
  yu01 = new Yuusha('tarou');
  yu02 = new Yuusha('jiro');
  yu01.attack();
  yu01.attack();
  yu01.greeding();
  yu02.greeding();
  console.log('----------------------------------')
})();


// 継承
//===============================================
;(function(){

  function Monster() {
    this._hp = 100;
  };

  Monster.prototype.die = function() {
    console.log('Monster is dead');
  }

  // サブクラスのコンストラクタ
  function Dragon() {
    // 1.親のコンストラクタを使って初期化を行う
    Monster.apply(this, arguments);
  }
  // 2.サブクラスのprototypeにスーパークラスのinstanceを代入する
  // これによって、メンバがない時はスーパークラスに定義されたものを探しに行く
  Dragon.prototype = new Monster();

  // サブクラスにしか存在しないメンバはここで定義する
  Dragon.prototype.attack = function() {
    console.log(`Attack! hp: ${this._hp}`);
  };

  var boss = new Dragon();
  boss.attack();
  boss.die();
  console.log(`boss instanceof Dragon: ${boss instanceof Dragon}`);
  console.log(`boss instanceof Dragon: ${boss instanceof Monster}`);
  console.log('----------------------------------')
})();


//継承2(ES5を使ってちょっと改良)
//===============================================
;(function(){

  function Monster() {
    console.log('call Monster Constructor');
  }

  function Dragon() {
    Monster.apply(this, arguments);
  }
  // 継承時にコンストラクタがコールされてしまうのを防ぐ
  // コンストラクタが差し替わってしまうのを防ぐ
  // Dragon.prototype = new Monster();
  Dragon.prototype = Object.create(Monster.prototype, {
    constructor: {
      value: Dragon
    }
  });

  var zako = new Monster();
  var boss = new Dragon();
  console.log(boss.constructor);
  console.log('----------------------------------')
})();


//継承2(ES6のclassを使う)
//===============================================
;(function(){

  class Monster {
    constructor(name, hp) {
      this._name = name;
      this._hp = hp
    }
    attack() {
      this._hp -= 20;
      console.log(`${this._name}のattack!!`);
    }
  }

  class Dragon extends Monster {
    constructor(name, hp){
      super(name, hp);
      console.log('Boss appear!!');
    }
    greeding() {
      console.log(`${this._name}のHPは${this._hp}です。`);
    }
  }

  var boss = new Dragon('ドラゴン', 3000);
  boss.attack();
  boss.attack();
  boss.greeding();
  console.log('----------------------------------');
})();