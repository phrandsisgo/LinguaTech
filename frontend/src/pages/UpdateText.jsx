import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';

const mockText = { id: 1, title: 'Sample Text', text: 'Hello world.', language_id: 1 };
const mockLanguages = [
  { id: 1, language_name: 'English' },
  { id: 2, language_name: 'German' },
];

export default function UpdateText() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [title, setTitle] = useState(mockText.title);
  const [text, setText] = useState(mockText.text);
  const [lang, setLang] = useState(mockText.language_id);

  const handleSubmit = (e) => {
    e.preventDefault();
    navigate('/displayAllTexts');
  };

  return (
    <div className="text-learn-wrapper">
      <p className="pagetitle">{__('api_texts.überschrift1')}"{mockText.title}"{__('api_texts.überschrift2')}</p>
      <form onSubmit={handleSubmit} className="text-form">
        <input type="hidden" value={mockText.id} />
        <div className="form-group">
          <label>{__('api_texts.text-title')}</label>
          <input type="text" className="form-control" value={title} onChange={(e) => setTitle(e.target.value)} required />
        </div>
        <div className="form-group">
          <label>{__('api_texts.text')}</label>
          <textarea className="form-control" rows="3" value={text} onChange={(e) => setText(e.target.value)} required />
        </div>
        <div className="form-group">
          <label>{__('api_texts.language')}</label>
          <select value={lang} onChange={(e) => setLang(e.target.value)} className="standartSelect">
            {mockLanguages.map(language => (
              <option key={language.id} value={language.id}>{language.language_name}</option>
            ))}
          </select>
        </div>
        <div className="submit-wrapper-addText">
          <button type="submit" className="approveButton">{__('api_texts.save')}</button>
        </div>
      </form>
    </div>
  );
}
