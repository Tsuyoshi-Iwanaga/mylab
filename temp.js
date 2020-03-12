function curry(f){
  return function _curry(xs){
      return xs.length < f.length ? function(x){ return _curry(xs.concat([x])); } : f.apply(undefined, xs);
  }([]);
}

var _max = curry(Math.max);

var brightness = [0.2, -0.3, 1.0, -0.5];
brightness = brightness.map(curry(Math.max)(0));

console.log(brightness);

