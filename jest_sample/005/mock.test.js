//モック
//1. モック関数を使う
function forEach(items, callback) {
  for(let index = 0; index < items.length; index++) {
    callback(items[index])
  }
}

const mockCallback = jest.fn(x => 42 + x)
forEach([0, 1], mockCallback)

test ('mockFunction', () => {
  expect(mockCallback.mock.calls.length).toBe(2)//mock関数は2回呼ばれる
  expect(mockCallback.mock.calls[0][0]).toBe(0)//mock関数の1回目の呼び出しの引数の1つ目は0である
  expect(mockCallback.mock.calls[1][0]).toBe(1)//mock関数の2回目の呼び出しの引数の1つ目は1である
  expect(mockCallback.mock.results[0].value).toBe(42)//mock関数の1回目の呼び出しの戻り値は42である
})
