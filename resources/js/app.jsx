import React from 'react';
import ReactDOM from 'react-dom/client';
import {
    BrowserRouter as Router,
    Routes,
    Route,
    Link,
} from "react-router-dom";

import Login from "./views/Login.jsx";
import OpenTickets from "./views/OpenTickets.jsx";
import ClosedTickets from "./views/ClosedTickets.jsx";
import UserTickets from "./views/UserTickets.jsx";

const appName = import.meta.env.VITE_APP_NAME;

const logout = () => {
    localStorage.removeItem('token');
    location.href = '/login'
};

function App() {
    return (
        <Router>
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <div className="container">
                    <Link className="navbar-brand" to="/">{appName}</Link>

                    <div className="collapse navbar-collapse">
                        <ul className="navbar-nav">
                            <li className="nav-item">
                                <Link className="nav-link" to="/open">Open Tickets</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/closed">Closed Tickets</Link>
                            </li>
                            <li className="nav-item">
                                <button className="nav-link" onClick={logout}>Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div>
                <div className="container mt-4">
                    <Routes>
                        <Route path='/open' element={<OpenTickets />} />
                        <Route path='/closed' element={<ClosedTickets />} />
                        <Route path='/:email/tickets' element={<UserTickets />} />
                        <Route path='/login' element={<Login />} />
                    </Routes>
                </div>
            </div>
        </Router>
    )
}

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<App />);
