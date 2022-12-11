/* eslint-disable react-hooks/exhaustive-deps */
import axios from 'axios'
import React from 'react'
import { Row, Col } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import UserAddressCard from './UserAddressCard'
import { Api } from './../../Api/mainHost';
import { useSelector } from 'react-redux';
import { useState } from 'react'
import { useEffect } from 'react'
const UserAllAddress = () => {

    const token = useSelector(state => state.auth.token)

    const [allAdresses, setAdresses] = useState([])


    let getAdress = async () => {
        let { data } = await axios.get(`${Api}address/all-address`, {
            headers: {
                'Authorization': `Bearer ${token}`
            },
        })
        setAdresses(data.data)
    }
    useEffect(() => {
        getAdress()
    }, [])

    return (
        <div>
            <div className="admin-content-text pb-4">دفتر العنوانين</div>

            {
                allAdresses.length >= 1 ? allAdresses.map((adress, index) => <UserAddressCard key={index} address_type={adress.address_type} phone_number={adress.phone_number} address_description={adress.address_description} id={adress.id} getAdress={getAdress} />) : ''
            }

            <Row className="justify-content-center">
                <Col sm="5" className="d-flex justify-content-center">
                    <Link to="/user/add-address" style={{ textDecoration: "none" }}>
                        <button className="btn-add-address">اضافه عنوان جديد</button>
                    </Link>
                </Col>
            </Row>
        </div>
    )
}

export default UserAllAddress
