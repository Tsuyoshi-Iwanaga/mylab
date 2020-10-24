export const inputTask = (task) => ({
  type: 'INPUT_TASK',
  payload: {
    task
  }
});

export const addTask = (task) => ({
  type: 'ADD_TASK',
  payload: {
    task
  }
});

export const registerData = (data) => ({
  type: 'REGISTER_DATA',
  payload: {
    data
  }
});
