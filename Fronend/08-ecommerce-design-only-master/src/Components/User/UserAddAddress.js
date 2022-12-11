import axios from 'axios';
import React from 'react'
import { useState } from 'react'
import { Row, Col } from 'react-bootstrap'
import { useSelector } from 'react-redux';
import { useNavigate } from 'react-router-dom';
import { Api } from './../../Api/mainHost'
const UserAddAddress = () => {

    const navigate = useNavigate();

    const [adress, setAdress] = useState({
        address_description: "",
        phone_number: '',
        address_type: ''
    })
    const token = useSelector(state => state.auth.token)


    function getAdressDetails(eventInfo) {
        let myAdresses = { ...adress }
        myAdresses[eventInfo.target.name] = eventInfo.target.value
        setAdress(myAdresses)
    }

    async function sendAdressData() {
        let { data } = await axios.post(`${Api}address/add-address`, adress, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        })
        return data
    }

    function sumitAdressForm(e) {
        e.preventDefault()
        sendAdressData()
        navigate('/user/addresses')

    }


    return (
        <form onSubmit={sumitAdressForm} >
            <Row className="justify-content-start ">
                <div className="admin-content-text pb-2">اضافة عنوان جديد</div>
                <Col sm="8">
                    <input
                        type="text"
                        className="input-form d-block mt-3 px-3"
                        placeholder="تسمية العنوان مثلا(المنزل - العمل)"
                        name='address_type'
                        onChange={getAdressDetails}
                    />
                    <textarea
                        className="input-form-area p-2 mt-3"
                        rows="4"
                        cols="50"
                        placeholder="العنوان بالتفصيل"
                        name='address_description'
                        onChange={getAdressDetails}


                    />
                    <input
                        type="text"
                        className="input-form d-block mt-3 px-3"
                        placeholder="رقم الهاتف"
                        name='phone_number'
                        onChange={getAdressDetails}

                    />
                </Col>
            </Row>
            <Row>
                <Col sm="8" className="d-flex justify-content-end ">
                    <button type='submit' className="btn-save d-inline mt-2 ">اضافة عنوان</button>
                </Col>
            </Row>
        </form>
    )
}

export default UserAddAddress
