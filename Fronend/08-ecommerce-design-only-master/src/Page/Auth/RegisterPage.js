import axios from 'axios'
import Joi from 'joi'
import React from 'react'
import { useState } from 'react'
import { Container, Row, Col } from 'react-bootstrap'
import { Link, useNavigate } from 'react-router-dom'
import { Api } from '../../Api/mainHost'

const RegisterPage = () => {

    const navigate = useNavigate();


    let [user, setUser] = useState({
        email: "",
        password: '',
        phone: '',
        password_confirmation: ''
    })

    let registerValidation = () => {
        let form =Joi.object({
            email: Joi.string().email({ tlds: { allow: ['com', 'net'] } }).required,
            password: Joi.string().pattern(new RegExp('^[a-zA-Z0-9]{3,30}$')).required,
            phone: Joi.number().min(11).max(11),
            password_confirmation: Joi.ref('password')

        })

        console.log(form.validate(user))
    }

    function getUser(eventInfo) {
        let myUser = { ...user }
        myUser[eventInfo.target.name] = eventInfo.target.value
        setUser(myUser)
    }

    async function sendLoginData() {
        let { data } = await axios.post(`${Api}auth/register`, user)
        if (data.message === 'user added successfully') {
            navigate('/login')
        }

    }

    function sumitLogin(e) {
        e.preventDefault()
        registerValidation()
        sendLoginData()
    }


    return (
        <Container style={{ minHeight: "680px" }}>
            <Row className="py-5 d-flex justify-content-center hieght-search">
                <Col sm="12" >
                    <form onSubmit={sumitLogin} className="d-flex flex-column " >

                        <label className="mx-auto title-login">تسجيل حساب جديد</label>
                        <input
                            placeholder="اسم المستخدم..."
                            type="text"
                            className="user-input mt-3 text-center mx-auto"
                            name='name'
                            onChange={getUser}
                        />
                        <input
                            placeholder="رقم التليفون"
                            type="text"
                            className="user-input mt-3 text-center mx-auto"
                            name='phone'
                            onChange={getUser}

                        />
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
                        <input
                            placeholder="اعاده كلمه السر ..."
                            type="text"
                            className="user-input mt-3 text-center mx-auto"
                            name='password_confirmation'
                            onChange={getUser}

                        />

                        <button className="btn-login mx-auto mt-4">تسجيل الحساب</button>
                    </form>

                    <label className="mx-auto my-4">
                        لديك حساب بالفعل؟{" "}
                        <Link to="/login" style={{ textDecoration: "none" }}>
                            <span style={{ cursor: "pointer" }} className="text-danger">
                                اضغط هنا
                            </span>
                        </Link>
                    </label>
                </Col>
            </Row>
        </Container>
    )
}

export default RegisterPage
