import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';

export default function ForgotPassword() {
  const [email, setEmail] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    alert('Password reset link sent!');
  };

  return (
    <div>
      <p className="pagetitle">Forgot Password</p>
      <form onSubmit={handleSubmit}>
        <label>Email</label>
        <input type="email" className="authTextField" value={email} onChange={(e) => setEmail(e.target.value)} required />
        <br /><br />
        <button type="submit" className="approveButton">Send Reset Link</button>
      </form>
      <br />
      <Link to="/login">Back to Login</Link>
    </div>
  );
}
