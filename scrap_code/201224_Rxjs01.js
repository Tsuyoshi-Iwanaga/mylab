const requestStream = Rx.Observable.returnValue('http://api.github.com/users');

requestStream.subscribe((requestUrl) => {
  const responseStream = Rx.Observable.create((observer) => {
    jQuery.getJSON(requestUrl)
    .done(response => { observer.onNext(response)})
    .fail((jqXHR, status, error) => { observer.onError(error)})
    .always(() => {observer.onCompleted()})
  })
  responseStream.subscribe((response) => {
    //do something with the response
  })
})

const responseMetaStream = requestStream
  .flatMap(x => Rx.Observable.fromPromise(jQuery.getJSON(requestUrl)))
