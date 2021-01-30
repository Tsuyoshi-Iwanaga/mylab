const createStatementData = require('./createStatementData.js')

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
  return renderPlainText(createStatementData(invoice, plays))

  function renderPlainText(data) {
    let result = `Statement for ${data.customer} `
    
    for (let perf of data.performances) {
      result += `・${perf.play.name}: ${usd(perf.amount)} (${perf.audience} seats) `
    }
    result += `Amount owed is ${usd(data.totalAmount)} `
    result += `You earned ${data.totalVolumeCredits} credits`
    return result;
  }
}

function htmlStatement(invoice, plays) {
  return renderHTML(createStatementData(invoice, plays))

  function renderHTML(data) {
    let result = `<h1>Statement for ${data.customer}</h1> `
    result += "<table>"
    result += "<tr><th>play</th><th>seats</th><th>cost</th></tr>"

    for (let perf of data.performances) {
      result += `<tr><td>${perf.play.name}</td><td>${perf.audience}</td>`
      result += `<td>${usd(perf.amount)}</td></tr>`
    }
    result += "</table>"
    result += `<p>Amount owed is <em>${usd(data.totalAmount)}</em></p>`
    result += `<p>You earned <em>${data.totalVolumeCredits}</em> credits</p>`
    return result
  }
}

function usd(aNumber) {
  return new Intl.NumberFormat("es-US", {style: "currency", currency: "USD", minimumFractionDigits: 2}).format(aNumber / 100)
}

module.exports = statement