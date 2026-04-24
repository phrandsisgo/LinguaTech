import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';

const mockLanguages = [
  { id: 1, language_name: 'English' },
  { id: 2, language_name: 'German' },
];
const mockDecks = [
  { id: 1, name: 'Spanish Basics' },
  { id: 2, name: 'French Verbs' },
];

export default function GenerateText() {
  const { deck_id } = useParams();
  const navigate = useNavigate();
  const [title, setTitle] = useState('');
  const [text, setText] = useState('');
  const [lang, setLang] = useState(1);
  const [deckId, setDeckId] = useState(deck_id || 'null');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!text.trim() && (deckId === 'null' || !deckId)) {
      alert(__('api_texts.provide_text_or_deck'));
      return;
    }
    navigate('/displayAllTexts');
  };

  return (
    <>
      <p className="pagetitle">{__('api_texts.generateNewText')}</p>
      <form onSubmit={handleSubmit}>
        <p className="section-content">{__('api_texts.preferableTitleHelper')}</p>
        <div className="form-group">
          <label>{__('api_texts.preferableTitle')}</label>
          <input type="text" className="form-control" value={title} onChange={(e) => setTitle(e.target.value)} placeholder={__('api_texts.title_placeholder')} />
        </div>
        <div className="form-group">
          <label>{__('api_texts.textDescription')}</label>
          <textarea className="form-control" rows="3" value={text} onChange={(e) => setText(e.target.value)} placeholder={__('api_texts.text_description_placeholder')} />
        </div>
        <div className="form-group">
          <label className="section-content">{__('api_texts.add-language')}</label>
          <br />
          <select value={lang} onChange={(e) => setLang(e.target.value)} className="standartSelect">
            {mockLanguages.map(lang => (
              <option key={lang.id} value={lang.id}>{lang.language_name}</option>
            ))}
          </select>
          <br /><br />
        </div>
        <div className="form-group">
          <label className="section-content">{__('api_texts.deck_word_list')}</label>
          <br />
          <select value={deckId} onChange={(e) => setDeckId(e.target.value)} className="standartSelect">
            <option value="null">{__('api_texts.no_deck_selected')}</option>
            {mockDecks.map(deck => (
              <option key={deck.id} value={deck.id}>{deck.name}</option>
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
