import React from 'react'
import { Row } from 'react-bootstrap'
import UserAllOrderItem from './UserAllOrderItem'
import { useSelector } from 'react-redux';
const UserAllOrder = () => {
    let userProfile = useSelector((state) => state.auth.userData)

    return (
        <div>
            <div className="admin-content-text pb-4">اهلا  {userProfile.name} </div>
            <Row className='justify-content-between'>
                <UserAllOrderItem />
                <UserAllOrderItem />
                <UserAllOrderItem />
            </Row>
        </div>
    )
}

export default UserAllOrder
