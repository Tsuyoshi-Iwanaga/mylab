function forEach(items, callback) {
  for(let index = 0; index < items.length; index++) {
    callback(items[index])
  }
}

//Mockが何回呼ばれたか、引数は何か、返り値は何か
const mockCallback = jest.fn(x => 42 + x)
forEach([0, 1], mockCallback)

test('mockFunction', () => {
  expect(mockCallback.mock.calls.length).toBe(2)//mock関数は2回呼ばれる
  expect(mockCallback.mock.calls[0][0]).toBe(0)//mock関数の1回目の呼び出しの引数の1つ目は0である
  expect(mockCallback.mock.calls[1][0]).toBe(1)//mock関数の2回目の呼び出しの引数の1つ目は1である
  expect(mockCallback.mock.results[0].value).toBe(42)//mock関数の1回目の呼び出しの戻り値は42である
})

//コンストラクタで生成されたインスタンスの確認
const mockConstructor = jest.fn(function(name) {
  this.name = name
})
const instance01 = new mockConstructor('tarou')
const instance02 = new mockConstructor('jirou')

test('mockConstructor', () => {
  expect(mockConstructor.mock.instances.length).toBe(2)
  expect(mockConstructor.mock.instances[1].name).toBe('jirou')
})

//Mockの帰り値
const myMock = jest.fn()
// console.log(myMock()) -> undefined
myMock.mockReturnValueOnce(10).mockReturnValueOnce('x').mockReturnValue(true)
// console.log(myMock(), myMock(), myMock(), myMock()) -> 10, x, true, true

const filterTestFn = jest.fn()
filterTestFn.mockReturnValueOnce(true).mockReturnValueOnce(false)
const result = [11, 12].filter(num => filterTestFn(num) )
// console.log(result) -> [11]
// console.log(filterTestFn.mock.calls[0][0]) -> 11
// console.log(filterTestFn.mock.calls[1][0]) -> 12


//こういうソースをテストする場合...モジュールを上書きして決まった値を返すこともできる
// import axios from 'axios'
// class Users {
//   static all() {
//     return axios.get('/users.json').then(res => res.data)
//   }
// }
// export default Users

// import axios from 'axios'
// import Users from './users'
// jest.mock('axios')

// test('should fetch users', () => {
//   const users = [{name: 'Bob'}]
//   const res = {data: users}
//   axios.get.mockResolvedValue(res)
//   return Users.all().then(data => expect(data).toEqual(users))
// })