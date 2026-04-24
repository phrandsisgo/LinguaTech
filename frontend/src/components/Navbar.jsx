import React, { useState, useRef, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';

export default function Navbar() {
  const { user, isAuthenticated, logout } = useAuth();
  const navigate = useNavigate();
  const [menuOpen, setMenuOpen] = useState(false);
  const [langOpen, setLangOpen] = useState(false);
  const langRef = useRef(null);

  useEffect(() => {
    function handleClickOutside(event) {
      if (langRef.current && !langRef.current.contains(event.target)) {
        setLangOpen(false);
      }
    }
    document.addEventListener('click', handleClickOutside);
    return () => document.removeEventListener('click', handleClickOutside);
  }, []);

  const handleLogout = (e) => {
    e.preventDefault();
    logout();
    navigate('/');
  };

  return (
    <nav>
      <div className="nav-wrapper">
        <Link to="/home" className="iconWrapper" style={{ marginLeft: 8, marginRight: 0 }}>
          <svg width="80" height="82" viewBox="0 0 500 508" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M204.838 6.19855C198.538 8.79855...Z" fill="#06D6A0"/>
          </svg>
        </Link>
        <div className="horizontal-fill"></div>
        <p id="navText">LinguaTech</p>
        <div className="horizontal-fill"></div>

        <div className="langDropdownMenu" ref={langRef}>
          <input
            type="checkbox"
            id="dropdownCheckbox"
            className="dropdownCheckbox"
            checked={langOpen}
            onChange={() => setLangOpen(!langOpen)}
          />
          <label htmlFor="dropdownCheckbox" id="nav-lang-label" className="dropdownLabel">
            <div className="displayFlex" style={{ justifyContent: 'center', alignItems: 'center' }}>
              <p id="currentLocalLanuguage" style={{ transform: 'translate(3px, 10px)' }}>DE</p>
              <img src="/svg-icons/arrow-down-icon.svg" id="nav-label-icon" alt="icon für Spracheinstellung" />
            </div>
          </label>
          <ul className="dropdown-content" style={{ display: langOpen ? 'block' : 'none' }}>
            <li><a href="#" onClick={(e) => { e.preventDefault(); setLangOpen(false); }}>Deutsch</a></li>
            <li><a href="#" onClick={(e) => { e.preventDefault(); setLangOpen(false); }}>English</a></li>
          </ul>
        </div>

        {isAuthenticated && (
          <>
            <Link to="/about_project" className="iconWrapper">
              <img src="/svg-icons/info-icon.svg" alt="impressum Icon" className="icons des-only" />
            </Link>
            <Link to="/home" className="iconWrapper">
              <img src="/svg-icons/library-icon.svg" alt="library Icon" className="icons navIcons des-only" />
            </Link>
          </>
        )}

        <div className="btn-group">
          <button type="button" className="btn menuBtn" onClick={() => setMenuOpen(!menuOpen)}>
            <img src="/svg-icons/menu-icon.svg" alt="menu Icon" className="navIcons" />
          </button>
          <ul className="dropdown-color dropdown-menu dropdown-menu-end z-index-up" style={{ display: menuOpen ? 'block' : 'none' }}>
            {isAuthenticated ? (
              <>
                <li className="mob-only"><Link className="approvetext dropdown-item" to="/home" onClick={() => setMenuOpen(false)}>Home</Link></li>
                <li className="mob-only"><Link className="approvetext dropdown-item" to="/library" onClick={() => setMenuOpen(false)}>Flashcards</Link></li>
                <li><Link className="approvetext dropdown-item" to="/displayAllTexts" onClick={() => setMenuOpen(false)}>Texts</Link></li>
                <li><Link className="approvetext dropdown-item" to="/profile" onClick={() => setMenuOpen(false)}>Profile{user?.name ? ` (${user.name})` : ''}</Link></li>
                <li><Link className="approvetext dropdown-item" to="/about_me" onClick={() => setMenuOpen(false)}>About Developer</Link></li>
                <li><Link className="approvetext dropdown-item" to="/about_project" onClick={() => setMenuOpen(false)}>About Project</Link></li>
                <li>
                  <button type="submit" className="approvetext dropdown-item" onClick={handleLogout}>Logout</button>
                </li>
              </>
            ) : (
              <>
                <li><Link className="approvetext dropdown-item" to="/about_me" onClick={() => setMenuOpen(false)}>About Developer</Link></li>
                <li><Link className="approvetext dropdown-item" to="/about_project" onClick={() => setMenuOpen(false)}>About Project</Link></li>
                <li><Link className="approvetext dropdown-item" to="/login" onClick={() => setMenuOpen(false)}>Login</Link></li>
                <li><Link className="approvetext dropdown-item" to="/register" onClick={() => setMenuOpen(false)}>Register</Link></li>
              </>
            )}
          </ul>
        </div>
      </div>
    </nav>
  );
}
