import { configureStore } from "@reduxjs/toolkit";
import counterSliceRuducer from './auth';

export const Store = configureStore({
    reducer: {
        counter: counterSliceRuducer
    }
})