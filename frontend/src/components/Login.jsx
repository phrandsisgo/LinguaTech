import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import api from '../api'

export default function Login() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [error, setError] = useState('')
  const navigate = useNavigate()

  async function handleSubmit(e) {
    e.preventDefault()
    setError('')
    try {
      const res = await api.post('/login', { email, password })
      localStorage.setItem('token', res.data.token)
      navigate('/library')
      window.location.reload()
    } catch (err) {
      setError(err.response?.data?.message || 'Invalid credentials')
    }
  }

  return (
    <div style={{ maxWidth: '400px', margin: '0 auto', paddingTop: '2rem' }}>
      <div className="card">
        <h2 style={{ textAlign: 'center', marginTop: 0 }}>Login</h2>
        {error && (
          <div style={{ background: '#ffe0e0', color: '#c00', padding: '0.75rem', borderRadius: 'var(--radius)', marginBottom: '1rem' }}>
            {error}
          </div>
        )}
        <form onSubmit={handleSubmit}>
          <label>Email</label>
          <input
            type="email"
            placeholder="you@example.com"
            value={email}
            onChange={e => setEmail(e.target.value)}
            required
          />
          
          <label>Password</label>
          <input
            type="password"
            placeholder="••••••••"
            value={password}
            onChange={e => setPassword(e.target.value)}
            required
          />
          
          <button type="submit" className="btn btn-brand" style={{ width: '100%' }}>
            Login
          </button>
        </form>
        
        <p style={{ textAlign: 'center', marginTop: '1rem', marginBottom: 0 }}>
          No account? <Link to="/register">Register</Link>
        </p>
      </div>
    </div>
  )
}
