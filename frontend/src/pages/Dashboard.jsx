import React from 'react';
import { Link } from 'react-router-dom';

export default function Dashboard() {
  return (
    <div className="py-12">
      <div style={{ maxWidth: '80rem', margin: '0 auto', padding: '0 1.5rem' }}>
        <div style={{ backgroundColor: 'white', overflow: 'hidden', borderRadius: '0.5rem', boxShadow: '0 1px 3px rgba(0,0,0,0.1)' }}>
          <div style={{ padding: '1.5rem', color: '#374151' }}>
            <p>You're logged in!</p>
            <Link to="/home"><button className="standartButton">Go to Home</button></Link>
          </div>
        </div>
      </div>
    </div>
  );
}
