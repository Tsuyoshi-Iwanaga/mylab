const devide = require('./devide')

test('devide 4 / 2 equal to 2', () => {
  expect(devide(4, 2)).toBe(2)
})

test('devide by 0 raise Error', () => {
  expect(() => devide(1, 0)).toThrow()
})