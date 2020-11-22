import React from 'react';
import ReactDOM from 'react-dom';
// import { Switch } from 'react-router';
import { BrowserRouter as Router, Switch, Route, Link } from 'react-router-dom';
import { Provider } from 'react-redux';
import { store } from './store';

import Memo from './pages/Memo';
import Todo from './pages/Todo';

function App() {
  return (
    <Provider store={store}>
      <Router>
        <Route exact path="/memo" component={Memo}></Route>
        <Route exact path="/todo" component={Todo}></Route>
      </Router>
    </Provider>
  );
}
export default App;

if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}
