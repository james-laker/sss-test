import React from 'react';
import Table from '../components/Table';

const data = [
    { Name: 'test', Role: 'test' },
    { Name: 'test2', Role: 'test2' }
];

export default function Dashboard() {
    return (
        <div className='container'>
            <h2 className='text-center'>Reports</h2>
            <Table data={data} />
        </div>
    );
}
