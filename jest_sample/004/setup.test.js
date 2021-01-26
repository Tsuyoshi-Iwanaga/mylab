//セットアップとティアダウン

beforeEach(() => {
  //すべてのテストの実行前に毎回実行される
})

beforeAll(() => {
  //1回だけ実行される
})

test('setUp test', () => {
  expect(1 + 1).toBe(2)
})

afterEach(() => {
  //すべてのテストの実行後に毎回実行される
})

afterAll(() => {
  //最後に1回だけ実行される
})

//describeでテストをまとめることができる
describe('matching cities to foods', () => {
  beforeEach(() => {
  })

  test('test001', () => {
    expect(2 + 3).toBe(5)
  })

  test('test002', () => {
    expect(3 + 3).toBe(6)
  })
})