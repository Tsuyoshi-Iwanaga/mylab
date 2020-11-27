import { createSlice } from '@reduxjs/toolkit'

const initialState: Array<MemoItem> = []

export const memoSlice = createSlice({
    name: 'memo',
    initialState,
    reducers: {
        fetchAll(state, action) {
            return [...action.payload]
        },
        add(state, action) {
            return [action.payload, ...state]
        }
    }
})

//action
export const { fetchAll, add } = memoSlice.actions

//Reducer
export default memoSlice.reducer