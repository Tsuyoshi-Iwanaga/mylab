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
    const play = plays[perf.playID]
    let thisAmount = 0

    switch(play.type) {
      case "tragedy":
        thisAmount = 40000
        if(perf.audience > 30) {
          thisAmount += 1000 * (perf.audience - 30)
        }
        break
      case "comedy":
        thisAmount = 30000
        if(perf.audience > 20) {
          thisAmount += 300 * perf.audience
        }
        break
      default:
        throw new Error(`unknown type: ${play.type}`)
    }

    volumeCredits += Math.max(perf.audience - 30, 0)
    if(play.type === "comedy") volumeCredits += Math.floor(perf.audience / 5)
    result += `・${play.name}: ${format(thisAmount / 100)} (${perf.audience} seats) `
    totalAmount += thisAmount
  }
  result += `Amount owed is ${format(totalAmount/100)} `
  result += `You earned ${volumeCredits} credits`
  return result;
}
module.exports = statement