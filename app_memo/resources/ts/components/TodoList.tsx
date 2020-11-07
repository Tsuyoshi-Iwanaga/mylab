import React from 'react';
import TodoItem from './TodoItem';

type TodoItemListProps = {
  items: Array<TodoItem>
}

const TodoList: React.FC<TodoItemListProps> = (props) => {
  if (props.items.length > 0) {
    return (
      <>
      <ul className="todoList" style={{paddingLeft: 0}}>
        {props.items.map((v) => 
          (Number(v.status) !== 4) ? <TodoItem item={v} key={v.id} /> : undefined
        )}
      </ul>
      <p className="small mb-1">完了済</p>
      <ul className="todoList" style={{paddingLeft: 0}}>
        {props.items.map((v) => 
          (Number(v.status) == 4) ? <TodoItem item={v} key={v.id} /> : undefined
        )}
      </ul>
      </>
    )
  } else {
    return <p>No Item...</p>
  }
};
export default TodoList;