import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { apiGetLanguages, apiInitiateProfile } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function InitiateProfilePage() {
  const navigate = useNavigate();
  const [languages, setLanguages] = useState([]);
  const [selectedLanguages, setSelectedLanguages] = useState([]);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    apiGetLanguages()
      .then(({ data }) => setLanguages(data))
      .catch(() => setError('Fehler beim Laden der Sprachen.'))
      .finally(() => setLoading(false));
  }, []);

  function toggleLanguage(id) {
    setSelectedLanguages((prev) =>
      prev.includes(id) ? prev.filter((l) => l !== id) : [...prev, id]
    );
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setSaving(true);
    setError('');
    try {
      await apiInitiateProfile({ languages: selectedLanguages });
      navigate('/home');
    } catch {
      setError('Fehler beim Speichern.');
      setSaving(false);
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
      <div className="max-w-lg w-full">
        <div className="text-center mb-8">
          <h1 className="text-3xl font-bold text-indigo-600 mb-2">Willkommen bei LinguaTech!</h1>
          <p className="text-gray-600">Wähle die Sprachen, die du lernen möchtest.</p>
        </div>

        <ErrorMessage message={error} />

        <form onSubmit={handleSubmit} className="bg-white rounded-2xl p-6 shadow-md">
          <h2 className="font-semibold text-gray-900 text-lg mb-4">Sprachen auswählen</h2>
          <div className="grid grid-cols-2 gap-3 mb-6">
            {languages.map((lang) => (
              <button
                key={lang.id}
                type="button"
                onClick={() => toggleLanguage(lang.id)}
                className={`p-3 rounded-xl border-2 text-sm font-medium transition-all ${
                  selectedLanguages.includes(lang.id)
                    ? 'border-indigo-600 bg-indigo-50 text-indigo-700'
                    : 'border-gray-200 text-gray-700 hover:border-indigo-300'
                }`}
              >
                {lang.language_name}
              </button>
            ))}
          </div>
          <button
            type="submit"
            disabled={saving}
            className="w-full bg-indigo-600 text-white py-3 rounded-xl font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50 text-lg"
          >
            {saving ? 'Speichern...' : 'Los geht\'s!'}
          </button>
        </form>
      </div>
    </div>
  );
}
