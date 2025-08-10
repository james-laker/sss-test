import React, {useEffect, useState} from 'react';
import axios from "axios";
import Table from "../components/Table.jsx";
import Echo from '../echo.js';
import { useParams } from 'react-router-dom';

export default function OpenTickets() {
    let [data, setData] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 3;
    const { email } = useParams();

    useEffect(() => {
        const token = localStorage.getItem('token');

        axios.get(import.meta.env.VITE_API_URL + `/users/${email}/tickets`, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json',
            },
        })
            .then((response) => {
                setData(response.data.data)
            })
            .catch((err) => console.error('API error', err));
    }, []);

    useEffect(() => {
        const createChannel = Echo.private('create-ticket');

        createChannel.listen('CreateTicket', (ticket) => {
            if (ticket.email === email) {
                setData(prev => [...prev, ticket]);
            }
        });

        return () => {
            createChannel.stopListening('CreateTicket');
        };
    }, []);

    const indexOfLastItem = currentPage * itemsPerPage;
    const indexOfFirstItem = indexOfLastItem - itemsPerPage;
    const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);

    return (
        <div>
            <h2 className="text-center">Tickets for {email}</h2>
            <Table data={currentItems} />
            <div style={{ textAlign: 'center', marginTop: '20px' }}>
                <button className='btn btn-secondary' disabled={currentPage === 1} onClick={() => setCurrentPage(prev => prev - 1)}>Previous</button>
                <span style={{ margin: '0 10px' }}>
                    Page {currentPage} of {Math.ceil(data.length / itemsPerPage)}
                </span>
                <button className='btn btn-secondary' disabled={currentPage === Math.ceil(data.length / itemsPerPage)} onClick={() => setCurrentPage(prev => prev + 1)}>Next</button>
            </div>
        </div>
    );
}
