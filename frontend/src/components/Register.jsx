import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import api from '../api'

export default function Register() {
  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [passwordConfirmation, setPasswordConfirmation] = useState('')
  const [error, setError] = useState('')
  const navigate = useNavigate()

  async function handleSubmit(e) {
    e.preventDefault()
    setError('')
    if (password !== passwordConfirmation) {
      setError('Passwords do not match')
      return
    }
    try {
      const res = await api.post('/register', {
        name, email, password,
        password_confirmation: passwordConfirmation,
      })
      localStorage.setItem('token', res.data.token)
      navigate('/library')
      window.location.reload()
    } catch (err) {
      setError(err.response?.data?.message || 'Registration failed')
    }
  }

  return (
    <div style={{ maxWidth: '400px', margin: '0 auto', paddingTop: '2rem' }}>
      <div className="card">
        <h2 style={{ textAlign: 'center', marginTop: 0 }}>Register</h2>
        {error && (
          <div style={{ background: '#ffe0e0', color: '#c00', padding: '0.75rem', borderRadius: 'var(--radius)', marginBottom: '1rem' }}>
            {error}
          </div>
        )}
        <form onSubmit={handleSubmit}>
          <label>Name</label>
          <input
            type="text"
            placeholder="Your name"
            value={name}
            onChange={e => setName(e.target.value)}
            required
          />
          
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
            placeholder="Min. 8 characters"
            value={password}
            onChange={e => setPassword(e.target.value)}
            required
          />
          
          <label>Confirm Password</label>
          <input
            type="password"
            placeholder="Repeat password"
            value={passwordConfirmation}
            onChange={e => setPasswordConfirmation(e.target.value)}
            required
          />
          
          <button type="submit" className="btn btn-brand" style={{ width: '100%' }}>
            Create Account
          </button>
        </form>
        
        <p style={{ textAlign: 'center', marginTop: '1rem', marginBottom: 0 }}>
          Already have an account? <Link to="/login">Login</Link>
        </p>
      </div>
    </div>
  )
}
