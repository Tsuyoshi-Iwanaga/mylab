import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { fetchAll } from '../store/todoSlice';
import { RootState } from '../store'
import { fetchTodos } from '../functions/client'
import Header from '../components/Header';
import Main from '../components/Main';
import SideNav from '../components/SideNav';
import Footer from '../components/Footer';
import TodoList from '../components/TodoList';
import TodoInput from '../components/TodoInput';

const Todo:React.FC = () => {

  const dispatch = useDispatch();
  const todos = useSelector((state: RootState) => state.todos)

  useEffect(() => {
    fetchTodos()
    .then((res) => {
        dispatch(fetchAll(res.data))
    })
  }, [dispatch])

  return (
    <>
    {/* <Header /> */}
    <main className="py-4">
      <div className="container">
        <h2>Todo</h2>
        <div className="row justify-content-center">
          <Main>
            <TodoInput />
            <TodoList items={todos} />
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