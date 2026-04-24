import React from 'react';
import { Link, useParams } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockList = {
  id: 1,
  name: 'Spanish Basics',
  description: 'Basic Spanish vocabulary for beginners',
  created_by: 2,
  words: [
    { id: 1, base_word: 'Hola', target_word: 'Hello' },
    { id: 2, base_word: 'Gracias', target_word: 'Thank you' },
    { id: 3, base_word: 'Por favor', target_word: 'Please' },
  ]
};

export default function ListShow() {
  const { id } = useParams();
  const { user } = useAuth();
  const liste = mockList; // In real app: fetch by id

  return (
    <>
      <div id="titleFlex">
        <div>
          <p className="pagetitle">{liste.name}</p>
          <p className="section-content">{liste.description}</p>
        </div>
        <br />
        <div className="horizontal-fill"></div>
        <div className="action-links">
          {user?.id == liste.created_by && (
            <>
              <div>
                <Link to={`/copy_list/${liste.id}`}><p className="sectiontitle noUnderline">{__('learn-lists.list-copy')}</p></Link>
              </div>
              <div className="space"></div>
              <div>
                <Link to={`/list_update/${liste.id}`}><p className="sectiontitle noUnderline">{__('learn-lists.edit')}</p></Link>
              </div>
              <div className="space"></div>
              <Link to={`/generate-text/${liste.id}`}><p className="sectiontitle noUnderline">{__('api_texts.generateNewText')}</p></Link>
            </>
          )}
          <div className="space"></div>
          <Link to={`/swipeLearn/${liste.id}`}><p className="sectiontitle noUnderline">{__('learn-lists.learn')}</p></Link>
        </div>
      </div>

      {liste.words.map(begriffe => (
        <div className="library-Card" key={begriffe.id}>
          <div className="displayFlex">
            <div>
              <p className="sectiontitle center-vertically">{begriffe.base_word}</p>
              <hr className="hrborder" />
              <p className="sectiontitle center-vertically">{begriffe.target_word}</p>
            </div>
            {user?.id == liste.created_by && (
              <>
                <div className="horizontal-fill"></div>
                <form onSubmit={(e) => { e.preventDefault(); if (confirm('sind sie sich sicher, dass sie dieses Wort löschen wollen?')) { /* delete */ } }}>
                  <button type="submit" className="delete-hitbox">
                    <img src="/svg-icons/trash-icon.svg" alt="Löschen Icon" />
                  </button>
                </form>
              </>
            )}
          </div>
        </div>
      ))}
    </>
  );
}
