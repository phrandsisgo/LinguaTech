import React, { useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';

const mockText = {
  id: 1,
  title: 'Sample Text',
  text: 'Hello world. This is a sample text for learning.',
  language_code: 'EN',
  created_by: 2,
};

const mockLanguages = [
  { language_code: 'DE', language_name: 'German' },
  { language_code: 'EN', language_name: 'English' },
  { language_code: 'FR', language_name: 'French' },
];

const mockOwnLists = [
  { id: 1, name: 'My Deck' },
];

export default function TextShow() {
  const { id } = useParams();
  const { user } = useAuth();
  const [targetLanguage, setTargetLanguage] = useState('DE');
  const [showTranslationModal, setShowTranslationModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [translationData, setTranslationData] = useState({ translation: '', request: '' });
  const [selectedList, setSelectedList] = useState(mockOwnLists[0]?.id || '');

  const text = mockText;

  const handleWordClick = (word) => {
    setTranslationData({ translation: 'Übersetzung', request: word });
    setShowTranslationModal(true);
  };

  const renderText = () => {
    const sentences = text.text.split(/(?<=[.?!])/);
    return sentences.map((sentence, sIdx) => (
      <span key={sIdx}>
        {sentence.split(/([\p{L}'']+)/gu).map((part, pIdx) => {
          if (/\p{L}/u.test(part)) {
            return (
              <span
                key={pIdx}
                className="word"
                style={{ cursor: 'pointer', display: 'inline' }}
                onMouseEnter={(e) => e.target.classList.add('highlighted')}
                onMouseLeave={(e) => e.target.classList.remove('highlighted')}
                onClick={() => handleWordClick(part)}
              >
                {part}
              </span>
            );
          }
          return <span key={pIdx}>{part}</span>;
        })}
      </span>
    ));
  };

  return (
    <div className="text-learn-wrapper">
      <Link to="/displayAllTexts" style={{ textDecoration: 'none' }}>
        <button className="standartButton">{__('api_texts.all-texts')}</button>
      </Link>
      {text.created_by === user?.id && (
        <>
          <Link to={`/updateText/${text.id}`} style={{ textDecoration: 'none' }}>
            <button className="standartButton">{__('api_texts.edit-text')}</button>
          </Link>
          <button onClick={() => setShowDeleteModal(true)} className="standartDangerButton standartButton">{__('api_texts.delete-text')}</button>
        </>
      )}

      <div>
        <label htmlFor="targetLanguage">{__('Select Target Language')}:</label>
        <select id="targetLanguage" value={targetLanguage} onChange={(e) => setTargetLanguage(e.target.value)}>
          {mockLanguages.map(lang => (
            <option key={lang.language_code} value={lang.language_code}>{lang.language_name}</option>
          ))}
        </select>
      </div>

      <p className="pagetitle">{text.title}</p>
      <p id="textContainer" className="section-content">{renderText()}</p>
      <br /><br /><br />

      {showTranslationModal && (
        <div id="translationModal" style={{ display: 'block' }} onClick={(e) => { if (e.target === e.currentTarget) setShowTranslationModal(false); }}>
          <div className="modal-content">
            <p>{__('api_texts.word-translated')}</p>
            <p className="sectiontitle">{translationData.translation}</p>
            <br />
            <p>{__('api_texts.wordYouAskedFor')}</p>
            <p className="sectiontitle">{translationData.request}</p>
            <br />
            <p>{__('api_texts.add-to-list')}</p>
            <div className="dropdown">
              <select value={selectedList} onChange={(e) => setSelectedList(e.target.value)}>
                {mockOwnLists.map(list => (
                  <option key={list.id} value={list.id}>{list.name}</option>
                ))}
              </select>
            </div>
            <br />
            <button className="standartButton" onClick={() => { setShowTranslationModal(false); }}>{__('api_texts.add-to-list')}</button>
            <button className="standartDangerButton standartButton" onClick={() => setShowTranslationModal(false)}>{__('api_texts.close')}</button>
          </div>
        </div>
      )}

      {showDeleteModal && (
        <div id="deleteModal" className="modal" style={{ display: 'block' }} onClick={(e) => { if (e.target === e.currentTarget) setShowDeleteModal(false); }}>
          <div className="modal-content">
            <p>{__('api_texts.delete-text')}</p>
            <p>{__('api_texts.delete-text-question')}</p>
            <form onSubmit={(e) => { e.preventDefault(); setShowDeleteModal(false); }}>
              <input type="hidden" name="textId" value={text.id} />
              <button type="submit" className="standartDangerButton standartButton">{__('api_texts.delete')}</button>
              <button type="button" onClick={() => setShowDeleteModal(false)} className="standartButton">{__('api_texts.cancel')}</button>
            </form>
          </div>
        </div>
      )}

      <style>{`
        .highlighted { background-color: #FFD166; }
        .word { cursor: pointer; display: inline; }
      `}</style>
    </div>
  );
}
