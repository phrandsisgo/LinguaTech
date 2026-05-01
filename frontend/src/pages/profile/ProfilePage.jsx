import { useState, useEffect } from 'react';
import { useAuth } from '../../context/AuthContext';
import { apiUpdateProfile, apiDeleteProfile, apiUpdateInterests, apiAddLanguage, apiRemoveLanguage, apiCancelSubscription } from '../../api';
import ErrorMessage from '../../components/ErrorMessage';

export default function ProfilePage() {
  const { user, fetchUser, logout } = useAuth();
  const [form, setForm] = useState({ name: '', email: '' });
  const [saving, setSaving] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');

  useEffect(() => {
    if (user) {
      setForm({ name: user.name, email: user.email });
    }
  }, [user]);

  function handleChange(e) {
    setForm({ ...form, [e.target.name]: e.target.value });
  }

  async function handleUpdate(e) {
    e.preventDefault();
    setError('');
    setSuccess('');
    setSaving(true);
    try {
      await apiUpdateProfile(form);
      await fetchUser();
      setSuccess('Profil erfolgreich aktualisiert.');
    } catch (err) {
      const errors = err.response?.data?.errors;
      if (errors) {
        setError(Object.values(errors).flat().join(' '));
      } else {
        setError(err.response?.data?.message || 'Fehler beim Speichern.');
      }
    } finally {
      setSaving(false);
    }
  }

  async function handleDeleteAccount() {
    const password = prompt('Bitte gib dein Passwort ein, um das Konto zu löschen:');
    if (!password) return;
    try {
      await apiDeleteProfile({ password });
      await logout();
    } catch {
      setError('Fehler beim Löschen des Kontos.');
    }
  }

  async function handleCancelSubscription() {
    if (!confirm('Abonnement wirklich kündigen?')) return;
    try {
      await apiCancelSubscription();
      setSuccess('Abonnement wurde gekündigt.');
      await fetchUser();
    } catch (err) {
      setError(err.response?.data?.error || 'Fehler beim Kündigen.');
    }
  }

  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Mein Profil</h1>

      <ErrorMessage message={error} />
      {success && (
        <div className="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
          {success}
        </div>
      )}

      {/* Profile Form */}
      <form onSubmit={handleUpdate} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100 space-y-4">
        <h2 className="font-semibold text-gray-900 text-lg">Persönliche Daten</h2>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Name</label>
          <input
            type="text"
            name="name"
            value={form.name}
            onChange={handleChange}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
          <input
            type="email"
            name="email"
            value={form.email}
            onChange={handleChange}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          />
        </div>
        <button
          type="submit"
          disabled={saving}
          className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50"
        >
          {saving ? 'Speichern...' : 'Speichern'}
        </button>
      </form>

      {/* Subscription */}
      <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 className="font-semibold text-gray-900 text-lg mb-3">Abonnement</h2>
        {user?.subscription_status === 'active' ? (
          <div>
            <p className="text-gray-700 mb-3">
              Dein Abonnement ist aktiv.
              {user?.subscribed_until && (
                <span className="text-gray-500 ml-2">
                  (läuft bis {new Date(user.subscribed_until).toLocaleDateString('de-CH')})
                </span>
              )}
            </p>
            <button
              onClick={handleCancelSubscription}
              className="bg-red-50 text-red-600 border border-red-200 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors"
            >
              Abonnement kündigen
            </button>
          </div>
        ) : (
          <div>
            <p className="text-gray-600 mb-3">Du hast kein aktives Abonnement.</p>
            <a href="/app/stripe" className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors inline-block">
              Premium abonnieren
            </a>
          </div>
        )}
      </div>

      {/* Danger Zone */}
      <div className="bg-white rounded-xl p-6 shadow-sm border border-red-100">
        <h2 className="font-semibold text-red-700 text-lg mb-3">Gefahrenzone</h2>
        <p className="text-gray-600 mb-4">Das Löschen des Kontos ist unwiderruflich.</p>
        <button
          onClick={handleDeleteAccount}
          className="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors"
        >
          Konto löschen
        </button>
      </div>
    </div>
  );
}
