import { configureStore } from "@reduxjs/toolkit";
import auth from './auth';
import userAdress from './userAdress';
export const Store = configureStore({
    reducer: {
        auth: auth,
        userAdress:userAdress
    }
})
