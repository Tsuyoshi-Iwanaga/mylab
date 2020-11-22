import { createSlice } from '@reduxjs/toolkit'
import { fetchTodos } from '../functions/client'
import { AppDispatch } from '../store';

const initialState: Array<TodoItem> = []

export const todoSlice = createSlice({
    name: 'todo',
    initialState,
    reducers: {
        fetchAll(state, action) {
            return [...state, ...action.payload]
        }
    }
})

export function fetchAllTodosAsync(dispatch: AppDispatch) {
    try {
        fetchTodos()
        .then((res) => {
            dispatch(fetchAll(res.data))
        })
    } catch(err) {
        console.log(err)
    }
}

//actions
export const { fetchAll } = todoSlice.actions

//Reducer
export default todoSlice.reducer;