import { configureStore } from "@reduxjs/toolkit";
import auth from './auth';

export const Store = configureStore({
    reducer: {
        auth: auth
    }
})
