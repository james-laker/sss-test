import React from 'react';
import Table from '../components/Table';

const data = [
    { Name: 'James', Role: 'Admin' },
    { Name: 'Chloe', Role: 'User' }
];

export default function Dashboard() {
    return (
        <div className='container'>
            <h2 className='text-center'>Dashboard</h2>
            <Table data={data} />
        </div>
    );
}
