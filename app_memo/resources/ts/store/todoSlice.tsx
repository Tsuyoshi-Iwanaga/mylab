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
        },
        update(state, action) {
            return state.map(v => v.id === action.payload.id ? action.payload : v)
        }
    }
})

//actions
export const { fetchAll, add, update} = todoSlice.actions

//Reducer
export default todoSlice.reducer;