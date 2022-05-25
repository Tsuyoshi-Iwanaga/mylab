const list = require('./array')

test('list contains apple', () => {
  expect(list).toContain('apple')
})

test('list(Set) contains orange', () => {
  expect(new Set(list)).toContain('orange')
})