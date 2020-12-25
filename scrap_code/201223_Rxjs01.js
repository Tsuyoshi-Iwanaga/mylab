var observer1 = {
  next: x => console.log('Observer1 is got a value: ' + x),
  error: err => console.log('Observer1 is got a error: ' + err),
  complete: () => console.log('Observer1 got complete'),
}//データを受け取った時、エラー時、完了時に何をするか

function subscribe_1(observer) {
  observer.next(1)
  observer.next(2)
  observer.next(3)
  observer.complete();
}//observerに対してデータを送る、エラーを通知する、完了を知らせる

subscribe_1(observer1);
//subscribe_1が送るデータの受け取り先にobserver1を指定する