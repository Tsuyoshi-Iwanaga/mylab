import React, { useState, useEffect } from 'react';
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';
import TodoList from '../components/TodoList';
import TodoInput from '../components/TodoInput';
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

const Todo:React.FC = () => {

  const iniPostItems: Array<TodoItem>|null = [];
  const [items, setItems] = useState(iniPostItems);

  useEffect(() => {
    fetchTodos()
      .then((res) => {
        setItems(res.data);
      });
  }, []);

  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
        <div className="container">
            <h2>Todo</h2>
            <div className="row justify-content-center">
                <Main>
                  <TodoInput />
                  <TodoList items={items} />
                </Main>
                <SideNav />
            </div>
        </div>
    </main>
    <Footer />
    </>
  );
}
export default Todo;