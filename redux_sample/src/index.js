const Redux = require('redux');

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
const store = Redux.createStore(tasksReducer);
const unsubscribe = store.subscribe(handleChange);
//unsubscribe();
store.dispatch(addTask('Storeを学ぶ'));

function handleChange() {
  console.log(store.getState());
}
