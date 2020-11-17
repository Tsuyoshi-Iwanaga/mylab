import React from 'react';
import ReactDOM from 'react-dom';
// import { Switch } from 'react-router';
import { BrowserRouter as Router, Switch, Route, Link } from 'react-router-dom';
import Memo from './pages/Memo';
import Todo from './pages/Todo';

function App() {
  return (
    <Router>
      <Route exact path="/memo" component={Memo}></Route>
      <Route exact path="/todo" component={Todo}></Route>
    </Router>
  );
}
export default App;

if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}
