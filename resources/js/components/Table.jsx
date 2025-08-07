import React from 'react';

export default function Table({ data = []}) {
    return (
        <div>
            <table className='table table-hover'>
                <thead>
                <tr>
                    {Object.keys(data[0] || {}).map((key) => (
                        <th key={key}>{ key }</th>
                    ))}
                </tr>
                </thead>
                <tbody>
                {data.map((row, i) => (
                    <tr key={i}>
                        {Object.values(row).map((value, j) => (
                            <td key={j}>{value}</td>
                        ))}
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}
