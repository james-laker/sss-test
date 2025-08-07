import React from 'react';
import ReactDOM from 'react-dom/client';
import {
    BrowserRouter as Router,
    Routes,
    Route,
    Link,
} from "react-router-dom";

import Dashboard from "./views/Dashboard.jsx";
import Reports from "./views/Reports.jsx";

const appName = import.meta.env.VITE_APP_NAME;

function App() {
    return (
        <Router>
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <div className="container">
                    <Link className="navbar-brand" to="/">{appName}</Link>

                    <div className="collapse navbar-collapse">
                        <ul className="navbar-nav">
                            <li className="nav-item">
                                <Link className="nav-link" to="/">Dashboard</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div>
                <div className="container mt-4">
                    <Routes>
                        <Route path='/' element={<Dashboard />} />
                    </Routes>
                </div>
            </div>
        </Router>
    )
}

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<App />);
