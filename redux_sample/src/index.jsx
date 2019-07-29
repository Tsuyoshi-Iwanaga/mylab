import React from 'react';
import ReactDOM from 'react-dom';
import {createStore} from 'redux';

const initialState = {
  task: '',
  tasks: []
};

//Reducer
function tasksReducer(state = initialState, action) {
  switch(action.type) {
    case 'INPUT_TASK':
      return {
        ...state,
        task: action.payload.task
      }
    case 'ADD_TASK':
      return {
        ...state,
        tasks: state.tasks.concat([action.payload.task])
      };
    default:
      return state;
  }
}

//ActionCreator
const addTask = (task) => ({
  type: 'ADD_TASK',
  error: false,
  meta: {},
  payload: {
    task
  }
});

const inputTask = (task) => ({
  type: 'INPUT_TASK',
  error: false,
  meta: {},
  payload: {
    task
  }
});

//Store
const store = createStore(tasksReducer);

//React
function TodoApp({store}) {
  const {task, tasks} = store.getState();
  return (
    <React.Fragment>
      <input type="text" onChange={(e) => store.dispatch(inputTask(e.target.value))} />
      <input type="button" value="add" onClick={() => store.dispatch(addTask(task))} />
      <ul>
        {tasks.map(function(item, i) {
          return (
            <li key={i}>{item}</li>
          );
        })}
      </ul>
    </React.Fragment>
  );
}

function renderApp(store) {
  ReactDOM.render(
    <TodoApp store={store} />,
    document.getElementById('app')
  );
}

const unsubscibe = store.subscribe(() => renderApp(store));
//unsubscribe();
renderApp(store);
