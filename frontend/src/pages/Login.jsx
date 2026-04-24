import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

export default function Login() {
  const navigate = useNavigate();
  const { login } = useAuth();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [remember, setRemember] = useState(false);
  const [error, setError] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    setError('');
    // Mock login
    login({ id: 1, name: 'Test User', email, status: 'user' });
    navigate('/home');
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="authDisplayFlex">
        <div className="horizontal-fill"></div>
        <div className="leftSideAuth">
          <p className="pagetitle">{__('auth.login')}</p>
          <div>
            <label htmlFor="email" className="section-content">{__('auth.email')}</label>
            <br />
            <input id="email" className="authTextField" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required autoComplete="username" />
          </div>
          <div className="mt-4">
            <label htmlFor="password" className="section-content">{__('auth.password')}</label>
            <br />
            <input id="password" className="authTextField" type={showPassword ? 'text' : 'password'} value={password} onChange={(e) => setPassword(e.target.value)} required autoComplete="current-password" />
          </div>
          <div className="mt-2">
            <input type="checkbox" id="show-password" checked={showPassword} onChange={() => setShowPassword(!showPassword)} />
            <label htmlFor="show-password" className="section-content">{__('auth.show_password')}</label>
          </div>
          <div className="block mt-4">
            <label htmlFor="remember_me" className="inline-flex items-center">
              <input id="remember_me" type="checkbox" checked={remember} onChange={() => setRemember(!remember)} name="remember" />
              <span className="section-content">{__('auth.remember_me')}</span>
            </label>
          </div>
        </div>
        <div className="horizontal-fill"></div>
        <div className="items-center justify-end mt-4 rightSideAuth">
          <br /><br />
          <Link className="sectiontitle" to="/register">{__('auth.no_account_yet')}</Link>
          <br /><br />
          <Link className="sectiontitle" to="/forgot-password">{__('auth.forgot_password')}</Link>
          <br /><br /><br />
          <button type="submit" className="approveButton">{__('auth.log_in')}</button>
        </div>
        <div className="horizontal-fill"></div>
      </div>
    </form>
  );
}
