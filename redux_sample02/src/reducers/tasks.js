const initialState = {
  task: '',
  tasks: [],
  data: [],
};

export default function tasksReducer(state = initialState, action) {
  switch(action.type) {
    case 'INPUT_TASK':
      return {
        ...state,
        task: action.payload.task
      };
    case 'ADD_TASK':
      return {
        ...state,
        tasks: state.tasks.concat([action.payload.task])
      };
    case 'REGISTER_DATA':
      return {
        ...state,
        data: state.data.concat(action.payload.data)
      }
    default:
      return state;
  }
}
