import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';

const mockLanguages = [
  { id: 1, language_name: 'English' },
  { id: 2, language_name: 'German' },
  { id: 3, language_name: 'French' },
];

export default function NewText() {
  const navigate = useNavigate();
  const [title, setTitle] = useState('');
  const [text, setText] = useState('');
  const [lang, setLang] = useState(mockLanguages[0]?.id || '');

  const handleSubmit = (e) => {
    e.preventDefault();
    navigate('/displayAllTexts');
  };

  return (
    <>
      <p className="pagetitle">{__('api_texts.addNewText')}</p>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="title">{__('api_texts.text-title')}</label>
          <input type="text" className="form-control" id="add-title-field" value={title} onChange={(e) => setTitle(e.target.value)} required />
        </div>
        <div className="form-group">
          <label htmlFor="text">{__('api_texts.text')}</label>
          <textarea className="form-control" id="text" rows="3" value={text} onChange={(e) => setText(e.target.value)} required />
        </div>
        <div className="form-group">
          <label htmlFor="language" className="section-content">{__('api_texts.add-language')}</label>
          <br />
          <select id="lang" value={lang} onChange={(e) => setLang(e.target.value)} className="standartSelect">
            {mockLanguages.map(lang => (
              <option key={lang.id} value={lang.id}>{lang.language_name}</option>
            ))}
          </select>
          <br /><br />
        </div>
        <div className="submit-wrapper-addText">
          <button type="submit" className="approveButton">{__('api_texts.submit')}</button>
        </div>
      </form>
    </>
  );
}
