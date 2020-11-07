import React from 'react';
import TodoItem from './TodoItem';

type TodoItemListProps = {
  items: Array<TodoItem>
}

const TodoList: React.FC<TodoItemListProps> = (props) => {
  if (props.items.length > 0) {
    return (
      <ul className="todoList" style={{paddingLeft: 0}}>
        {props.items.map((v) => 
          <TodoItem item={v} key={v.id} />
        )}
      </ul>
    )
  } else {
    return <p>No Item...</p>
  }
};
export default TodoList;