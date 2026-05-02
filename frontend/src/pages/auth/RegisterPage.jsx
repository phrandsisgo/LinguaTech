import { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import ErrorMessage from '../../components/ErrorMessage';

export default function RegisterPage() {
  const { register } = useAuth();
  const navigate = useNavigate();
  const [form, setForm] = useState({ name: '', email: '', password: '', password_confirmation: '' });
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  function handleChange(e) {
    setForm({ ...form, [e.target.name]: e.target.value });
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    if (form.password !== form.password_confirmation) {
      setError('Passwörter stimmen nicht überein.');
      return;
    }
    setLoading(true);
    try {
      await register(form.name, form.email, form.password, form.password_confirmation);
      navigate('/home');
    } catch (err) {
      const errors = err.response?.data?.errors;
      if (errors) {
        setError(Object.values(errors).flat().join(' '));
      } else {
        setError(err.response?.data?.message || 'Registrierung fehlgeschlagen.');
      }
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
      <div className="max-w-md w-full bg-white rounded-2xl shadow-md p-8">
        <h1 className="text-3xl font-bold text-indigo-600 text-center mb-2">LinguaTech</h1>
        <p className="text-gray-500 text-center mb-8">Konto erstellen</p>

        <ErrorMessage message={error} />

        <form onSubmit={handleSubmit} className="space-y-4">
          {[
            { label: 'Name', name: 'name', type: 'text' },
            { label: 'E-Mail', name: 'email', type: 'email' },
            { label: 'Passwort', name: 'password', type: 'password' },
            { label: 'Passwort bestätigen', name: 'password_confirmation', type: 'password' },
          ].map(({ label, name, type }) => (
            <div key={name}>
              <label className="block text-sm font-medium text-gray-700 mb-1">{label}</label>
              <input
                type={type}
                name={name}
                value={form[name]}
                onChange={handleChange}
                className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
              />
            </div>
          ))}
          <button
            type="submit"
            disabled={loading}
            className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
          >
            {loading ? 'Registrieren...' : 'Registrieren'}
          </button>
        </form>

        <p className="mt-6 text-center text-sm text-gray-500">
          Bereits ein Konto?{' '}
          <Link to="/login" className="text-indigo-600 hover:underline">
            Anmelden
          </Link>
        </p>
      </div>
    </div>
  );
}
