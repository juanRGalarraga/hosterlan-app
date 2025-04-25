import { configureStore } from '@reduxjs/toolkit'
import counterReducer from '@/store/slices/counterSlice'
import authReducer from '@/store/slices/authSlice'

export const store = configureStore({
    reducer: {
        counter: counterReducer,
        auth: authReducer,
    }
})

// Infer the `RootState`,  `AppDispatch`, and `AppStore` types from the store itself
export type RootState = ReturnType<typeof store.getState>
// Inferred type: {posts: PostsState, comments: CommentsState, users: UsersState}
export type AppDispatch = typeof store.dispatch
export type AppStore = typeof store