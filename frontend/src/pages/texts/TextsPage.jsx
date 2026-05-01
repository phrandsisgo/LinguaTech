import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiGetTexts, apiDeleteText } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function TextsPage() {
  const [texts, setTexts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    apiGetTexts()
      .then(({ data }) => setTexts(data))
      .catch(() => setError('Fehler beim Laden der Texte.'))
      .finally(() => setLoading(false));
  }, []);

  async function handleDelete(id) {
    if (!confirm('Text wirklich löschen?')) return;
    try {
      await apiDeleteText(id);
      setTexts(texts.filter((t) => t.id !== id));
    } catch {
      setError('Fehler beim Löschen.');
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Texte</h1>
        <div className="flex gap-2">
          <Link to="/add-text" className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
            + Text hinzufügen
          </Link>
          <Link to="/generate-text" className="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
            🤖 KI generieren
          </Link>
        </div>
      </div>

      <ErrorMessage message={error} />

      {texts.length === 0 ? (
        <div className="bg-white rounded-xl p-12 text-center">
          <p className="text-gray-400 text-lg mb-4">Noch keine Texte vorhanden.</p>
          <div className="flex gap-3 justify-center">
            <Link to="/add-text" className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
              Text hinzufügen
            </Link>
            <Link to="/generate-text" className="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-colors">
              KI generieren
            </Link>
          </div>
        </div>
      ) : (
        <div className="grid gap-4">
          {texts.map((text) => (
            <div key={text.id} className="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex items-start justify-between">
              <div className="flex-1 min-w-0 mr-4">
                <h3 className="font-semibold text-gray-900 text-lg mb-1">{text.title}</h3>
                {text.lang_option && (
                  <span className="text-xs bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded-full">
                    {text.lang_option.language_name}
                  </span>
                )}
                <p className="text-sm text-gray-500 mt-2 line-clamp-2">{text.text}</p>
              </div>
              <div className="flex gap-2 flex-shrink-0">
                <Link
                  to={`/text/${text.id}`}
                  className="text-sm bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg hover:bg-indigo-100"
                >
                  Lesen
                </Link>
                <Link
                  to={`/update-text/${text.id}`}
                  className="text-sm bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg hover:bg-yellow-100"
                >
                  Bearbeiten
                </Link>
                <button
                  onClick={() => handleDelete(text.id)}
                  className="text-sm bg-red-50 text-red-600 px-3 py-1.5 rounded-lg hover:bg-red-100"
                >
                  Löschen
                </button>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
