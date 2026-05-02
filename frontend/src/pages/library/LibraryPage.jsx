import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiGetWordLists, apiDeleteWordList } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function LibraryPage() {
  const [wordlists, setWordlists] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    loadLists();
  }, []);

  async function loadLists() {
    try {
      const { data } = await apiGetWordLists();
      setWordlists(data);
    } catch {
      setError('Fehler beim Laden der Listen.');
    } finally {
      setLoading(false);
    }
  }

  async function handleDelete(id) {
    if (!confirm('Liste wirklich löschen?')) return;
    try {
      await apiDeleteWordList(id);
      setWordlists(wordlists.filter((l) => l.id !== id));
    } catch {
      setError('Fehler beim Löschen.');
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Library</h1>
        <Link
          to="/list-create"
          className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors"
        >
          + Neue Liste
        </Link>
      </div>

      <ErrorMessage message={error} />

      {wordlists.length === 0 ? (
        <div className="bg-white rounded-xl p-12 text-center">
          <p className="text-gray-400 text-lg mb-4">Noch keine Wortlisten vorhanden.</p>
          <Link to="/list-create" className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
            Erste Liste erstellen
          </Link>
        </div>
      ) : (
        <div className="grid gap-4">
          {wordlists.map((list) => (
            <div key={list.id} className="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
              <div>
                <h3 className="font-semibold text-gray-900 text-lg">{list.name}</h3>
                {list.description && (
                  <p className="text-sm text-gray-500 mt-1">{list.description}</p>
                )}
              </div>
              <div className="flex gap-2 flex-wrap justify-end">
                <Link
                  to={`/list-show/${list.id}`}
                  className="text-sm bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg hover:bg-indigo-100"
                >
                  Anzeigen
                </Link>
                <Link
                  to={`/swipe-learn/${list.id}`}
                  className="text-sm bg-green-50 text-green-600 px-3 py-1.5 rounded-lg hover:bg-green-100"
                >
                  Lernen
                </Link>
                <Link
                  to={`/list-update/${list.id}`}
                  className="text-sm bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg hover:bg-yellow-100"
                >
                  Bearbeiten
                </Link>
                <Link
                  to={`/copy-list/${list.id}`}
                  className="text-sm bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg hover:bg-blue-100"
                >
                  Kopieren
                </Link>
                <button
                  onClick={() => handleDelete(list.id)}
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
