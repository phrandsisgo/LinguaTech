import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockUser = {
  id: 1, name: 'Test User', email: 'test@example.com',
  credits: 10, subscribed_until: '2025-12-31', subscription_status: 'active', stripe_subscription_id: 'sub_123',
  languages: [
    { id: 1, language_name: 'German' },
    { id: 2, language_name: 'English' },
  ]
};

const mockLanguages = [
  { id: 1, language_name: 'German' },
  { id: 2, language_name: 'English' },
  { id: 3, language_name: 'French' },
];

export default function Profile() {
  const { user, logout } = useAuth();
  const [name, setName] = useState(mockUser.name);
  const [email, setEmail] = useState(mockUser.email);
  const [currentPassword, setCurrentPassword] = useState('');
  const [newPassword, setNewPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [selectedLang, setSelectedLang] = useState('');
  const [showDeleteConfirm, setShowDeleteConfirm] = useState(false);
  const [deletePassword, setDeletePassword] = useState('');

  const handleProfileUpdate = (e) => { e.preventDefault(); alert('Profile updated'); };
  const handlePasswordUpdate = (e) => { e.preventDefault(); alert('Password updated'); };
  const handleAddLanguage = (e) => { e.preventDefault(); alert('Language added'); };
  const handleRemoveLanguage = (id) => { alert('Removed language ' + id); };
  const handleCancelSubscription = (e) => { e.preventDefault(); alert('Subscription cancelled'); };
  const handleDeleteAccount = (e) => { e.preventDefault(); logout(); };

  return (
    <>
      <p className="pagetitle">Einstellungen für das Profil.</p>
      <br /><br />

      <div className="sectionWrapper">
        <p className="sectiontitle">{__('profile.whatLanguagesCanYouAlready')}</p>
        <div className="interestsWrapper">
          {mockUser.languages.map(lang => (
            <div className="langWrapper displayFlex interestsWords" key={lang.id}>
              <p className="centerTextvertical">{lang.language_name}</p>
              <button className="delete-hitbox" onClick={() => handleRemoveLanguage(lang.id)}>
                <img src="/svg-icons/trash-icon.svg" alt={__('profile.deleteIconAlt')} />
              </button>
            </div>
          ))}
        </div>
        <form onSubmit={handleAddLanguage}>
          <label className="section-content">{__('profile.addLanguage')}</label>
          <br />
          <select value={selectedLang} onChange={(e) => setSelectedLang(e.target.value)} className="standartSelect">
            {mockLanguages.map(lang => (
              <option key={lang.id} value={lang.id}>{lang.language_name}</option>
            ))}
          </select>
          <br /><br />
          <input type="submit" value={__('profile.add')} className="approveButton" />
        </form>
      </div>

      <br /><br />
      <section>
        <p className="section-content">{__('profile.update_profile_information_description')}</p>
        <form onSubmit={handleProfileUpdate} className="mt-6 space-y-6 sectionWrapper">
          <div>
            <label htmlFor="name" className="section-content">{__('profile.name')}</label>
            <br />
            <input id="name" type="text" className="authTextField w-full" value={name} onChange={(e) => setName(e.target.value)} required />
          </div>
          <div>
            <label htmlFor="email" className="section-content">{__('profile.email')}</label>
            <br />
            <input id="email" type="email" className="authTextField w-full" value={email} onChange={(e) => setEmail(e.target.value)} required />
          </div>
          <div className="flex items-center gap-4">
            <button type="submit" className="approveButton">{__('profile.save')}</button>
          </div>
        </form>
      </section>

      <br /><br />
      <section>
        <p className="section-content">{__('profile.update_password_description')}</p>
        <form onSubmit={handlePasswordUpdate} className="mt-6 space-y-6 sectionWrapper">
          <div>
            <label className="section-content">{__('profile.current_password')}</label>
            <br />
            <input type="password" className="authTextField w-full" value={currentPassword} onChange={(e) => setCurrentPassword(e.target.value)} />
          </div>
          <div>
            <label className="section-content">{__('profile.new_password')}</label>
            <br />
            <input type="password" className="authTextField w-full" value={newPassword} onChange={(e) => setNewPassword(e.target.value)} />
          </div>
          <div>
            <label className="section-content">{__('profile.confirm_password')}</label>
            <br />
            <input type="password" className="authTextField w-full" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)} />
          </div>
          <button type="submit" className="approveButton">{__('profile.save')}</button>
        </form>
      </section>

      <br /><br />
      <div className="mt-4">
        <h3 className="sectiontitle">{__('profile.subscription_details')}</h3>
        <p className="section-content"><strong>{__('profile.credits_remaining')}</strong> {mockUser.credits}</p>
        <p className="section-content"><strong>{__('profile.subscription_expires_on')}</strong> {mockUser.subscribed_until}</p>
        {mockUser.subscription_status === 'active' ? (
          <form onSubmit={handleCancelSubscription}>
            <button type="submit" className="btn btn-danger">{__('profile.cancel_subscription')}</button>
          </form>
        ) : (
          <Link to="/stripe" className="standartButton" style={{ textDecoration: 'none' }}>{__('profile.renew_subscription')}</Link>
        )}
      </div>

      <br /><br />
      <section className="space-y-6">
        <h2 className="sectiontitle">{__('profile.delete_account')}</h2>
        <p className="section-content">{__('profile.delete_account_description')}</p>
        <button className="standartButton" onClick={() => setShowDeleteConfirm(true)}>{__('profile.delete_account')}</button>

        {showDeleteConfirm && (
          <div className="modal" style={{ display: 'block' }} onClick={(e) => { if (e.target === e.currentTarget) setShowDeleteConfirm(false); }}>
            <div className="modal-content">
              <h2>{__('profile.delete_account_confirmation')}</h2>
              <p>{__('profile.delete_account_description')}</p>
              <input type="password" className="authTextField" placeholder={__('profile.password')} value={deletePassword} onChange={(e) => setDeletePassword(e.target.value)} />
              <div className="mt-6 flex justify-end">
                <button className="standartButton" onClick={() => setShowDeleteConfirm(false)}>{__('profile.cancel')}</button>
                <button className="standartDangerButton" style={{ marginLeft: 12 }} onClick={handleDeleteAccount}>{__('profile.delete_account')}</button>
              </div>
            </div>
          </div>
        )}
      </section>
    </>
  );
}
