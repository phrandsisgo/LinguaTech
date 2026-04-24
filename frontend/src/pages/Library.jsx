import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

const mockLibraryList = [
  { id: 1, name: 'Spanish Basics', created_by: 1, creator: { name: 'Admin' }, words_count: 12, created_at: '2024-01-15' },
  { id: 2, name: 'My Private Deck', created_by: 2, creator: { name: 'Me' }, words_count: 8, created_at: '2024-01-10' },
];

export default function Library() {
  const [showPublic, setShowPublic] = useState(false);
  const currentUserId = 2; // mock

  const publicLists = mockLibraryList.filter(l => l.created_by === 1);
  const privateLists = mockLibraryList.filter(l => l.created_by === currentUserId);

  return (
    <>
      <div className="titleMargin">
        <div className="toggle-wrapper">
          <input type="checkbox" id="toggleButton" className="toggle-checkbox" checked={showPublic} onChange={() => setShowPublic(!showPublic)} />
          <label htmlFor="toggleButton" className="toggle-label">
            <span className="toggle-inner"></span>
            <span className="toggle-on">{__('library.own')}</span>
            <span className="toggle-off">{__('library.public')}</span>
          </label>
        </div>
      </div>

      {showPublic && (
        <div id="publicList">
          <div className="displayFlex titleMargin">
            <p className="pagetitle">{__('library.titlePublic')}</p>
            <div className="horizontal-fill"></div>
          </div>
          {publicLists.map(list => (
            <div className="library-Card" key={list.id}>
              <Link to={`/list_show/${list.id}`} className="anker-no-underline">
                <div className="displayFlex">
                  <p className="cardTitle">{list.name}</p>
                  <div className="horizontal-fill"></div>
                  <form onSubmit={(e) => { e.preventDefault(); if (confirm('Sind Sie sicher, dass Sie diese Liste kopieren wollen?')) { /* copy */ } }}>
                    <button type="submit" className="delete-hitbox">
                      <img src="/svg-icons/copy-icon.svg" alt="Copy Icon" className="libraryIcon" />
                    </button>
                  </form>
                </div>
                <div>
                  <p className="begriffCount">{list.words_count} {__('library.begriff')}</p>
                </div>
                <div className="leading-library">
                  <p className="leadingText">{__('library.begriff')} {list.creator.name}</p>
                  <div className="horizontal-fill"></div>
                  <p className="leadingText">{list.created_at}</p>
                </div>
              </Link>
            </div>
          ))}
        </div>
      )}

      {!showPublic && (
        <div id="privateList">
          <div className="displayFlex titleMargin">
            <p className="pagetitle">{__('library.titlePrivate')}</p>
            <div className="horizontal-fill"></div>
            <Link to="/list_create">
              <div className="addButton">
                <p className="addButtonText pagetitle">{__('library.newList')}</p>
              </div>
            </Link>
          </div>
          {privateLists.map(list => (
            <div className="library-Card" key={list.id}>
              <div className="displayFlex">
                <Link to={`/list_show/${list.id}`} className="anker-no-underline displayFlex">
                  <p className="cardTitle">{list.name}</p>
                </Link>
                <Link to={`/list_show/${list.id}`} className="horizontal-fill"></Link>
                <Link to={`/swipeLearn/${list.id}`}>
                  <img src="/svg-icons/learnIcon.svg" alt="Learn Icon" className="libraryIcon" />
                </Link>
                <Link to={`/list_update/${list.id}`}>
                  <img src="/svg-icons/pencil-icon.svg" alt="Edit Icon" className="libraryIcon" />
                </Link>
                <form onSubmit={(e) => { e.preventDefault(); if (confirm(__('library.rUSureUDelete'))) { /* delete */ } }}>
                  <button type="submit" className="delete-hitbox">
                    <img src="/svg-icons/trash-icon.svg" alt="Delete Icon" style={{ height: 34, paddingTop: 3 }} className="libraryIcon" />
                  </button>
                </form>
              </div>
              <div>
                <p className="begriffCount">{list.words_count} {__('library.begriff')}</p>
              </div>
              <div className="leading-library">
                <p className="leadingText">{__('library.createdBy')} {list.creator.name}</p>
                <div className="horizontal-fill"></div>
                <p className="leadingText">{list.created_at}</p>
              </div>
            </div>
          ))}
        </div>
      )}
    </>
  );
}
