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

function statement (invoice) {
  let result = `Statement for ${invoice.customer} `
  
  for (let perf of invoice.performances) {
    result += `・${playFor(perf).name}: ${usd(amountFor(perf))} (${perf.audience} seats) `
  }
  result += `Amount owed is ${usd(totalAmount(invoice))} `
  result += `You earned ${totalVolumeCredits(invoice)} credits`
  return result;
}

function totalAmount(invoice) {
  let result = 0
  for (let perf of invoice.performances) {
    result += amountFor(perf)
  }
  return result
}

function totalVolumeCredits(invoice) {
  let result = 0
  for (let perf of invoice.performances) {
    result += volumeCreditsFor(perf)
  }
  return result
}

function usd(aNumber) {
  return new Intl.NumberFormat("es-US", {style: "currency", currency: "USD", minimumFractionDigits: 2}).format(aNumber / 100)
}

function volumeCreditsFor(aPerformance) {
  let result = 0
  result += Math.max(aPerformance.audience - 30, 0)
  if(playFor(aPerformance).type === "comedy") result += Math.floor(aPerformance.audience / 5)
  return result
}

function playFor(aPerformance) {
  return plays[aPerformance.playID] || {name: 'notFound', type: 'none'}
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

module.exports = statement