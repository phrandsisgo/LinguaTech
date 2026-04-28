import { Link } from 'react-router-dom'

export default function LandingPage() {
  return (
    <div style={{ textAlign: 'center', paddingTop: '3rem' }}>
      <h1 style={{ fontSize: '2.5rem', marginBottom: '0.5rem', color: 'var(--brand-dark)' }}>
        LinguaTech
      </h1>
      <p style={{ fontSize: '1.1rem', color: 'var(--text-muted)', marginBottom: '2rem' }}>
        Spaced Repetition Language Learning
      </p>
      
      <div style={{ display: 'flex', justifyContent: 'center', gap: '1rem' }}>
        <Link to="/login">
          <button className="btn btn-brand" style={{ minWidth: '140px' }}>
            Login
          </button>
        </Link>
        <Link to="/register">
          <button className="btn btn-outline" style={{ minWidth: '140px' }}>
            Register
          </button>
        </Link>
      </div>
      
      <div className="card" style={{ marginTop: '3rem', textAlign: 'left' }}>
        <h3>🧠 Spaced Repetition</h3>
        <p>Learn vocabulary efficiently with science-backed intervals.</p>
        
        <h3 style={{ marginTop: '1rem' }}>📚 Word Lists</h3>
        <p>Create, share and subscribe to vocabulary lists.</p>
        
        <h3 style={{ marginTop: '1rem' }}>🤖 AI Text Generation</h3>
        <p>Generate stories in your target language with OpenAI or Ollama.</p>
      </div>
    </div>
  )
}
