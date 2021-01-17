const plays = {
  "hamlet": {name: "Hamlet", type: "tragedy"},
  "as-like" : {name: "As You Like it" , "type": "comedy"},
  "othello": {name: "Othello", "type": "tragedy"}
}

const invoices = [
  {
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
]

function statement (invoices, plays) {
  let totalAmount = 0
  let volumeCredits = 0
  let result = `Statement for ${invoices.customer}\nj`
  const format = new Intl.NumberFormat("en-US", {style: "currency", currency: "USD", minimumFractionDigits: 2}).format

  for(let perf of invoices[0].performances) {
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
          thisAmount += 10000 + 500 * (perf.audience - 20)
        }
        thisAmount += 300 * perf.audience
        break
      default:
        throw new Error(`unknown type: ${play.type}`)
      }

      //ボリューム特典のポイントを加算
      volumeCredits += Math.max(perf.audience - 30, 0)
      //comedyの時は10人につき、さらにポイントを加算
      if(play.type === "comedy") volumeCredits += Math.floor(perf.audience / 5)
      //注文の内訳を出力
      result += `${play.name}: ${format(thisAmount/100)} (${perf.audience} seats)\n`
      totalAmount += thisAmount
    }
    result += `Amount owed is ${format(totalAmount/100)}\n`
    result += `You earned ${volumeCredits} credits\n`
    return result
}

console.log(statement(invoices, plays))