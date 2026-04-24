import React from 'react';
import { Link } from 'react-router-dom';

export default function SuccessPayment() {
  return (
    <div style={{ textAlign: 'center', padding: '3rem' }}>
      <h1 className="pagetitle">Payment Successful! 🎉</h1>
      <p className="section-content">Thank you for subscribing to LinguaTech Premium.</p>
      <Link to="/home"><button className="approveButton">Go to Home</button></Link>
    </div>
  );
}
