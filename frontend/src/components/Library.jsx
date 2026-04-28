import { useEffect, useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import api from '../api'

export default function Library() {
  const [lists, setLists] = useState([])
  const [loading, setLoading] = useState(true)
  const navigate = useNavigate()

  useEffect(() => {
    api.get('/lists/own')
      .then(res => setLists(res.data))
      .catch(() => navigate('/login'))
      .finally(() => setLoading(false))
  }, [navigate])

  if (loading) return <p style={{ textAlign: 'center', padding: '2rem' }}>Loading...</p>

  return (
    <div>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
        <h2 style={{ margin: 0 }}>My Lists</h2>
      </div>

      {lists.length === 0 && (
        <div className="card" style={{ textAlign: 'center', color: 'var(--text-muted)' }}>
          <p>No lists yet. Create one in the web app!</p>
        </div>
      )}

      {lists.map(list => (
        <div key={list.id} className="card">
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
            <div>
              <h3 style={{ margin: '0 0 0.25rem 0' }}>{list.name}</h3>
              <p style={{ margin: 0, color: 'var(--text-muted)', fontSize: '0.9rem' }}>{list.words?.length || 0} words · Created {new Date(list.created_at).toLocaleDateString()}</p>
            </div>
            <Link to={`/swipe/${list.id}`}>
              <button className="btn btn-brand">Learn →</button>
            </Link>
          </div>
        </div>
      ))}
    </div>
  )
}
