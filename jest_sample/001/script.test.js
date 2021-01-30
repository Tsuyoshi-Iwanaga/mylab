const statement = require('./script')

const plays = {
  "hamlet": {"name": "Hamlet", "type": "tragedy"},
  "as-like": {"name": "As You Like It", "type": "comedy"},
  "othello": {"name": "Othello", "type": "tragedy"},
}

const invoices = [
  {
    "customer": "Bigco",
    "performances": [
      {
        "playID": "hamlet",
        "audience": 55,
      },
      {
        "playID": "as-like",
        "audience": 35,
      },
      {
        "playID": "othello",
        "audience": 40,
      }
    ]
  },
  {
    "customer": "Bigco",
    "performances": [
      {
        "playID": "hamlet",
        "audience": 55,
      },
      {
        "playID": "as-like",
        "audience": 35,
      },
      {
        "playID": "dummy",
        "audience": 40,
      }
    ]
  }
]

describe('test', () => {

  it ('statement correct', () => {
    expect(statement(invoices[0], plays)).toBe(`Statement for Bigco ・Hamlet: $650.00 (55 seats) ・As You Like It: $405.00 (35 seats) ・Othello: $500.00 (40 seats) Amount owed is $1555.00 You earned 47 credits`)
  })

  it ('stetement error', () => {
    expect(() => { statement(invoices[1], plays) }).toThrow(new Error('unknown type: none'))
  })
})