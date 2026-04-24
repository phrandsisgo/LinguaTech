import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

export default function Register() {
  const navigate = useNavigate();
  const { login } = useAuth();
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [remember, setRemember] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    login({ id: 2, name, email, status: 'user' });
    navigate('/home');
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="authDisplayFlex">
        <div className="horizontal-fill"></div>
        <div className="leftSideAuth">
          <div>
            <label htmlFor="name" className="section-content">{__('auth.name')}</label>
            <br />
            <input id="name" className="authTextField" type="text" value={name} onChange={(e) => setName(e.target.value)} required autoFocus autoComplete="name" />
          </div>
          <div className="mt-4">
            <label htmlFor="email" className="section-content">{__('auth.email')}</label>
            <br />
            <input id="email" className="authTextField" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required autoComplete="username" />
          </div>
          <div className="mt-4">
            <label htmlFor="password" className="section-content">{__('auth.password')}</label>
            <br />
            <input id="password" className="authTextField" type={showPassword ? 'text' : 'password'} value={password} onChange={(e) => setPassword(e.target.value)} required autoComplete="new-password" />
          </div>
          <div className="mt-4">
            <label htmlFor="password_confirmation" className="section-content">{__('auth.confirm_password')}</label>
            <br />
            <input id="password_confirmation" className="authTextField" type={showPassword ? 'text' : 'password'} value={passwordConfirmation} onChange={(e) => setPasswordConfirmation(e.target.value)} required autoComplete="new-password" />
          </div>
          <div className="mt-2">
            <input type="checkbox" id="show-password" checked={showPassword} onChange={() => setShowPassword(!showPassword)} />
            <label htmlFor="show-password" className="section-content">{__('Show Password')}</label>
          </div>
          <div className="block mt-4">
            <label htmlFor="remember_me" className="inline-flex items-center">
              <input id="remember_me" type="checkbox" checked={remember} onChange={() => setRemember(!remember)} name="remember" />
              <span className="section-content">{__('auth.remember_me')}</span>
            </label>
          </div>
        </div>
        <div className="horizontal-fill"></div>
        <div className="rightSideAuth">
          <div className="flex items-center justify-end mt-4">
            <Link className="sectiontitle" to="/login">{__('auth.already_registered')}</Link>
            <br /><br /><br />
            <button type="submit" className="approveButton">{__('auth.register')}</button>
          </div>
          <p className="section-content maxwidthXY">{__('auth.development_warning')}</p>
        </div>
        <div className="horizontal-fill"></div>
      </div>
    </form>
  );
}
