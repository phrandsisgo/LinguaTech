import { useState, useEffect, useRef, useCallback } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import { apiGetWordList, apiSwipeHandle } from '../api';
import LoadingSpinner from '../components/LoadingSpinner';

export default function SwipeLearnPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [liste, setListe] = useState(null);
  const [words, setWords] = useState([]);
  const [currentIndex, setCurrentIndex] = useState(0);
  const [flipped, setFlipped] = useState(false);
  const [loading, setLoading] = useState(true);
  const [swipeDirection, setSwipeDirection] = useState(null);
  const [done, setDone] = useState(false);
  const [stats, setStats] = useState({ known: 0, unknown: 0 });

  // Touch/Drag tracking
  const touchStartX = useRef(null);
  const touchStartY = useRef(null);
  const cardRef = useRef(null);
  const [dragOffset, setDragOffset] = useState(0);
  const isDragging = useRef(false);

  useEffect(() => {
    apiGetWordList(id)
      .then(({ data }) => {
        setListe(data);
        setWords(data.words || []);
      })
      .catch(() => navigate('/library'))
      .finally(() => setLoading(false));
  }, [id]);

  const handleSwipe = useCallback(async (direction) => {
    if (currentIndex >= words.length) return;
    const word = words[currentIndex];

    setSwipeDirection(direction);
    setStats((prev) => ({
      known: direction === 'right' ? prev.known + 1 : prev.known,
      unknown: direction === 'left' ? prev.unknown + 1 : prev.unknown,
    }));

    try {
      await apiSwipeHandle(word.id, direction);
    } catch {
      // ignore errors for swipe tracking
    }

    setTimeout(() => {
      setSwipeDirection(null);
      setDragOffset(0);
      setFlipped(false);
      if (currentIndex + 1 >= words.length) {
        setDone(true);
      } else {
        setCurrentIndex((prev) => prev + 1);
      }
    }, 400);
  }, [currentIndex, words]);

  // Keyboard support
  useEffect(() => {
    function handleKey(e) {
      if (e.key === 'ArrowLeft') handleSwipe('left');
      if (e.key === 'ArrowRight') handleSwipe('right');
      if (e.key === ' ' || e.key === 'Enter') setFlipped((f) => !f);
    }
    window.addEventListener('keydown', handleKey);
    return () => window.removeEventListener('keydown', handleKey);
  }, [handleSwipe]);

  // Touch events
  function handleTouchStart(e) {
    touchStartX.current = e.touches[0].clientX;
    touchStartY.current = e.touches[0].clientY;
    isDragging.current = true;
  }

  function handleTouchMove(e) {
    if (!isDragging.current || touchStartX.current === null) return;
    const dx = e.touches[0].clientX - touchStartX.current;
    const dy = e.touches[0].clientY - touchStartY.current;
    if (Math.abs(dx) > Math.abs(dy)) {
      e.preventDefault();
      setDragOffset(dx);
    }
  }

  function handleTouchEnd(e) {
    if (!isDragging.current) return;
    isDragging.current = false;
    const dx = e.changedTouches[0].clientX - (touchStartX.current || 0);
    touchStartX.current = null;

    if (Math.abs(dx) > 80) {
      handleSwipe(dx > 0 ? 'right' : 'left');
    } else {
      setDragOffset(0);
      if (Math.abs(dx) < 10) setFlipped((f) => !f);
    }
  }

  // Mouse drag support
  function handleMouseDown(e) {
    touchStartX.current = e.clientX;
    isDragging.current = true;

    function onMove(me) {
      if (!isDragging.current) return;
      setDragOffset(me.clientX - (touchStartX.current || 0));
    }
    function onUp(me) {
      if (!isDragging.current) return;
      isDragging.current = false;
      const dx = me.clientX - (touchStartX.current || 0);
      touchStartX.current = null;
      window.removeEventListener('mousemove', onMove);
      window.removeEventListener('mouseup', onUp);
      if (Math.abs(dx) > 80) {
        handleSwipe(dx > 0 ? 'right' : 'left');
      } else {
        setDragOffset(0);
        if (Math.abs(dx) < 10) setFlipped((f) => !f);
      }
    }
    window.addEventListener('mousemove', onMove);
    window.addEventListener('mouseup', onUp);
  }

  if (loading) return <LoadingSpinner />;

  const progress = Math.round((currentIndex / words.length) * 100);
  const currentWord = words[currentIndex];

  const cardStyle = {
    transform: `translateX(${dragOffset}px) rotate(${dragOffset * 0.05}deg)`,
    transition: swipeDirection ? 'transform 0.4s ease' : 'none',
    ...(swipeDirection === 'left' && { transform: 'translateX(-150%) rotate(-20deg)' }),
    ...(swipeDirection === 'right' && { transform: 'translateX(150%) rotate(20deg)' }),
  };

  const overlayOpacity = Math.min(Math.abs(dragOffset) / 120, 1);

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-gray-900">{liste?.name}</h1>
          <p className="text-sm text-gray-500 mt-1">
            Karte {Math.min(currentIndex + 1, words.length)} von {words.length}
          </p>
        </div>
        <Link to={`/list-show/${id}`} className="text-gray-600 hover:text-indigo-600">✕ Beenden</Link>
      </div>

      {/* Progress Bar */}
      <div className="w-full bg-gray-200 rounded-full h-2">
        <div
          className="bg-indigo-600 h-2 rounded-full transition-all"
          style={{ width: `${progress}%` }}
        />
      </div>

      {done ? (
        <div className="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
          <div className="text-6xl mb-4">🎉</div>
          <h2 className="text-2xl font-bold text-gray-900 mb-2">Fertig!</h2>
          <p className="text-gray-600 mb-6">
            Du hast alle {words.length} Karten durchgegangen.
          </p>
          <div className="flex justify-center gap-8 mb-8">
            <div className="text-center">
              <div className="text-3xl font-bold text-green-600">{stats.known}</div>
              <div className="text-sm text-gray-500">Gewusst ✓</div>
            </div>
            <div className="text-center">
              <div className="text-3xl font-bold text-red-600">{stats.unknown}</div>
              <div className="text-sm text-gray-500">Nicht gewusst ✗</div>
            </div>
          </div>
          <div className="flex gap-3 justify-center">
            <button
              onClick={() => { setCurrentIndex(0); setDone(false); setStats({ known: 0, unknown: 0 }); setFlipped(false); }}
              className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
            >
              Nochmal
            </button>
            <Link to="/library" className="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">
              Zur Library
            </Link>
          </div>
        </div>
      ) : (
        <>
          {/* Hint */}
          <p className="text-center text-sm text-gray-400">Tippe auf die Karte zum Umdrehen • Wische oder drücke ← → zum Bewerten</p>

          {/* Card */}
          <div className="relative flex justify-center" style={{ height: '320px' }}>
            {/* Left indicator */}
            <div
              className="absolute left-4 top-1/2 -translate-y-1/2 text-red-500 font-bold text-xl z-10 pointer-events-none"
              style={{ opacity: dragOffset < 0 ? overlayOpacity : 0 }}
            >
              ✗ Nicht gewusst
            </div>
            {/* Right indicator */}
            <div
              className="absolute right-4 top-1/2 -translate-y-1/2 text-green-500 font-bold text-xl z-10 pointer-events-none"
              style={{ opacity: dragOffset > 0 ? overlayOpacity : 0 }}
            >
              Gewusst ✓
            </div>

            <div
              ref={cardRef}
              style={cardStyle}
              className="bg-white rounded-2xl shadow-lg border border-gray-100 cursor-pointer select-none w-full max-w-lg flex flex-col items-center justify-center p-8"
              onTouchStart={handleTouchStart}
              onTouchMove={handleTouchMove}
              onTouchEnd={handleTouchEnd}
              onMouseDown={handleMouseDown}
              onClick={() => { if (!isDragging.current) setFlipped((f) => !f); }}
            >
              {!flipped ? (
                <>
                  <p className="text-xs text-gray-400 uppercase tracking-wide mb-4">Basiswort</p>
                  <p className="text-4xl font-bold text-gray-900 text-center">{currentWord?.base_word}</p>
                  <p className="text-sm text-gray-400 mt-6">Tippen zum Umdrehen</p>
                </>
              ) : (
                <>
                  <p className="text-xs text-gray-400 uppercase tracking-wide mb-4">Zielwort</p>
                  <p className="text-4xl font-bold text-indigo-600 text-center">{currentWord?.target_word}</p>
                  <p className="text-sm text-gray-400 mt-6">Wie gut kannte ich das?</p>
                </>
              )}
            </div>
          </div>

          {/* Action Buttons */}
          <div className="flex gap-4 justify-center">
            <button
              onClick={() => handleSwipe('left')}
              className="flex-1 max-w-48 bg-red-50 text-red-600 border-2 border-red-200 py-3 rounded-xl font-medium hover:bg-red-100 transition-colors text-lg"
            >
              ✗ Nicht gewusst
            </button>
            <button
              onClick={() => setFlipped((f) => !f)}
              className="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl hover:bg-gray-200 transition-colors"
            >
              Umdrehen
            </button>
            <button
              onClick={() => handleSwipe('right')}
              className="flex-1 max-w-48 bg-green-50 text-green-600 border-2 border-green-200 py-3 rounded-xl font-medium hover:bg-green-100 transition-colors text-lg"
            >
              Gewusst ✓
            </button>
          </div>

          {/* Stats */}
          <div className="flex justify-center gap-8 text-sm text-gray-500">
            <span className="text-green-600 font-medium">✓ {stats.known} gewusst</span>
            <span className="text-red-600 font-medium">✗ {stats.unknown} nicht gewusst</span>
          </div>
        </>
      )}
    </div>
  );
}
