import React, { useEffect, useState, useCallback } from 'react';
import axios from "axios";
import Table from "../components/Table.jsx";
import Echo from '../echo.js';
import { useParams } from 'react-router-dom';

export default function OpenTickets() {
    const [data, setData] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const { email } = useParams();

    const token = localStorage.getItem('token');

    const fetchData = useCallback((page) => {
        axios.get(`${import.meta.env.VITE_API_URL}/users/${email}/tickets?page=${page}`, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json',
            },
        })
            .then((response) => {
                const { data: items, meta } = response.data;
                setData(items || []);
                setCurrentPage(response.data.meta.current_page);
                setTotalPages(response.data.meta.last_page);

                if ((items || []).length === 0 && page > 1) {
                    setCurrentPage(prev => Math.max(prev - 1, 1));
                }
            })
            .catch((err) => console.error('API error', err));
    }, [token, email]);

    useEffect(() => {
        fetchData(currentPage);
    }, [currentPage, fetchData]);

    useEffect(() => {
        const createChannel = Echo.private('create-ticket');

        createChannel.listen('CreateTicket', (ticket) => {
            if (ticket.email === email) {
                fetchData(1);
            }
        });

        return () => {
            createChannel.stopListening('CreateTicket');
        };
    }, [email, fetchData]);

    return (
        <div>
            <h2 className="text-center">Tickets for {email}</h2>
            <Table data={data} />
            <div style={{ textAlign: 'center', marginTop: '20px' }}>
                <button
                    className='btn btn-secondary'
                    disabled={currentPage === 1}
                    onClick={() => setCurrentPage(prev => prev - 1)}
                >
                    Previous
                </button>
                <span style={{ margin: '0 10px' }}>
                    Page {currentPage} of {totalPages}
                </span>
                <button
                    className='btn btn-secondary'
                    disabled={currentPage === totalPages}
                    onClick={() => setCurrentPage(prev => prev + 1)}
                >
                    Next
                </button>
            </div>
        </div>
    );
}
