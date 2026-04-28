import { Routes, Route, Link, useLocation } from 'react-router-dom'
import Login from './components/Login'
import Register from './components/Register'
import Library from './components/Library'
import ListDetail from './components/ListDetail'
import SwipeLearn from './components/SwipeLearn'
import Profile from './components/Profile'
import LandingPage from './components/LandingPage'

function App() {
  const token = localStorage.getItem('token')
  const location = useLocation()
  const isAuthPage = location.pathname === '/login' || location.pathname === '/register'

  return (
    <div>
      <nav className="nav">
        <div className="nav-inner">
          <Link to="/" className="nav-brand">LinguaTech</Link>
          {token && (
            <div className="nav-links">
              <Link to="/library">Library</Link>
              <Link to="/profile">Profile</Link>
            </div>
          )}
        </div>
      </nav>

      <div className="container" style={{ paddingTop: isAuthPage ? '2rem' : '1rem' }}>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/library" element={<Library />} />
          <Route path="/lists/:id" element={<ListDetail />} />
          <Route path="/swipe/:id" element={<SwipeLearn />} />
          <Route path="/profile" element={<Profile />} />
          <Route path="/" element={token ? <Library /> : <LandingPage />} />
        </Routes>
      </div>
    </div>
  )
}

export default App
