import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockLanguages = [
  { id: 1, language_name: 'German' },
  { id: 2, language_name: 'English' },
  { id: 3, language_name: 'French' },
];

const mockUserLanguages = [
  { id: 1, language_name: 'German' },
];

export default function InitiateProfile() {
  const [selectedLang, setSelectedLang] = useState('');

  const handleAddLanguage = (e) => {
    e.preventDefault();
    alert('Language added');
  };

  return (
    <>
      <p className="pagetitle">{__('profile.greatToHaveProfile')}</p>
      <p className="section-content">{__('profile.loadLearningLists')}</p>
      <div className="sectionWrapper">
        <div className="interestsWrapper">
          <p className="sectiontitle">{__('profile.chooseLanguagesToLearn')}</p>
          {mockUserLanguages.map(lang => (
            <div className="langWrapper displayFlex interestsWords" key={lang.id}>
              <p className="centerTextvertical">{lang.language_name}</p>
              <form onSubmit={(e) => { e.preventDefault(); }} className="delete-hitbox">
                <button type="submit"><img src="/svg-icons/trash-icon.svg" alt={__('profile.deleteIconAlt')} /></button>
              </form>
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
          <Link to="/library">
            <button className="standartButton">{mockUserLanguages.length > 0 ? __('profile.continue') : __('profile.skipOption')}</button>
          </Link>
        </form>
      </div>
    </>
  );
}
