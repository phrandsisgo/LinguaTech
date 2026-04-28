import { useEffect, useState } from 'react'
import { useParams, useNavigate } from 'react-router-dom'
import api from '../api'

export default function SwipeLearn() {
  const { id } = useParams()
  const navigate = useNavigate()
  const [words, setWords] = useState([])
  const [srsData, setSrsData] = useState({})
  const [currentIndex, setCurrentIndex] = useState(0)
  const [swipeHistory, setSwipeHistory] = useState([])
  const [loading, setLoading] = useState(true)
  const [flipped, setFlipped] = useState(false)
  const [finished, setFinished] = useState(false)
  const [stats, setStats] = useState({ known: 0, unknown: 0 })

  useEffect(() => {
    api.get(`/lists/${id}/due-words`).then(res => {
      setWords(res.data.words)
      setSrsData(res.data.srsData)
      setLoading(false)
      if (res.data.words.length === 0) setFinished(true)
    })
  }, [id])

  const currentWord = words[currentIndex]

  function handleSwipe(direction) {
    if (!currentWord || finished) return
    const word = currentWord
    const srs = srsData[word.id] || {}

    const snapshot = {
      index: currentIndex,
      direction,
      wordId: word.id,
      old_interval: srs.interval || 0,
      old_repetition_count: srs.repetition_count || 0,
      old_ease_factor: srs.ease_factor || 2.5,
      old_count: srs.count || 0,
      old_next_review_at: srs.next_review_at || null,
      stats_known: stats.known,
      stats_unknown: stats.unknown,
    }
    setSwipeHistory(prev => [...prev, snapshot])

    setStats(prev => ({
      known: direction === 'right' ? prev.known + 1 : prev.known,
      unknown: direction === 'left' ? prev.unknown + 1 : prev.unknown,
    }))

    api.post('/swipe', { wordId: word.id, direction }).then(res => {
      setSrsData(prev => ({
        ...prev,
        [word.id]: {
          interval: res.data.interval,
          repetition_count: res.data.repetition_count,
          ease_factor: res.data.ease_factor,
          next_review_at: res.data.next_review_at,
          count: res.data.count,
        }
      }))
    })

    const nextIndex = currentIndex + 1
    if (nextIndex >= words.length) {
      setFinished(true)
    } else {
      setCurrentIndex(nextIndex)
      setFlipped(false)
    }
  }

  function handleUndo() {
    if (swipeHistory.length === 0) return
    const snapshot = swipeHistory[swipeHistory.length - 1]

    api.post('/swipe/undo', {
      wordId: snapshot.wordId,
      old_interval: snapshot.old_interval,
      old_ease_factor: snapshot.old_ease_factor,
      old_repetition_count: snapshot.old_repetition_count,
      old_count: snapshot.old_count,
      old_next_review_at: snapshot.old_next_review_at,
    })

    setCurrentIndex(snapshot.index)
    setFlipped(false)
    setStats({ known: snapshot.stats_known, unknown: snapshot.stats_unknown })
    setSwipeHistory(prev => prev.slice(0, -1))
  }

  function handlePriorityChange(newPriority) {
    if (!currentWord) return
    api.post(`/words/${currentWord.id}/priority`, { priority: newPriority })
    setSrsData(prev => ({
      ...prev,
      [currentWord.id]: { ...prev[currentWord.id], priority: newPriority }
    }))
  }

  if (loading) return <p style={{ textAlign: 'center', padding: '2rem' }}>Loading cards...</p>
  if (finished) {
    return (
      <div className="card" style={{ textAlign: 'center', padding: '3rem 1rem' }}>
        <h2>🎉 Session Complete!</h2>
        <p style={{ fontSize: '1.1rem' }}>
          <span style={{ color: 'var(--success)' }}>✅ {stats.known} known</span> · 
          <span style={{ color: 'var(--danger)' }}>❌ {stats.unknown} unknown</span>
        </p>
        <button className="btn btn-brand" onClick={() => navigate('/library')} style={{ marginTop: '1rem' }}>
          Back to Library
        </button>
      </div>
    )
  }

  const frontText = currentWord.target_word
  const backText = currentWord.base_word
  const srs = srsData[currentWord.id] || {}

  return (
    <div style={{ maxWidth: '500px', margin: '0 auto' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.75rem', fontSize: '0.9rem', color: 'var(--text-muted)' }}>
        <span>{currentIndex + 1} / {words.length}</span>
        <span>✅ {stats.known} · ❌ {stats.unknown}</span>
      </div>

      <div
        onClick={() => setFlipped(!flipped)}
        style={{
          border: '2px solid var(--brand)',
          borderRadius: 'var(--radius)',
          padding: '2.5rem 1.5rem',
          textAlign: 'center',
          minHeight: '220px',
          display: 'flex',
          flexDirection: 'column',
          justifyContent: 'center',
          cursor: 'pointer',
          background: 'var(--card-bg)',
          boxShadow: 'var(--shadow)',
          transition: 'transform 0.2s',
        }}
      >
        <h1 style={{ fontSize: '2.2rem', marginBottom: '0.5rem', wordBreak: 'break-word' }}>
          {flipped ? backText : frontText}
        </h1>
        {!flipped && <p style={{ color: 'var(--text-muted)', margin: 0 }}>Tap card to reveal</p>}
      </div>

      <div className="srs-badge" style={{ marginTop: '0.5rem', justifyContent: 'center' }}>
        {srs.interval > 0 ? `Next review in ${srs.interval} days` : 'New'} · 
        {srs.repetition_count || 0}× correct · EF {srs.ease_factor?.toFixed(2) || '2.50'}
      </div>

      <div style={{ display: 'flex', justifyContent: 'center', gap: '1rem', marginTop: '1.5rem' }}>
        <button className="btn btn-danger" onClick={() => handleSwipe('left')} style={{ flex: 1, fontSize: '1.1rem' }}>
          ❌ Unknown
        </button>
        <button className="btn btn-success" onClick={() => handleSwipe('right')} style={{ flex: 1, fontSize: '1.1rem' }}>
          ✅ Known
        </button>
      </div>

      <div style={{ display: 'flex', justifyContent: 'center', gap: '1rem', marginTop: '1rem' }}>
        <button className="btn btn-outline" onClick={handleUndo} disabled={swipeHistory.length === 0}>
          ↩️ Undo ({swipeHistory.length})
        </button>
        <select
          value={srs.priority || 3}
          onChange={e => handlePriorityChange(parseInt(e.target.value))}
          style={{ padding: '0.5rem', borderRadius: 'var(--radius)', border: '2px solid #e0e0e0' }}
        >
          <option value={5}>⭐⭐⭐⭐⭐ Very Important</option>
          <option value={4}>⭐⭐⭐⭐ Important</option>
          <option value={3}>⭐⭐⭐ Normal</option>
          <option value={2}>⭐⭐ Less Important</option>
          <option value={1}>⭐ Unimportant</option>
        </select>
      </div>
    </div>
  )
}
