import { useNavigate } from 'react-router-dom';
import React from "react";

export default function Table({ data }) {
    const navigate = useNavigate();

    if (!data || data.length === 0) {
        return <p>No data</p>;
    }

    const headers = Object.keys(data[0]).filter(key => key !== 'email');

    return (
        <div>
            <table className='table table-hover'>
                <thead>
                <tr>
                    {headers.map(key => (
                        <th key={key}>{key}</th>
                    ))}
                </tr>
                </thead>
                <tbody>
                {data.map((row, rowIndex) => (
                    <tr key={rowIndex}>
                        {headers.map((key) => (
                            <td
                                key={key}
                                onClick={key === 'Created By'
                                    ? () => navigate(`/${row.email}/tickets`)
                                    : undefined
                                }
                                style={key === 'name' ? { cursor: 'pointer', color: 'blue' } : {}}
                            >
                                {row[key]}
                            </td>
                        ))}
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}
