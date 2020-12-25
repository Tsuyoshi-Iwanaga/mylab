// observable -> subscribe関数 -> observer(next, error, complete)
const observable_a = {
  subscribe: function (observer) {
    observer.next(1);
    observer.next(2);
    observer.next(3);
    observer.complete();
  }
}


// ===== Rxjs 1 ===== //
Rx = require('./rx.min.js');

function subscribe_2(observer) {
  observer.next(1)
  observer.next(2)
  observer.next(3)
  observer.complete()
}

//Observableオブジェクトを作る その際に引数でsubscribe関数を渡す
var observable_2 = Rx.Observable.create(subscribe_2);

//observerオブジェクト、データが外から渡された時に何をするか
var observer_2 = {
  next: x => console.log('Observer2 got a value: ' + x),
  error: err => console.log('Observer2 got an error: ' + err),
  complete: () => console.log('Observer2 got Complete'),
}

//事前に登録されたSubscribe関数にobserverを渡す
//つまりデータの送り先としてobserver_2を指定したということ
observable_2.subscribe(observer_2);


// ===== Rxjs 2 ===== //
const observable_3 = Rx.Observable.of([1, 2, 3]);//可変長データを元にObservableを作る

const observer_3 = {
  next: x => console.log('Observer3 got a value: ' + x),
  error: err => console.log('Observer3 got an error: ' + err),
  complete: () => console.log('Observer3 got Complete'),
}

observable_3.subscribe(observer_3);
// createではなくofで可変長データからobservableを作った。
// Subscribe関数は作らなかった
// ofで作ったObservableは初めからSubscribe関数を保持していた


//省略記法
Rx.Observable.of(1, 2, 3).subscribe(x => console.log('The observer got a value:' + a))
// ObservableはSubscribe関数をもつ(データの送り先を指定する関数)
// ObservableはcreateもしくはCreation Operatorを使って作る
// ObservableのSubscribe関数には直接関数を渡せる(next, error, complete)

//別にRx.jsは非同期を行うライブラリではない。
//普通に書くと難しい非同期処理をシンプルに記述できるライブラリと考えるのが良さそう
//例) 1秒ごとに流れてくる数字のうち偶数だけを足す。随時それを後ろに!!をつけて画面に出力する。
Rx.Observable.interval(1000)
  .filter(x => x % 2 === 0)
  .scan((account, current) => account + current, 0)
  .map(x => String(x) + '!!')
  .subscribe(x => console.log(x));

//RxJS 6.x版
Rx.Observable.interval(1000)
  .pipe(
    filter(x => x % 2 === 0),
    map(x => String(x) + '!!'),
  )
  .subscribe()

//Subscription
const subscription = Rx.Observable.interval(1000)
  .filter(x => x % 2)
  .scan((acc, curr) => acc + curr, 0)
  .map(x => String(x) + '!!')
  .subscribe(x => console.log(x))

setTimeout(function() {
  //途中でとめる
  subscription.unsubscribe();
}, 10000)

const button = document.querySelector('button')
Rx.Observable.fromEvent(button, 'click')
  .subscribe(event => {console.log('clicked!!')})