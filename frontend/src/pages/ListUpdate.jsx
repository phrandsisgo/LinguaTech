import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
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

export default function ListUpdate() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [listTitle, setListTitle] = useState(mockList.name);
  const [listDescription, setListDescription] = useState(mockList.description);
  const [cards, setCards] = useState(mockList.words.map(w => ({ ...w, baseWord: w.base_word, targetWord: w.target_word })));
  const [deletedIds, setDeletedIds] = useState([]);

  const addCard = () => {
    setCards([...cards, { id: 'new', baseWord: '', targetWord: '' }]);
  };

  const updateCard = (index, field, value) => {
    const newCards = [...cards];
    newCards[index][field] = value;
    setCards(newCards);
  };

  const markForDeletion = (index) => {
    const card = cards[index];
    if (card.id !== 'new') {
      setDeletedIds([...deletedIds, card.id]);
    }
    const newCards = [...cards];
    newCards.splice(index, 1);
    setCards(newCards);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    let isValid = true;

    if (listTitle.trim().length < 3 || listTitle.trim().length > 40) {
      isValid = false;
      alert(__('list_update.title_length_validation'));
    }
    if (listDescription.trim().length > 200) {
      isValid = false;
      alert(__('list_update.description_length_validation'));
    }

    cards.forEach((card) => {
      if (card.baseWord.trim() === '' && card.targetWord.trim() === '') {
        // remove silently
      } else if (card.baseWord.trim() === '' || card.targetWord.trim() === '') {
        isValid = false;
        alert(__('list_update.all_base_and_target_words_must_be_filled'));
      }
    });

    if (!isValid) return;
    navigate(`/list_show/${id}`);
  };

  return (
    <>
      <p className="pagetitle">{__('list_update.edit_your_list')}</p>
      <form onSubmit={handleSubmit} id="list_update_form">
        <div className="displayFlex">
          <div className="horizontal-fill"></div>
          <button type="button" onClick={addCard} className="standartButton">{__('list_update.add_another_term')}</button>
          <button type="submit" className="approveButton">{__('list_update.save_changes')}</button>
        </div>

        <p className="section-content">{__('list_update.your_title')}</p>
        <input type="text" value={listTitle} onChange={(e) => setListTitle(e.target.value)} className="inputField" />
        <br /><br /><br />

        <p className="section-content">{__('list_update.description_optional')}</p>
        <input type="text" value={listDescription} onChange={(e) => setListDescription(e.target.value)} className="inputField" />

        <div id="luis">
          {cards.map((card, index) => (
            <div className="library-Card" key={index} data-word-id={card.id}>
              <input type="hidden" name="wordIds[]" value={card.id} />
              <div className="displayFlex">
                <div>
                  <input type="text" name="baseWord[]" value={card.baseWord} onChange={(e) => updateCard(index, 'baseWord', e.target.value)} className="inputField" />
                  <p className="formHelper">{__('list_update.base_language')}</p>
                  <input type="text" name="targetWord[]" value={card.targetWord} onChange={(e) => updateCard(index, 'targetWord', e.target.value)} className="inputField" />
                  <p className="formHelper">{__('list_update.target_language')}</p>
                </div>
                <div className="horizontal-fill"></div>
                <button type="button" className="delete-hitbox" onClick={() => markForDeletion(index)}>
                  <img src="/svg-icons/trash-icon.svg" alt="Löschen Icon" />
                </button>
              </div>
            </div>
          ))}
        </div>

        {deletedIds.map((delId, i) => (
          <input type="hidden" name="deletedWordIds[]" value={delId} key={i} />
        ))}

        <button type="button" onClick={addCard} className="standartButton">{__('list_update.add_another_term')}</button>
        <button type="submit" className="approveButton">{__('list_update.save_changes')}</button>
      </form>
    </>
  );
}
