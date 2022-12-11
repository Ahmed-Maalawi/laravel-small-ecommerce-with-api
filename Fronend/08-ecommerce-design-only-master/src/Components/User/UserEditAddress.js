import axios from 'axios'
import React, { useState } from 'react'
import { Row, Col } from 'react-bootstrap'
import { useSelector } from 'react-redux'
import { useLocation, useNavigate } from 'react-router-dom'
import { Api } from './../../Api/mainHost';

const UserEditAddress = () => {
    const navigate =useNavigate()
    const token = useSelector(state => state.auth.token)

    let editAdress = useLocation().state
    console.log(editAdress)

    let [Adress, aditAdress] = useState({
        address_type: editAdress.address_type,
        address_description: editAdress.address_description,
        phone_number: editAdress.phone_number
    })

    function getAdress(eventInfo) {
        let adress = { ...Adress }
        adress[eventInfo.target.name] = eventInfo.target.value
        aditAdress(adress)
    }



    async function updateAdress() {
        let { data } = await axios.post(`${Api}address/update-address/${editAdress.id}`,Adress, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        })
        return data
    }

    function sumitEdit(e) {
        e.preventDefault()
        updateAdress()
        navigate('/user/addresses')
    }




    return (
        <form onSubmit={sumitEdit} >
            <Row className="justify-content-start ">
                <div className="admin-content-text pb-2">تعديل العنوان</div>
                <Col sm="8">
                    <input
                        type="text"
                        className="input-form d-block mt-3 px-3"
                        defaultValue={editAdress.address_type}
                        placeholder="تسمية العنوان مثلا(المنزل - العمل)"
                        name='address_type'
                        onChange={getAdress}
                    />
                    <textarea
                        className="input-form-area p-2 mt-3"
                        rows="4"
                        cols="50"
                        defaultValue={editAdress.address_description}
                        placeholder="العنوان بالتفصيل"
                        name='address_description'
                        onChange={getAdress}
                    />
                    <input
                        type="text"
                        defaultValue={editAdress.phone_number}
                        className="input-form d-block mt-3 px-3"
                        placeholder="رقم الهاتف"
                        name='phone_number'
                        onChange={getAdress}
                    />
                </Col>
            </Row>
            <Row>
                <Col sm="8" className="d-flex justify-content-end ">
                    <button type='submit' className="btn-save d-inline mt-2 ">حفظ تعديل العنوان</button>
                </Col>
            </Row>
        </form>
    )
}

export default UserEditAddress
