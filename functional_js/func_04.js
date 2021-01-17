const plays = {
  "hamlet": {name: "Hamlet", type: "tragedy"},
  "as-like" : {name: "As You Like it" , "type": "comedy"},
  "othello": {name: "Othello", "type": "tragedy"}
}

const invoices = {
    "customer": "BigCo",
    "performances": [
      {
        playID: "hamlet",
        audience: 55,
      },
      {
        playID: "as-like",
        audience: 35,
      },
      {
        playID: "othello",
        audience: 40,
      }
    ]
  }

function statement(invoices, plays) {
  let totalAmount = 0
  let volumeCredits = 0
  let result = `Statement for ${invoices.customer}\n`
  const format = new Intl.NumberFormat("en-US", { style: "currency", currency: "USD", minimumFractionDigits: 2 }).format

  for (let perf of invoices.performances) {
    //ボリューム特典のポイントを加算
    volumeCredits += Math.max(perf.audience - 30, 0)
    //comedyの時は10人につき、さらにポイントを加算
    if (playFor(perf).type === "comedy") volumeCredits += Math.floor(perf.audience / 5)
    //注文の内訳を出力
    result += `${playFor(perf).name}: ${format(amountFor(perf) / 100)} (${perf.audience} seats)\n`
    totalAmount += amountFor(perf)
  }
  result += `Amount owed is ${format(totalAmount / 100)}\n`
  result += `You earned ${volumeCredits} credits\n`
  return result
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
        result += 10000 + 500 * (aPerformance.audience - 20)
      }
      result += 300 * aPerformance.audience
      break
    default:
      throw new Error(`unknown type: ${playFor(aPerformance).type}`)
  }
  return result
}

function playFor(aPerformance) {
  return plays[aPerformance.playID]
}

console.log(statement(invoices, plays))