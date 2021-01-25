test('two plus two is four', () => {
  expect(2 + 2).toBe(4)
})

test('object asignment', () => {
  const data = {one: 1}
  data['two'] = 2
  // expect(data).toBe({one: 1, two: 2}) toBe()は厳密な判定なのでPASSしない
  expect(data).toEqual({one: 1, two: 2}) //toEqual()はPASSする
})

test('adding positive numbers is not zero', () => {
  for (let a = 1; a < 10; a++) {
    for (let b = 1; b < 10; b++) {
      //.notで反対のテストを行うこともできる
      expect(a + b).not.toBe(0);
    }
  }
})

test('null', () => {
  const n = null
  expect(n).toBeNull() //Nullか
  expect(n).toBeDefined() //定義されているか
  expect(n).not.toBeUndefined() //Undefinedではない値か
  expect(n).not.toBeTruthy() //trueと判定できるか
  expect(n).toBeFalsy() //falseと判定できるか
})

test('zero', () => {
  const z = 0
  expect(z).not.toBeNull()
  expect(z).toBeDefined()
  expect(z).not.toBeUndefined()
  expect(z).not.toBeTruthy()
  expect(z).toBeFalsy()
})

test('two plus two', () => {
  const value = 2 + 2
  expect(value).toBeGreaterThan(3)
  expect(value).toBeGreaterThanOrEqual(4)
  expect(value).toBeLessThan(5)
  expect(value).toBeLessThanOrEqual(4)

  //toBe and toEqual are equivalent for numbers
  expect(value).toBe(4)
  expect(value).toEqual(4)
})

test('adding floating point numbers', () => {
  const value = 0.1 + 0.2
  // expect(value).toBe(0.3) 丸め込み誤差のため正しく判定できない
  expect(value).toBeCloseTo(0.3) //toBeCloseToを使うと正しく動く
})

test('there is no I in team', () => {
  expect('team').not.toMatch(/I/)
})

test('but there is a "shop" in Christoph', () => {
  expect('shop').toMatch(/shop/)
})

const shoppingList = [
  'diapers',
  'kleenex',
  'trash bags',
  'paper towels',
  'milk',
]
test('the shopping list has milk on it', () => {
  expect(shoppingList).toContain('milk')
  expect(new Set(shoppingList)).toContain('kleenex')
})

function compileAndroidCode() {
  throw new Error('you are using the wrong JDK')
}
test('compiling android goes as expected', () => {
  expect(() => compileAndroidCode()).toThrow()
  expect(() => compileAndroidCode()).toThrow(Error)
  expect(() => compileAndroidCode()).toThrow('you are using the wrong JDK')
  expect(() => compileAndroidCode()).toThrow(/JDK/)
})