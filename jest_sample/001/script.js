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
  }
]

function statement (invoice, plays) {
  let totalAmount = 0
  let volumeCredits = 0
  let result = `Statement for ${invoice.customer} `
  const format = new Intl.NumberFormat("es-US", {style: "currency", currency: "USD", minimumFractionDigits: 2}).format

  for (let perf of invoice.performances) {
    let thisAmount = amountFor(perf)

    volumeCredits += Math.max(perf.audience - 30, 0)
    if(playFor(perf).type === "comedy") volumeCredits += Math.floor(perf.audience / 5)
    result += `・${playFor(perf).name}: ${format(thisAmount / 100)} (${perf.audience} seats) `
    totalAmount += thisAmount
  }
  result += `Amount owed is ${format(totalAmount/100)} `
  result += `You earned ${volumeCredits} credits`
  return result;
}

function amountFor(aPerformance) {
  let result = 0
  switch(playFor(aPerformance).type) {
    case "tragedy":
      result = 40000
      if(aPerformance.audience > 30) {
        result += 1000 * (aPerformance.audience - 30)
      }
      break
    case "comedy":
      result = 30000
      if(aPerformance.audience > 20) {
        result += 300 * aPerformance.audience
      }
      break
    default:
      throw new Error(`unknown type: ${playFor(aPerformance).type}`)
  }
  return result
}

function playFor(aPerformance) {
  return plays[aPerformance.playID] || {name: 'notFound', type: 'none'}
}

module.exports = statement