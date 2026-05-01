import { Outlet, Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function Layout() {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  async function handleLogout() {
    await logout();
    navigate('/login');
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <nav className="bg-white shadow-sm border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center space-x-8">
              <Link to="/home" className="text-xl font-bold text-indigo-600">LinguaTech</Link>
              <div className="hidden md:flex space-x-6">
                <Link to="/home" className="text-gray-600 hover:text-indigo-600 transition-colors">Home</Link>
                <Link to="/library" className="text-gray-600 hover:text-indigo-600 transition-colors">Library</Link>
                <Link to="/texts" className="text-gray-600 hover:text-indigo-600 transition-colors">Texte</Link>
                <Link to="/generate-text" className="text-gray-600 hover:text-indigo-600 transition-colors">Generieren</Link>
                <Link to="/patch-notes" className="text-gray-600 hover:text-indigo-600 transition-colors">Patch Notes</Link>
              </div>
            </div>
            <div className="flex items-center space-x-4">
              {user && (
                <>
                  <span className="text-sm text-gray-500">{user.name}</span>
                  <Link to="/profile" className="text-gray-600 hover:text-indigo-600 transition-colors text-sm">Profil</Link>
                  <button
                    onClick={handleLogout}
                    className="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition-colors"
                  >
                    Logout
                  </button>
                </>
              )}
            </div>
          </div>
        </div>
      </nav>
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <Outlet />
      </main>
    </div>
  );
}
