import * as React from 'react';
import * as ReactDOM from 'react-dom';
import {Switch} from 'react-router';
import {BrowserRouter, Redirect, Route} from 'react-router-dom';
import {ChannelList} from './components/';
import {Channel} from './containers';
import {Container} from 'semantic-ui-react';

const routes =
<BrowserRouter>
  <div id="wrappder">
    <ChannelList />
    <main style={{margin: '1rem 0 1rem 16rem'}}>
      <Container>
        <Switch>
          <Route exact={true} path='/channels/:channelName' component={Channel} />
          <Route exact={true} path='/' render={() => <h1>Sample Application</h1>} />
        </Switch>
      </Container>
    </main>
  </div>
</BrowserRouter>;

ReactDOM.render(
  routes,
  document.getElementById('app')
);