import { createSlice } from '@reduxjs/toolkit'

const initialState = {
    login: false,
    userType: 'user',
    token: '',
    userData: {}
}

export const authentication = createSlice({
    name: 'auth',
    initialState,
    reducers: {
        login: (state) => {
            state.login = true
        },
        logOut: (state, action) => {
            state.login = true
        },
        changeUser: (state) => {
                state.userType = 'user'
        },
        changeAdmin: (state) => {
                state.userType = 'admin'

        },
        setToken: (state, action) => {
            state.token = action.payload
        },
        setUserData: (state, action) => {
            state.userData = action.payload
        },
    },
})

export const { login, logOut ,changeUser,changeAdmin,setToken,setUserData } = authentication.actions
let auth = authentication.reducer

export default auth;
