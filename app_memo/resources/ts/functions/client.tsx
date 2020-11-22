import Axios, { AxiosInstance, AxiosResponse } from 'axios'

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

type MemoItem = {
  id: number,
  category: number,
  body: string,
}

const baseURL = '/'

const instance: AxiosInstance = Axios.create({
  baseURL,
  timeout: 10000,
})

//全てのTodoを取得
export const fetchTodos = (): Promise<AxiosResponse<Array<TodoItem>>> => {
  return instance.get('/todo/get')
}

//Todoを追加
export const addTodo = (body: string, planed_time: number): Promise<AxiosResponse<TodoItem>> => {
  return instance.post('/todo', {
    author_id: 1,
    status: 1,
    deadline: '2020-11-30 12:15:30',
    actual_time: 0,
    planed_time,
    body,
  })
}

//指定のTodoを更新
export const updateTodo = (todo: TodoItem):void => {
  instance.put(`/todo/${todo.id}`, {
    author_id: todo.author_id,
    status: todo.status,
    deadline: todo.deadline,
    planed_time: todo.planed_time,
    actual_time: todo.actual_time,
    body: todo.body,
  })
}

//全てのMemoを取得
export const getMemos = (): Promise<AxiosResponse<Array<MemoItem>>> => {
  return instance.get('/memo/get')
}

//Todoを追加
export const addMemo = (category_id: number, title: string, body: string): void => {
  instance.post('/memo', {
    category_id,
    title,
    body,
  })
}