import {connect} from 'react-redux';
import TodoApp from '../components/TodoApp';
import {inputTask, addTask} from '../actions/tasks';

function mapStateToProps({task, tasks, data}) {
  return {
    task,
    tasks,
    data,
  };
}

function mapDispatchToProps(dispatch) {
  return {
    addTask(task) {
      dispatch(addTask(task));
    },
    inputTask(task) {
      dispatch(inputTask(task));
    }
  };
}

export default connect(mapStateToProps, mapDispatchToProps)(TodoApp);
