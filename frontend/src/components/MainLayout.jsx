import React from 'react';
import Navbar from './Navbar';
import { useAuth } from '../contexts/AuthContext';
import { Link } from 'react-router-dom';

export default function MainLayout({ children }) {
  const { isAuthenticated } = useAuth();

  return (
    <>
      <Navbar />
      <div className="mainContent">
        {!isAuthenticated && (
          <>
            <div style={{ paddingTop: 0, marginTop: '3rem' }} className="displayFlex">
              <div className="horizontal-fill"></div>
              <Link to="/login">
                <button className="standartButton">Login</button>
              </Link>
              <Link to="/register">
                <button className="approveButton">Register</button>
              </Link>
            </div>
          </>
        )}
        {children}
      </div>
      <div className="heightbox"></div>
    </>
  );
}
