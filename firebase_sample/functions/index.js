//firebaseFunctionsSDK
const functions = require('firebase-functions');

//firebaseAdminSDK
const admin = require('firebase-admin');
admin.initializeApp();

//express
const express = require('express');
const app = express();
const cors = require('cors')({origin: true});
app.use(cors);

//ユーザ認証
const anonymousUser = {
  id: "anon",
  name: "Anonymous",
  avatar: ""
}

const chackUser = (req, res, next) => {
  req.user = anonymousUser;

  if(req.query.auth_token !== undefined) {
    let idToken = req.query.auth_token;

    admin.auth().verifyIdToken(idToken).then(decodeIdToken => {
      let authUser = {
        id: decodeIdToken.user_id,
        name: decodeIdToken.name,
        avatar: decodeIdToken.picture
      };
      req.user = authUser;
      next();
    }).catch(error => {
      next();
    });
  } else {
    next();
  }
};

app.use(chackUser);


//========== APIs ==========

function createChannel(cname) {
  let ref = admin.database().ref('channels');
  let date1 = new Date();

  const defaultData = `{
    "messages": {
      "1": {
        "body": "Welcome to hoge",
        "date": "${date1.toJSON()}",
        "user": {
          "avator": "アバター",
          "id": "001",
          "name": "テストユーザ"
        }
      }
    }
  }`;

  ref.child(cname).set(JSON.parse(defaultData));
}

//チャンネルの追加
app.post('/channels', (req, res) => {
  let ref = admin.database().ref('channels');
  let cname = req.body.cname;

  createChannel(cname);

  res.header('Content-Type', 'application/json; charset=utf-8');
  res.status(201).json({result: 'ok'});
});

//チャンネル一覧の取得
app.get('/channels', (req, res) => {

  let ref = admin.database().ref('channels');

  ref.once("value", function(snapshot) {
    let items = [];

    snapshot.forEach(function(childSnapshot) {
      let cname = childSnapshot.key;
      items.push(cname);
    });

    res.header('Content-Type', 'application/json; charset=utf-8');
    res.send(items);
  });
});

//メッセージの追加
app.post('/channels/:cname/messages', (req, res) => {
  let cname = req.params.cname;
  let message = {
    date: new Date().toJSON(),
    body: req.body.body,
    user: req.user
  };
  let ref = admin.database().ref(`channels/${cname}/messages`);
  ref.push(message);
  res.header('Content-Type', 'application/json; charset=utf-8');
  res.status(201).send({result: 'ok'});
});

//メッセージ一覧の取得
app.get('/channels/:cname/messages', (req, res) => {
  let cname = req.params.cname;
  let ref = admin.database().ref(`channels/${cname}/messages`).orderByChild('date').limitToLast(20);

  ref.once('value', function(snapshot){
    let items = [];
    snapshot.forEach(function(childSnapshot) {
      let message = childSnapshot.val();
      message.id = childSnapshot.key;
      items.push(message);
    });
    items.reverse();
    res.header('Content-Type', 'application/json; charset=utf-8');
    res.send({messages: items});
  });
});

//リセット
app.post('/reset', (req, res) => {
  let ref = admin.database().ref(`channels/`);
  ref.remove();

  createChannel('general');

  res.header('Content-Type', 'application/json; charset=utf-8');
  res.status(201).send({result: 'ok'});
});

//exports
exports.app = functions.https.onRequest(app);

/*
<デプロイ>
firebase deploy --only functions

<チャンネル作る>
wsl curl -XPOST -H 'Content-Type:application/json' -d '{\"cname\": \"sample\"}' https://us-central1-app244-001.cloudfunctions.net/app/channels/

<チャンネル一覧取得>
wsl curl https://us-central1-app244-001.cloudfunctions.net/app/channels/

<メッセージを追加>
wsl curl -XPOST -H 'Content-Type:application/json' -d '{\"body\": \"サンプルメッセージ\"}' https://us-central1-app244-001.cloudfunctions.net/app/channels/general/messages

<メッセージを確認>
wsl curl https://us-central1-app244-001.cloudfunctions.net/app/channels/general/messages

<リセット>
wsl curl -XPOST -H 'Content-Type:application/json' -d '{}' https://us-central1-app244-001.cloudfunctions.net/app/reset
*/