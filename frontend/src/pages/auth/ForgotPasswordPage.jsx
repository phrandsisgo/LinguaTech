import { useState } from 'react';
import { Link } from 'react-router-dom';
import { apiForgotPassword } from '../../api';
import ErrorMessage from '../../components/ErrorMessage';

export default function ForgotPasswordPage() {
  const [email, setEmail] = useState('');
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setSuccess('');
    setLoading(true);
    try {
      const { data } = await apiForgotPassword(email);
      setSuccess(data.message || 'Passwort-Reset-Link wurde gesendet.');
    } catch (err) {
      setError(err.response?.data?.message || 'Ein Fehler ist aufgetreten.');
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
      <div className="max-w-md w-full bg-white rounded-2xl shadow-md p-8">
        <h1 className="text-3xl font-bold text-indigo-600 text-center mb-2">LinguaTech</h1>
        <p className="text-gray-500 text-center mb-8">Passwort zurücksetzen</p>

        <ErrorMessage message={error} />
        {success && (
          <div className="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {success}
          </div>
        )}

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
          <button
            type="submit"
            disabled={loading}
            className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
          >
            {loading ? 'Senden...' : 'Reset-Link senden'}
          </button>
        </form>

        <p className="mt-6 text-center text-sm text-gray-500">
          <Link to="/login" className="text-indigo-600 hover:underline">Zurück zum Login</Link>
        </p>
      </div>
    </div>
  );
}
