import React, { useEffect, useState, useCallback } from 'react';
import axios from "axios";
import Table from "../components/Table.jsx";
import Echo from '../echo.js';

export default function ClosedTickets() {
    const [data, setData] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    const token = localStorage.getItem('token');

    const fetchData = useCallback((page) => {
        axios.get(`${import.meta.env.VITE_API_URL}/closed?page=${page}`, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json',
            },
        })
            .then((response) => {
                const { data: items } = response.data;
                setData(items || []);
                setCurrentPage(response.data.meta.current_page);
                setTotalPages(response.data.meta.last_page);
            })
            .catch((err) => console.error('API error', err));
    }, [token]);

    useEffect(() => {
        fetchData(currentPage);
    }, [currentPage, fetchData]);

    useEffect(() => {
        const resolvedChannel = Echo.private('update-ticket');

        resolvedChannel.listen('UpdateTicket', () => {
            fetchData(currentPage);
        });

        return () => {
            resolvedChannel.stopListening('UpdateTicket');
        };
    }, [fetchData, currentPage]);

    return (
        <div>
            <h2 className="text-center">Closed Tickets</h2>
            <Table data={data} />

            <div style={{ textAlign: 'center', marginTop: '20px' }}>
                <button
                    className="btn btn-secondary"
                    disabled={currentPage === 1}
                    onClick={() => setCurrentPage(prev => prev - 1)}
                >
                    Previous
                </button>

                <span style={{ margin: '0 10px' }}>
                    Page {currentPage} of {totalPages}
                </span>

                <button
                    className="btn btn-secondary"
                    disabled={currentPage === totalPages}
                    onClick={() => setCurrentPage(prev => prev + 1)}
                >
                    Next
                </button>
            </div>
        </div>
    );
}
