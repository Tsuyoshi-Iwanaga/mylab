//オブジェクト指向と関数型

//クラス
class Person {
  constructor(firstname, lastname, ssn) {
    this._firstname = firstname
    this._lastname = lastname
    this._ssn = ssn
    this._address = null
    this._dirthday = null
  }

  get ssn() {
    return this._ssn
  }

  get firstname() {
    return this._firstname
  }

  get lastname() {
    return this._lastname
  }

  get ssn() {
    return this._ssn
  }

  get address() {
    return this._address
  }

  get birthday() {
    return this._birthday
  }

  set address(addr) {
    this._address = addr
  }

  toSting() {
    return `Person(${this._firstname}, ${this._lastname})`
  }

  peopleInSameCountry(friends) {
    var result = []
    for(let i in friends) {
      var friend = friends[i]
      if(this.address === friend.address) {
        result.push(friend)
      }
    }
    return result
  }
}

class Student extends Person {
  constructor(firstname, lastname, ssn, school) {
    super(firstname, lastname, ssn)
    this._school = school
  }

  get school() {
    return this._school
  }

  studentsInSameCountryAndSchool(friends) {
    var closeFriends = super.peopleInSameCountry(friends)
    var result = []
    for(let i in closeFriends) {
      var friend = closeFriends[i]
      if(friend.school === this.school) {
        result.push(friend)
      }
    }
    return result
  }
}

var curry = new Student('Haskell', 'Curry', '111-11-1111', 'Penn State')
curry.address = 'US'

var turing = new Student('Alan', 'Turing', '222-22-2222', 'Princeton')
turing.address = 'England' 

var church = new Student('Alonzo', 'Church', '333-33-3333', 'Princeton')
church.address = 'US'

var kleene = new Student('Stephen', 'Kleene', '444-44-4444', 'Princeton')
kleene.address = 'US'

//オブジェクト指向の場合
//クラス内部のインスタンスメソッドを使う(this経由でアクセスする)
church.studentsInSameCountryAndSchool([curry, turing, kleene])

//関数型の場合
//扱うクラスのインスタンスメソッドとは別に存在する外部の関数を組み合わせて操作を行う
function selector(address, school) {
  return function(student) {
    return student.address === address && student.school === school
  }
}
var findStudentsBy = function(friends, selector) {
  return friends.filter(selector)
}
findStudentsBy([curry, turing, church, kleene], selector('US', 'Princeton'))