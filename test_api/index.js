const express = require('express')
const bodyParser = require('body-parser')
const app = express()

app.listen(8888);

app.use(bodyParser.json())
app.use((req, res, next) => {
  res.header('Access-Controll-Allow-Origin', '*')//CORSの許可 本番では使わない
  res.header('Access-Controll-Allow-Header', 'Origin, X-Requested-With, Content-Type, Accept')
  next();
})

const users = [
  { id: 1, name: 'testUser01', email: 'test01@gmail.com' },
  { id: 2, name: 'testUser02', email: 'test02@gmail.com' },
  { id: 3, name: 'testUser03', email: 'test03@gmail.com' },
]

app.get('/users', (req, res) => {
  res.send(JSON.stringify(users))
})

app.get('/users/:id', (req, res) => {
  const requestedUser = users.find((v, i) => v.id === Number(req.params.id))
  res.send(JSON.stringify(requestedUser))
})

app.post('/users', (req, res) => {
  users.push(req.body)
  res.end();
})

app.post('/users/:id', (req, res) => {
  users.forEach((v, i) => {
    if(v.id === Number(req.params.id)) {
      users[i] = req.body
    }
  })
  res.end()
})

app.delete('/users/:id', (req, res) => {
  users.forEach((v, i) => {
    if(v.id === Number(req.params.id)) {
      users.splice(i, 1)
    }
  })
  res.end()
})

//=== TestApi使い方 ===

// User一覧を得る
// curl -s -X GET http://localhost:8888/users

// 特定のUserを得る
// curl -s -X GET http://localhost:8888/users/1

// 新規ユーザの追加
// curl -s -X POST -H 'Content-Type: application/json' -d '{ "id": 4, "name": "user04", "email": "test04@gmail.com" }' http://localhost:8888/users 

// ユーザの更新
// curl -s -X POST -H 'Content-Type: application/json' -d '{ "id": 4, "name": "user04-2", "email": "test04-2@gmail.com" }' http://localhost:8888/users/4

// ユーザ削除
// curl -s -X DELETE http://localhost:8888/users/4