import React, {useState, useEffect} from 'react';
import TodoList from './TodoList';
import TodoInput from './TodoInput';
import { fetchTodos } from '../functions/client';

type TodoItem = {
  id: number,
  author_id?: string,
  status?: string,
  deadline?: string,
  planed_time?: string,
  actual_time?: string,
  body?: string,
  updated_at?: string,
  created_at?: string,
}

const Main:React.FC = () => {

  const iniPostItems: Array<TodoItem>|null = [];
  const [items, setItems] = useState(iniPostItems);

  useEffect(() => {
    fetchTodos()
      .then((res) => {
        setItems(res.data);
      });
  }, []);

  return (
    <div className="col-md-9">
      <div className="card">
        <div className="card-header">メイン</div>
        <div className="card-body">
          <TodoInput />
          <TodoList items={items} />
        </div>
      </div>
    </div>
  );
}
export default Main;