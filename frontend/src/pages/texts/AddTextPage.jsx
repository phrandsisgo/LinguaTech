import { useState, useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { apiCreateText, apiGetLanguages } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function AddTextPage() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ title: '', text: '', lang_option_id: '' });
  const [languages, setLanguages] = useState([]);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    apiGetLanguages()
      .then(({ data }) => setLanguages(data))
      .catch(() => setError('Sprachen konnten nicht geladen werden.'))
      .finally(() => setLoading(false));
  }, []);

  function handleChange(e) {
    setForm({ ...form, [e.target.name]: e.target.value });
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setSaving(true);
    try {
      const { data } = await apiCreateText(form);
      navigate(`/text/${data.id}`);
    } catch (err) {
      const errors = err.response?.data?.errors;
      if (errors) {
        setError(Object.values(errors).flat().join(' '));
      } else {
        setError(err.response?.data?.message || 'Fehler beim Erstellen.');
      }
    } finally {
      setSaving(false);
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Text hinzufügen</h1>
        <Link to="/texts" className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
      </div>

      <ErrorMessage message={error} />

      <form onSubmit={handleSubmit} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100 space-y-5">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Titel *</label>
          <input
            type="text"
            name="title"
            value={form.title}
            onChange={handleChange}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
            maxLength={255}
          />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Sprache *</label>
          <select
            name="lang_option_id"
            value={form.lang_option_id}
            onChange={handleChange}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          >
            <option value="">Sprache auswählen...</option>
            {languages.map((lang) => (
              <option key={lang.id} value={lang.id}>{lang.language_name}</option>
            ))}
          </select>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Text *</label>
          <textarea
            name="text"
            value={form.text}
            onChange={handleChange}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            rows={10}
            required
          />
        </div>
        <button
          type="submit"
          disabled={saving}
          className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
        >
          {saving ? 'Speichern...' : 'Text hinzufügen'}
        </button>
      </form>
    </div>
  );
}
