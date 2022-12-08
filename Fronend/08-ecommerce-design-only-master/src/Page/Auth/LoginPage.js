import React from 'react'
import { useState } from 'react'
import { Container, Row, Col } from 'react-bootstrap'
import { useDispatch, useSelector } from 'react-redux'
import { Link, useNavigate } from 'react-router-dom'
import { login, changeUser, changeAdmin, setToken, setUserData } from '../../Redux/auth'
import { Api } from '../../Api/mainHost'
import axios from 'axios'
const LoginPage = () => {

    const navigate = useNavigate();

    let userType = useSelector(state => state.auth.userType)
    let dispatch = useDispatch()

    let [user, setUser] = useState({
        email: "",
        password: ''
    })

    function getUser(eventInfo) {
        let myUser = { ...user }
        myUser[eventInfo.target.name] = eventInfo.target.value
        setUser(myUser)
    }

    async function sendLoginData() {
        if (userType === 'user') {
            let { data } = await axios.post(`${Api}auth/login`, user)
            dispatch(setToken(data.data.access_token))
            dispatch(setUserData(data.data.user))

            if (data.message === 'user login successfully') {
                navigate('/user/allorders')
            }
        }
        if (userType === 'admin') {
            let { data } = await axios.post(`${Api}admin/login`, user)
            dispatch(setToken(data.data.access_token))
            dispatch(setUserData(data.data.user))
            if (data.message === 'admin login successfully') {
                navigate('/admin/allproducts')
            }
        }
    }

    function sumitLogin(e) {
        e.preventDefault()
        sendLoginData()
    }


    return (
        <Container style={{ minHeight: "680px" }}>
            <Row className="py-5 d-flex justify-content-center ">
                <Col sm="12" >
                    <form onSubmit={sumitLogin} className="d-flex flex-column ">
                        <div className='mx-auto'>
                            <label className=" title-login px-2">
                                تسجيل الدخول
                            </label>
                            {userType === 'admin' ? <span onClick={() => dispatch(changeUser())} style={{ cursor: "pointer" }} className="text-danger">
                                الدخول كمستخدم
                            </span> : <span onClick={() => dispatch(changeAdmin())} style={{ cursor: "pointer" }} className="text-danger">
                                الدخول كأدمن
                            </span>}
                        </div>

                        <input
                            placeholder="الايميل..."
                            type="text"
                            className="user-input my-3 text-center mx-auto"
                            name='email'
                            onChange={getUser}
                        />
                        <input
                            placeholder="كلمه السر..."
                            type="password"
                            className="user-input text-center mx-auto"
                            name='password'
                            onChange={getUser}
                        />
                        <button className="btn-login mx-auto mt-4" type='submit'>تسجيل الدخول</button>
                        <label className="mx-auto my-4">
                            ليس لديك حساب ؟{" "}
                            <Link to="/register" style={{ textDecoration: 'none' }}>
                                <span style={{ cursor: "pointer" }} className="text-danger">
                                    اضغط هنا
                                </span>
                            </Link>
                        </label>
                    </form>




                </Col>


            </Row>
        </Container>
    )
}

export default LoginPage
