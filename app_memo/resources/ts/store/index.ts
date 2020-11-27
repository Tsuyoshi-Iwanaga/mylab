import { configureStore } from '@reduxjs/toolkit'
import todoReducer from './todoSlice';
import memoReducer from './memoSlice';

export const store = configureStore({
    reducer: {
        todos: todoReducer,
        memos: memoReducer
    }
})

export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch
