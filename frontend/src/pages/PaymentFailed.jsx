import React from 'react';
import { Link } from 'react-router-dom';

export default function PaymentFailed() {
  return (
    <div style={{ textAlign: 'center', padding: '3rem' }}>
      <h1 className="pagetitle">Payment Failed</h1>
      <p className="section-content">Something went wrong with your payment. Please try again.</p>
      <Link to="/stripe"><button className="standartButton">Try Again</button></Link>
    </div>
  );
}
