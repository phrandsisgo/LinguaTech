import React from 'react';
import { Link } from 'react-router-dom';

export default function CancelPayment() {
  return (
    <div style={{ textAlign: 'center', padding: '3rem' }}>
      <h1 className="pagetitle">Payment Cancelled</h1>
      <p className="section-content">You can try again anytime.</p>
      <Link to="/stripe"><button className="standartButton">Back to Pricing</button></Link>
    </div>
  );
}
