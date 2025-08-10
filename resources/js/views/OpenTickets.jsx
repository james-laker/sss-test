import React, {useEffect, useState} from 'react';
import axios from "axios";
import Table from "../components/Table.jsx";
import Echo from '../echo.js';

export default function OpenTickets() {
    let [data, setData] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 3;

    useEffect(() => {
        const token = localStorage.getItem('token');

        axios.get(import.meta.env.VITE_API_URL + '/open', {
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
        const resolvedChannel = Echo.private('update-ticket');

        createChannel.listen('CreateTicket', (ticket) => {
            setData(prev => [...prev, ticket]);
        });

        resolvedChannel.listen('UpdateTicket', (ticket) => {
            setData(prev => prev.filter(t => t.ID !== ticket.ID));
        });

        return () => {
            createChannel.stopListening('CreateTicket');
            resolvedChannel.stopListening('UpdateTicket');
        };
    }, []);

    const indexOfLastItem = currentPage * itemsPerPage;
    const indexOfFirstItem = indexOfLastItem - itemsPerPage;
    const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);

    return (
        <div>
            <h2 className="text-center">Open Tickets</h2>
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
