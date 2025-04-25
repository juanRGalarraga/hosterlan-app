import { createSlice, PayloadAction } from '@reduxjs/toolkit';
import { User } from '@/types/models/user';

interface AuthState { user: User | null }
const initialState: AuthState = { user: null };

const authSlice = createSlice({
  name: 'auth',
  initialState,
  reducers: {
    setUser(state, action: PayloadAction<User>) {
      state.user = action.payload;
    },
  },
});

export const { setUser } = authSlice.actions;
export default authSlice.reducer;