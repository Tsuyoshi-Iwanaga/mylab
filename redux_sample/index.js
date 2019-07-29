const Redux = require('redux');

const initialState = {
  tasks: []
};

//Reducer
function tasksReducer(state = initialState, action) {
  switch(action.type) {
    case 'ADD_TASK':
      return {
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

//Store
const store = Redux.createStore(tasksReducer);
const unsubscribe = store.subscribe(handleChange);
//unsubscribe();
store.dispatch(addTask('Storeを学ぶ'));

function handleChange() {
  console.log(store.getState());
}
