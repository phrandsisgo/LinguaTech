import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

export default function ListCreate() {
  const navigate = useNavigate();
  const [listTitle, setListTitle] = useState('');
  const [listDescription, setListDescription] = useState('');
  const [cards, setCards] = useState([{ baseWord: '', targetWord: '' }]);
  const [errors, setErrors] = useState({});

  const addCard = () => {
    setCards([...cards, { baseWord: '', targetWord: '' }]);
  };

  const updateCard = (index, field, value) => {
    const newCards = [...cards];
    newCards[index][field] = value;
    setCards(newCards);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    let isValid = true;
    const newErrors = {};

    if (listTitle.trim().length < 3 || listTitle.trim().length > 40) {
      isValid = false;
      newErrors.listTitle = 'Bitte fügen sie ein Titel ein (zwischen 3 und 40 Zeichen)';
    }
    if (listDescription.trim().length > 200) {
      isValid = false;
      alert('Beschreibung darf nicht länger als 200 Zeichen sein.');
    }
    cards.forEach((card) => {
      if (card.baseWord.trim() === '' || card.targetWord.trim() === '') {
        isValid = false;
        alert('Alle Basiswörter und Zielwörter müssen ausgefüllt werden.');
      }
    });

    setErrors(newErrors);
    if (!isValid) return;

    // Submit logic here
    navigate('/library');
  };

  return (
    <>
      <p className="pagetitle">{__('list_create.create_new_list')}</p>
      <form onSubmit={handleSubmit} id="list_create_form">
        <p className="section-content" id="listTitleInput" style={errors.listTitle ? { color: 'red' } : {}}>
          {errors.listTitle || __('list_create.insert_title')}
        </p>
        <input
          type="text"
          name="listTitle"
          value={listTitle}
          onChange={(e) => setListTitle(e.target.value)}
          placeholder={__('list_create.title_placeholder')}
          className="inputField"
        />
        <br /><br />
        <p className="section-content">{__('list_create.description_optional')}</p>
        <input
          type="text"
          name="listDescription"
          value={listDescription}
          onChange={(e) => setListDescription(e.target.value)}
          placeholder={__('list_create.description_placeholder')}
          className="inputField"
        />
        <div id="luis">
          {cards.map((card, index) => (
            <div className="library-Card" key={index}>
              <input type="hidden" name="wordIds[]" value="new" />
              <input
                type="text"
                name="baseWord[]"
                value={card.baseWord}
                onChange={(e) => updateCard(index, 'baseWord', e.target.value)}
                placeholder={__('list_create.base_word_placeholder')}
                className="inputField"
              />
              <p className="formHelper">{__('list_create.base_language')}</p>
              <input
                type="text"
                name="targetWord[]"
                value={card.targetWord}
                onChange={(e) => updateCard(index, 'targetWord', e.target.value)}
                placeholder={__('list_create.target_word_placeholder')}
                className="inputField"
              />
              <p className="formHelper">{__('list_create.target_language')}</p>
            </div>
          ))}
        </div>
        <button type="button" onClick={addCard} className="standartButton">{__('list_create.add_another_term')}</button>
        <button type="submit" className="approveButton">{__('list_create.create_list')}</button>
      </form>
    </>
  );
}
