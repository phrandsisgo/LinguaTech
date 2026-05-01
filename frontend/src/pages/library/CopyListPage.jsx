import { useState, useEffect } from 'react';
import { useParams, useNavigate, Link } from 'react-router-dom';
import { apiGetWordList, apiCopyWordList } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function CopyListPage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [liste, setListe] = useState(null);
  const [loading, setLoading] = useState(true);
  const [copying, setCopying] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    apiGetWordList(id)
      .then(({ data }) => setListe(data))
      .catch(() => setError('Fehler beim Laden.'))
      .finally(() => setLoading(false));
  }, [id]);

  async function handleCopy() {
    setCopying(true);
    try {
      await apiCopyWordList(id);
      navigate('/library');
    } catch {
      setError('Fehler beim Kopieren.');
      setCopying(false);
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Liste kopieren</h1>
        <Link to="/library" className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
      </div>

      <ErrorMessage message={error} />

      {liste && (
        <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
          <h2 className="text-xl font-semibold text-gray-900 mb-2">{liste.name}</h2>
          {liste.description && <p className="text-gray-500 mb-4">{liste.description}</p>}
          <p className="text-gray-700 mb-2">
            Diese Liste hat <strong>{liste.words?.length || 0}</strong> Wörter.
          </p>
          <p className="text-gray-600 mb-6">
            Eine Kopie dieser Liste wird in deiner Library erstellt.
          </p>
          <div className="flex gap-3">
            <button
              onClick={handleCopy}
              disabled={copying}
              className="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50"
            >
              {copying ? 'Kopieren...' : 'Liste kopieren'}
            </button>
            <Link
              to="/library"
              className="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors"
            >
              Abbrechen
            </Link>
          </div>
        </div>
      )}
    </div>
  );
}
