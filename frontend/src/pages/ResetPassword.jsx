import React, { useState } from 'react';
import { Link } from 'react-router-dom';

export default function ResetPassword() {
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (password !== confirmPassword) {
      alert('Passwords do not match');
      return;
    }
    alert('Password reset successful!');
  };

  return (
    <div>
      <p className="pagetitle">Reset Password</p>
      <form onSubmit={handleSubmit}>
        <label>New Password</label>
        <input type="password" className="authTextField" value={password} onChange={(e) => setPassword(e.target.value)} required />
        <br /><br />
        <label>Confirm Password</label>
        <input type="password" className="authTextField" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)} required />
        <br /><br />
        <button type="submit" className="approveButton">Reset Password</button>
      </form>
      <br />
      <Link to="/login">Back to Login</Link>
    </div>
  );
}
