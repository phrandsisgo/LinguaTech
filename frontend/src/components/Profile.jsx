import { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api'

export default function Profile() {
  const [user, setUser] = useState(null)
  const navigate = useNavigate()

  useEffect(() => {
    api.get('/user').then(res => setUser(res.data))
  }, [])

  if (!user) return <p style={{ textAlign: 'center', padding: '2rem' }}>Loading...</p>

  const isActive = user.subscribed_until && new Date(user.subscribed_until) > new Date()

  return (
    <div style={{ maxWidth: '400px', margin: '0 auto' }}>
      <div className="card" style={{ textAlign: 'center' }}>
        <div style={{
          width: '80px', height: '80px', borderRadius: '50%',
          background: 'var(--brand)', color: 'white',
          display: 'flex', alignItems: 'center', justifyContent: 'center',
          fontSize: '2rem', fontWeight: 'bold', margin: '0 auto 1rem auto'
        }}>
          {user.name.charAt(0).toUpperCase()}
        </div>
        <h2 style={{ margin: '0 0 0.25rem 0' }}>{user.name}</h2>
        <p style={{ color: 'var(--text-muted)', margin: 0 }}>{user.email}</p>
      </div>

      <div className="card">
        <h3 style={{ marginTop: 0 }}>Subscription</h3>
        <p>
          Status: <strong>{isActive ? '✅ Active' : '❌ Inactive'}</strong>
        </p>
        {user.subscribed_until && <p>Until: {new Date(user.subscribed_until).toLocaleDateString()}</p>}
      </div>

      <button
        className="btn btn-danger"
        style={{ width: '100%' }}
        onClick={() => {
          localStorage.removeItem('token')
          navigate('/login')
          window.location.reload()
        }}
      >
        Logout
      </button>
    </div>
  )
}
