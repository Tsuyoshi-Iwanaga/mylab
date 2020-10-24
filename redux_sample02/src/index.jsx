import React from 'react';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';
import createSageMiddleWare from 'redux-saga';
import ReactDOM from 'react-dom';
import tasksReducer from './reducers/tasks';
import TodoApp from './containers/TodoApp';
import rootSaga from './saga';

const sagaMiddleware = createSageMiddleWare();
const store = createStore(
  tasksReducer,
  applyMiddleware(sagaMiddleware)
);

sagaMiddleware.run(rootSaga);

ReactDOM.render(
  <Provider store={store}>
    <TodoApp />
  </Provider>,
  document.getElementById('app')
);
