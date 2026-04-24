import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockTexts = [
  { id: 1, title: 'German Story', language_code: 'DE', language_name: 'German', created_by: 1, updated_at: '2024-01-15' },
  { id: 2, title: 'French Poem', language_code: 'FR', language_name: 'French', created_by: 1, updated_at: '2024-01-14' },
  { id: 3, title: 'My Text', language_code: 'EN', language_name: 'English', created_by: 2, updated_at: '2024-01-13' },
];

export default function DisplayAllTexts() {
  const { user } = useAuth();
  const [showPublic, setShowPublic] = useState(false);
  const [openLangs, setOpenLangs] = useState({});
  const currentUserId = 2;

  const toggleLang = (code) => {
    setOpenLangs(prev => ({ ...prev, [code]: !prev[code] }));
  };

  const ownTexts = mockTexts.filter(t => t.created_by === currentUserId);
  const publicTexts = mockTexts.filter(t => t.created_by === 1);

  return (
    <div className="titleMargin">
      <div className="toggle-wrapper">
        <input type="checkbox" id="toggleButton" className="toggle-checkbox" checked={showPublic} onChange={() => setShowPublic(!showPublic)} />
        <label htmlFor="toggleButton" className="toggle-label">
          <span className="toggle-inner"></span>
          <span className="toggle-on">{__('library.own')}</span>
          <span className="toggle-off">{__('library.public')}</span>
        </label>
      </div>

      <p className="pagetitle">{__('api_texts.allAvailableTexts')}</p>
      <Link to="/addText" className="section-content">{__('api_texts.addNewText')}</Link>

      {!showPublic && (
        <div id="privateTexts">
          <div className="text-container">
            {ownTexts.map(text => (
              <Link to={`/textShow/${text.id}`} key={text.id}>
                <div className="Texts-Card">
                  <p className="cardTitle">{text.title}</p>
                  <div className="displayFlex">
                    <p>{text.language_name}</p>
                    <div className="horizontal-fill"></div>
                    <p>{text.updated_at}</p>
                  </div>
                  <br />
                </div>
              </Link>
            ))}
          </div>
        </div>
      )}

      {showPublic && (
        <div id="publicTexts">
          {['DE', 'FR', 'RU', 'EN', 'PT'].map(lang => {
            const langTexts = publicTexts.filter(t => t.language_code === lang);
            if (langTexts.length === 0) return null;
            return (
              <div className="language-spez-text" key={lang}>
                <button className="language-button" onClick={() => toggleLang(lang)}>
                  <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" className={`bi bi-arrow-right-short ${openLangs[lang] ? 'arrow-Right' : ''}`} viewBox="0 0 16 16">
                    <path fillRule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                  </svg>
                  <p>{__('api_texts.' + lang.toLowerCase())}</p>
                </button>
                <div id={lang} style={{ display: openLangs[lang] ? '' : 'none' }} className="text-container">
                  {langTexts.map(text => (
                    <Link to={`/textShow/${text.id}`} key={text.id}>
                      <div className="Texts-Card">
                        <p>{text.title}</p>
                        <p>{text.language_name}</p>
                        <br />
                      </div>
                    </Link>
                  ))}
                </div>
              </div>
            );
          })}
        </div>
      )}
    </div>
  );
}
