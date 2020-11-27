import { createSlice } from '@reduxjs/toolkit'

const initialState: Array<MemoItem> = []

export const memoSlice = createSlice({
    name: 'memo',
    initialState,
    reducers: {
        fetchAll: (state, action) => {
            return [...action.payload]
        },  
    }
})

//action
export const { fetchAll } = memoSlice.actions

//Reducer
export default memoSlice.reducer