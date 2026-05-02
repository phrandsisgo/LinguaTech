import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import ErrorMessage from '../../components/ErrorMessage';

export default function LoginPage() {
  const { login } = useAuth();
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      await login(email, password);
      navigate('/home');
    } catch (err) {
      setError(err.response?.data?.message || 'Login fehlgeschlagen. Bitte überprüfe deine Zugangsdaten.');
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
      <div className="max-w-md w-full bg-white rounded-2xl shadow-md p-8">
        <h1 className="text-3xl font-bold text-indigo-600 text-center mb-2">LinguaTech</h1>
        <p className="text-gray-500 text-center mb-8">Anmelden</p>

        <ErrorMessage message={error} />

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              required
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Passwort</label>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
              required
            />
          </div>
          <button
            type="submit"
            disabled={loading}
            className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
          >
            {loading ? 'Anmelden...' : 'Anmelden'}
          </button>
        </form>

        <div className="mt-6 text-center space-y-2">
          <Link to="/forgot-password" className="text-sm text-indigo-600 hover:underline block">
            Passwort vergessen?
          </Link>
          <p className="text-sm text-gray-500">
            Noch kein Konto?{' '}
            <Link to="/register" className="text-indigo-600 hover:underline">
              Registrieren
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
}
