import { createSlice } from '@reduxjs/toolkit'

const initialState = {
    address_type: 'work',
    phone_number: "01060332201",
    address_description: 'المعادي',
}

export const adresses = createSlice({
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

export const { login, logOut ,changeUser,changeAdmin,setToken,setUserData } = adresses.actions
let userAdress = adresses.reducer

export default userAdress;
