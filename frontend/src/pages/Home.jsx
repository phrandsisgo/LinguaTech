import React from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockDecks = [
  { id: 1, name: 'Spanish Basics', updated_at: '2024-01-15', words: [{}, {}, {}] },
  { id: 2, name: 'French Verbs', updated_at: '2024-01-10', words: [{}, {}] },
];

const mockTexts = [
  { id: 1, title: 'My First Text', updated_at: '2024-01-14' },
  { id: 2, title: 'Travel Story', updated_at: '2024-01-12' },
];

export default function Home() {
  const { user } = useAuth();

  return (
    <>
      <div className="titleMargin">
        <div className="displayFlex">
          <p className="pagetitle">{__('home.welcome_back', { name: user?.name || 'Guest' })}</p>
          <div className="horizontal-fill"></div>
        </div>
      </div>

      <div className="titleMargin">
        <div className="title-flex">
          <p className="pagetitle">{__('home.your_recent_decks')}</p>
          <div className="button-group">
            <Link to="/library" className="noUnderline">
              <button className="standartButton">{__('home.view_all_decks')}</button>
            </Link>
            <Link to="/list_create" className="noUnderline">
              <button className="standartButton">{__('home.create_new_deck')}</button>
            </Link>
          </div>
        </div>

        {mockDecks.length === 0 ? (
          <>
            <p className="section-content">{__('home.no_decks_yet')}</p>
            <Link to="/list_create" className="anker-no-underline">{__('home.click_here_to_create_first_deck')}</Link>
          </>
        ) : (
          mockDecks.map(deck => (
            <div className="library-Card" key={deck.id}>
              <div className="displayFlex">
                <Link to={`/list_show/${deck.id}`} className="anker-no-underline displayFlex">
                  <p className="cardTitle">{deck.name}</p>
                </Link>
                <div className="horizontal-fill"></div>
                <Link to={`/swipeLearn/${deck.id}`}>
                  <img src="/svg-icons/learnIcon.svg" alt="Learn Icon" className="libraryIcon" />
                </Link>
                <Link to={`/list_update/${deck.id}`}>
                  <img src="/svg-icons/pencil-icon.svg" alt="Edit Icon" className="libraryIcon" />
                </Link>
                <form onSubmit={(e) => { e.preventDefault(); if (confirm(__('home.confirm_delete_deck'))) { /* delete */ } }}>
                  <button type="submit" className="delete-hitbox">
                    <img src="/svg-icons/trash-icon.svg" alt="Delete Icon" className="libraryIcon" />
                  </button>
                </form>
              </div>
              <div>
                <p className="begriffCount">{deck.words.length} {__('home.words')}</p>
              </div>
              <div className="leading-library">
                <p className="leadingText">{deck.updated_at}</p>
              </div>
            </div>
          ))
        )}
      </div>

      <div className="titleMargin">
        <div className="title-flex">
          <p className="pagetitle">{__('home.your_recent_texts')}</p>
          <div className="button-group">
            <Link to="/displayAllTexts" className="noUnderline">
              <button className="standartButton">{__('home.view_all_texts')}</button>
            </Link>
            <Link to="/addText" className="noUnderline">
              <button className="standartButton">{__('home.add_new_text')}</button>
            </Link>
          </div>
        </div>

        {mockTexts.length === 0 ? (
          <>
            <p className="section-content">{__('home.no_texts_yet')}</p>
            <Link to="/addText" className="anker-no-underline">{__('home.click_here_to_add_first_text')}</Link>
          </>
        ) : (
          mockTexts.map(text => (
            <div className="library-Card" key={text.id}>
              <div className="displayFlex">
                <Link to={`/textShow/${text.id}`} className="anker-no-underline displayFlex">
                  <p className="cardTitle">{text.title}</p>
                </Link>
                <div className="horizontal-fill"></div>
                <Link to={`/updateText/${text.id}`}>
                  <img src="/svg-icons/pencil-icon.svg" alt="Edit Icon" className="libraryIcon" />
                </Link>
                <form onSubmit={(e) => { e.preventDefault(); if (confirm(__('home.confirm_delete_text'))) { /* delete */ } }}>
                  <input type="hidden" name="textId" value={text.id} />
                  <button type="submit" className="delete-hitbox">
                    <img src="/svg-icons/trash-icon.svg" alt="Delete Icon" className="libraryIcon" />
                  </button>
                </form>
              </div>
              <div className="leading-library">
                <p className="leadingText">{text.updated_at}</p>
              </div>
            </div>
          ))
        )}
      </div>
    </>
  );
}
