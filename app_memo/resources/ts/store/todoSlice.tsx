import { createSlice } from '@reduxjs/toolkit'

const initialState: Array<TodoItem> = []

export const todoSlice = createSlice({
    name: 'todo',
    initialState,
    reducers: {
        fetchAll(state, action) {
            return [...state, ...action.payload]
        },
        add(state, action) {
            return [...state, action.payload]
        }
    }
})

//actions
export const { fetchAll, add } = todoSlice.actions

//Reducer
export default todoSlice.reducer;