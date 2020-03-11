function max(x, y) {
  return x > y ? x : y;
}

function _max(x) {
  return function(y) {
    return x > y ? x : y;
  }
}

console.log(max(1, 2));
console.log(_max(5)(2));

const brightness = [0.2, -0.3, 1.0, -0.5];
const hoge = brightness.map(function(x) { return max(0, x) });

console.log(hoge);