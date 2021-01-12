function printPeople(people, selector, printer) {
  people.forEach(function(person) {
    if(selector(person)) {
      printer(person)
    }
  })
}
var inUs = person => person.address === 'US'
printPeople(people, inUs, console.log)

//クロージャ
var outerVar = 'Outer'
function makeInner(params) {
  var innerVar = 'Inner'
  function inner() {
    console.log(`I can see: ${outerVar}, ${innerVar}, and ${params}`)
  }
  return inner()
}
var inner = makeInner('Params')
inner()

//再帰
class Node {
  constructor(val) {
    this._val = val
    this._parent = null
    this._children = []
  }
  isRoot() {
    return !this._parent
  }
  get children() {
    return this._children
  }
  hasChildern() {
    return this._children.length > 0
  }
  get value() {
    return this._val
  }
  set value() {
    this._val = val
  }
  append(child) {
    child._parent = this
    this._children.push(child)
    return this
  }
  toString() {
    return `Node (val: ${this._val}, children:${this._children.length})`
  }
}

class Tree {
  constructor(root) {
    this._root = root
  }
  static map(node, fn, tree = null) {
    node.value = fn(node.value)
    if(tree === null) {
      tree = new Tree(node)
    }
    if(node.hasChildern()) {
      _.map(node.children, function(child) {
        Tree.map(child, fn, tree)
      })
    }
    return tree
  }
  get root() {
    return this._root
  }
}

church.append(rosser).append(turing).appned(kleene)
kleene.append(nelson).appned(constable)
rosser.append(mendelson).append(sacks)
turing.append(gandy)
const church = new Node(new Person('Alonzo', 'Church', '111-11-1111'))