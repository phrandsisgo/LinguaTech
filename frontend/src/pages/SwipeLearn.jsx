import React, { useState, useEffect, useRef } from 'react';
import { useParams, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';
import '../styles/application.scss';
import '../styles/animations.scss';

const mockWords = [
  { id: 1, base_word: 'Hola', target_word: 'Hello' },
  { id: 2, base_word: 'Gracias', target_word: 'Thank you' },
  { id: 3, base_word: 'Por favor', target_word: 'Please' },
  { id: 4, base_word: 'Buenos días', target_word: 'Good morning' },
];

export default function SwipeLearn() {
  const { id } = useParams();
  const { user } = useAuth();
  const [woerterbuch, setWoerterbuch] = useState(mockWords.map(w => ({ ...w, learned: false })));
  const [aktuelleKarteIndex, setAktuelleKarteIndex] = useState(0);
  const [learningMode, setLearningMode] = useState('target');
  const [doneAnzeige, setDoneAnzeige] = useState(0);
  const [repAzeig, setRepAzeig] = useState(0);
  const [swipeHistory, setSwipeHistory] = useState([]);
  const [showLearningModal, setShowLearningModal] = useState(false);
  const [showStatistikModal, setShowStatistikModal] = useState(false);
  const [animationClass, setAnimationClass] = useState('');
  const [isFlipped, setIsFlipped] = useState(false);
  const flipRef = useRef(null);

  const currentWord = woerterbuch[aktuelleKarteIndex];

  useEffect(() => {
    // Keyboard navigation
    const handleKeyDown = (event) => {
      if (event.key === 'ArrowLeft') triggerLeft();
      if (event.key === 'ArrowRight') triggerRight();
    };
    document.addEventListener('keydown', handleKeyDown);
    return () => document.removeEventListener('keydown', handleKeyDown);
  }, [aktuelleKarteIndex, woerterbuch]);

  const showUebersetzung = () => setIsFlipped(!isFlipped);

  const updateKarte = () => {
    setIsFlipped(false);
  };

  const showNextWord = () => {
    let nextIndex = aktuelleKarteIndex + 1;
    while (nextIndex < woerterbuch.length && woerterbuch[nextIndex].learned) {
      nextIndex++;
    }
    if (nextIndex >= woerterbuch.length) {
      setShowStatistikModal(true);
    } else {
      setAktuelleKarteIndex(nextIndex);
      updateKarte();
    }
  };

  const triggerAnimationLeft = (callback) => {
    setAnimationClass('animate__rollOut__left');
    setTimeout(() => {
      setAnimationClass('');
      if (callback) callback();
    }, 700);
  };

  const triggerAnimationRight = (callback) => {
    setAnimationClass('animate__rollOut__right');
    setTimeout(() => {
      setAnimationClass('');
      if (callback) callback();
    }, 700);
  };

  const triggerLeft = () => {
    setSwipeHistory([...swipeHistory, aktuelleKarteIndex]);
    setRepAzeig(prev => prev + 1);
    triggerAnimationLeft(() => showNextWord());
  };

  const triggerRight = () => {
    const newWb = [...woerterbuch];
    newWb[aktuelleKarteIndex].learned = true;
    setWoerterbuch(newWb);
    setSwipeHistory([...swipeHistory, aktuelleKarteIndex]);
    setDoneAnzeige(prev => prev + 1);
    triggerAnimationRight(() => showNextWord());
  };

  const undoLastSwipe = () => {
    if (swipeHistory.length > 0) {
      const lastIndex = swipeHistory[swipeHistory.length - 1];
      const newHistory = swipeHistory.slice(0, -1);
      setSwipeHistory(newHistory);
      const newWb = [...woerterbuch];
      newWb[lastIndex].learned = false;
      setWoerterbuch(newWb);
      setAktuelleKarteIndex(lastIndex);
      updateKarte();
    }
  };

  const shuffleAndReloadCards = () => {
    const shuffled = [...woerterbuch].sort(() => Math.random() - 0.5);
    setWoerterbuch(shuffled.map(w => ({ ...w, learned: false })));
    setAktuelleKarteIndex(0);
    setDoneAnzeige(0);
    setRepAzeig(0);
    setSwipeHistory([]);
    updateKarte();
  };

  const restartWithUnknownAnswers = () => {
    const unlearned = woerterbuch.filter(w => !w.learned);
    if (unlearned.length > 0) {
      setWoerterbuch(unlearned.map(w => ({ ...w, learned: false })));
      setAktuelleKarteIndex(0);
      setDoneAnzeige(0);
      setRepAzeig(0);
      setSwipeHistory([]);
      setShowStatistikModal(false);
      updateKarte();
    } else {
      alert(__('swipe.all_words_learned'));
    }
  };

  const frontText = learningMode === 'base'
    ? (currentWord?.base_word || __('swipe.word'))
    : (currentWord?.target_word || __('swipe.word'));
  const backText = learningMode === 'base'
    ? (currentWord?.target_word || __('swipe.word'))
    : (currentWord?.base_word || __('swipe.word'));

  return (
    <>
      <p className="sectiontitle swipeLearnTitle">Deck {id}</p>
      <button className="standartButton" onClick={() => setShowLearningModal(true)}>{__('swipe.change_learning_mode')}</button>

      {showLearningModal && (
        <div id="learningModeModal" onClick={(e) => { if (e.target === e.currentTarget) setShowLearningModal(false); }}>
          <div className="modal-content">
            <h2>{__('swipe.learning_mode')}</h2>
            <label>
              <input type="radio" name="learningMode" value="base" checked={learningMode === 'base'} onChange={() => { setLearningMode('base'); updateKarte(); }} /> {__('swipe.learn_target_words')}
            </label>
            <label>
              <input type="radio" name="learningMode" value="target" checked={learningMode === 'target'} onChange={() => { setLearningMode('target'); updateKarte(); }} /> {__('swipe.learn_base_words')}
            </label>
            <br /><br />
            <button className="standartButton" onClick={shuffleAndReloadCards}>{__('swipe.mix')}</button>
            <br /><br /><br />
            {user?.status === 'admin' && (
              <>
                <button type="button" className="standartButton" onClick={() => setShowStatistikModal(true)}>Show Swipe Statistics</button>
                <br /><br /><br />
              </>
            )}
            <button className="modalclose" onClick={() => setShowLearningModal(false)}>{__('swipe.close')}</button>
          </div>
        </div>
      )}

      <div className="karteContent">
        <div className={`flip-card-inner ${animationClass} ${isFlipped ? 'turnCard' : ''}`} ref={flipRef}>
          <div className="flashCardContent frontface" id="flashCardFront">
            <div className="countZeile">
              <div className="repetitionCountBox"><p className="anzeigemargin">{repAzeig}</p></div>
              <div className="countAnzeige">{aktuelleKarteIndex + 1}/{woerterbuch.length} {__('swipe.words')}</div>
              <div className="doneCountBox"><p className="anzeigemargin">{doneAnzeige}</p></div>
            </div>
            <div className="flipcardWordWrapper" onClick={showUebersetzung}>
              <p className="flipcardWord">{frontText}</p>
            </div>
            <div className="displayFlex">
              <img src="/svg-icons/denyIcon.svg" alt={__('swipe.confirmIconAlt')} className="iconSpacer" onClick={triggerLeft} />
              <div className="horizontal-fill"></div>
              <img src="/svg-icons/confirmIcon.svg" alt={__('swipe.confirmIconAlt')} className="iconSpacer" onClick={triggerRight} />
            </div>
          </div>

          <div className="flashCardContent backface" id="flashCardBack">
            <div className="countZeile">
              <div className="repetitionCountBox"><p className="anzeigemargin">{repAzeig}</p></div>
              <div className="countAnzeige">{aktuelleKarteIndex + 1}/{woerterbuch.length} {__('swipe.words')}</div>
              <div className="doneCountBox"><p className="anzeigemargin">{doneAnzeige}</p></div>
            </div>
            <div className="flipcardWordWrapper" onClick={showUebersetzung}>
              <p className="flipcardWord">{backText}</p>
            </div>
            <div className="displayFlex">
              <img src="/svg-icons/denyIcon.svg" alt={__('swipe.confirmIconAlt')} className="iconSpacer" onClick={triggerLeft} />
              <div className="horizontal-fill"></div>
              <img src="/svg-icons/confirmIcon.svg" alt={__('swipe.confirmIconAlt')} className="iconSpacer" onClick={triggerRight} />
            </div>
          </div>
        </div>
      </div>

      <button className="standartDangerButton undoButton" onClick={undoLastSwipe}>Undo</button>

      {showStatistikModal && (
        <div id="swipeStatistikModal">
          <div className="modal-content">
            <h2>{__('swipe.swipeStatistics')}</h2>
            <p>{__('swipe.unknownAnswersCount')} {repAzeig}</p>
            <p>{__('swipe.knownAnswersCount')} {doneAnzeige}</p>
            <br />
            <div style={{ height: '4rem' }}></div>
            <button onClick={restartWithUnknownAnswers} className="standartButton">{__('swipe.repeat-wrong-answers')}</button>
            <button onClick={() => window.location.reload()} className="standartButton">{__('swipe.learnAgain')}</button>
            <Link to="/library"><button className="modalclose" onClick={() => setShowStatistikModal(false)}>{__('swipe.close')}</button></Link>
          </div>
        </div>
      )}
    </>
  );
}
