import React from 'react';
import { Link, useParams } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockList = {
  id: 1,
  name: 'Spanish Basics',
  description: 'Basic Spanish vocabulary',
  words: [
    { id: 1, base_word: 'Hola', target_word: 'Hello' },
    { id: 2, base_word: 'Gracias', target_word: 'Thank you' },
  ]
};

export default function CopyList() {
  const { id } = useParams();
  const { user } = useAuth();
  const liste = mockList;

  const jsonContent = JSON.stringify({
    Title: liste.name,
    Description: liste.description,
    Words: liste.words.map(w => ({ Base: w.base_word, Ziel: w.target_word }))
  }, null, 2);

  const copyToClipboard = () => {
    navigator.clipboard.writeText(jsonContent);
  };

  return (
    <>
      <div className="displayFlex">
        <div>
          <p className="pagetitle">{liste.name}</p>
        </div>
        <div className="horizontal-fill"></div>
        {user?.id == liste.created_by && (
          <>
            <div>
              <Link to={`/list_show/${liste.id}`}><p className="pagetitle noUnderline">{__('learn-lists.list-view')}</p></Link>
            </div>
            <div className="space"></div>
          </>
        )}
        <div className="space"></div>
        <div>
          <Link to={`/swipeLearn/${liste.id}`}><p className="pagetitle noUnderline">{__('learn-lists.learn')}</p></Link>
        </div>
      </div>

      <div className="json-container">
        <div className="textTopping">
          <p>{__('learn-lists.copy-your-JSON')}</p>
          <div className="horizontal-fill"></div>
          <button onClick={copyToClipboard}>{__('learn-lists.copy')}</button>
        </div>
        <textarea
          id="jsonTextarea"
          style={{ fontFamily: "'Source Code Pro', monospace", width: '100%', height: 300 }}
          value={jsonContent}
          readOnly
        />
      </div>
    </>
  );
}
