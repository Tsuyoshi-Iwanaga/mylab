<html>
<body>
    <div id="app">
        <div v-if="!loggedIn">
            認証関連<br>
            <button type="button" id="login">ログイン</button>
            <button type="button" id="logout">ログアウト</button>
            <button type="button" id="getUser">ユーザー情報を取得</button>
            <button type="button" id="register">新しいユーザ作る</button>
        </div>
    </div>
    <script src="/js/app.js"></script>
    <script>
    ;(function() {
      function login() {
        axios.get('/sanctum/csrf-cookie')
        .then(response => {
          const url = '/api/login';
          const params = {
            email: 'fukuoka@test.com',
            password: 'fukuoka2020',
          };
          axios.post('/api/login', params)
          .then(response => {
            console.log(response.data.result);
          })
          .catch(error => {
            alert('ログイン失敗');
          });
        });
      }

      function getUser() {
        axios.get('/api/user')
        .then(response => {
          console.log(response.data);
        });
      }

      function logout() {
        axios.post('/api/logout', null)
        .then(response => {
          console.log(response.data.result);
        })
        .catch(error => {
          alert('ログアウト失敗');
        });
      }

      function register() {
        axios.post('/api/register', null)
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          alert('ユーザ作成失敗');
        });
      }

      document.getElementById('login').addEventListener('click', function() {
        login();
      });
      document.getElementById('logout').addEventListener('click', function() {
        logout();
      });
      document.getElementById('getUser').addEventListener('click', function() {
        getUser();
      });
      document.getElementById('register').addEventListener('click', function() {
        register();
      });
    })();
    </script>
</body>
</html>