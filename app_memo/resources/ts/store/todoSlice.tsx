import { createSlice } from '@reduxjs/toolkit'

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

//actions
export const { fetchAll } = todoSlice.actions

//Reducer
export default todoSlice.reducer;