//async callback
const fetchData = function(callback) {
  setTimeout(function() {
    callback('peanut butter')
  }, 1000)
}

//これだと動かない testメソッド内の処理が終わったらcallbackを待たずにテストが終わる
// test('the data is peanut butter', () => {
//   function callback(data) {
//     expect(data).toBe('peanut butter')
//   }
//   fetchData(callback)
// })

//doneを渡すことで、これが呼ばれるまではテストの終了を待つことができる
//expectが失敗するとエラーがスローされてcatchブロックに移る
test('the data is peanut butter', done => {
  function callback(data) {
    try {
      expect(data).toBe('peanut butter')
      done()
    } catch(error) {
      done(error)
    }
  }
  fetchData(callback)
})

//Promiseの場合

//テストからPromiseを返すとJestはそのPromiseがresolveされるまで待ってくれる
//Promiseがrejectされるとテストも失敗する
const getSuccessPromise = function() {
  return Promise.resolve('success!')//成功するPromise
}
const getFailPromise = function() {
  return Promise.reject('error')//失敗するPromise
}
test('the Success Promise', () => {
  return getSuccessPromise().then(data => {
    expect(data).toBe('success!')
  })
})
test('the Fail Promise', () => {
  return getFailPromise().catch(e => {
    expect(e).toBe('error')
  })
})

//expectに直接非同期処理を渡し、resolves/rejectsマッチャーを使うこともできる
//JestはPromiseがresolve/rejectされるまで待ってくれる
test('the Success Promise02', () => {
  return expect(getSuccessPromise()).resolves.toBe('success!')
})
test('the Fail Promise02', () => {
  return expect(getFailPromise()).rejects.toBe('error')
})

//Async&Awaitの場合
//testにわたす関数の前にasyncを記載するだけ
test('data is success by async', async () => {
  const data = await getSuccessPromise()
  expect(data).toBe('success!')
})

test('success', async () => {
  await expect(getSuccessPromise()).resolves.toBe('success!')
})
test('resolve', async () => {
  await expect(getFailPromise()).rejects.toBe('error')
})