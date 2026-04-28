import { useEffect, useState } from 'react'
import { useParams, Link } from 'react-router-dom'
import api from '../api'

export default function ListDetail() {
  const { id } = useParams()
  const [data, setData] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    api.get(`/lists/${id}`).then(res => {
      setData(res.data)
      setLoading(false)
    })
  }, [id])

  if (loading) return <p style={{ textAlign: 'center', padding: '2rem' }}>Loading...</p>
  const { list, srsData } = data

  return (
    <div>
      <Link to="/library" style={{ fontSize: '0.9rem' }}>← Back to Library</Link>
      <h2 style={{ marginTop: '0.5rem' }}>{list.name}</h2>
      <p style={{ color: 'var(--text-muted)' }}>{list.description}</p>
      
      <Link to={`/swipe/${list.id}`}>
        <button className="btn btn-brand" style={{ marginBottom: '1rem' }}>Start Learning →</button>
      </Link>

      <h3>Words ({list.words.length})</h3>
      {list.words.map(w => {
        const srs = srsData[w.id] || {}
        return (
          <div key={w.id} className="card" style={{ padding: '0.75rem 1rem', marginBottom: '0.5rem' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
              <div>
                <strong>{w.target_word}</strong>
                <span style={{ color: 'var(--text-muted)', marginLeft: '0.5rem' }}>→ {w.base_word}</span>
              </div>
              <div className="srs-badge">
                {srs.repetition_count || 0}× · EF {srs.ease_factor?.toFixed(2) || '2.50'} · {srs.interval || 0}d
              </div>
            </div>
          </div>
        )
      })}
    </div>
  )
}
