import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { apiGetWordList, apiAddWord, apiDeleteWord } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function ListShowPage() {
  const { id } = useParams();
  const [liste, setListe] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [newWord, setNewWord] = useState({ baseWord: '', targetWord: '' });
  const [adding, setAdding] = useState(false);

  useEffect(() => {
    loadList();
  }, [id]);

  async function loadList() {
    try {
      const { data } = await apiGetWordList(id);
      setListe(data);
    } catch {
      setError('Fehler beim Laden der Liste.');
    } finally {
      setLoading(false);
    }
  }

  async function handleAddWord(e) {
    e.preventDefault();
    setAdding(true);
    try {
      await apiAddWord(id, newWord);
      setNewWord({ baseWord: '', targetWord: '' });
      await loadList();
    } catch {
      setError('Fehler beim Hinzufügen des Wortes.');
    } finally {
      setAdding(false);
    }
  }

  async function handleDeleteWord(wordId) {
    if (!confirm('Wort wirklich löschen?')) return;
    try {
      await apiDeleteWord(wordId);
      setListe({ ...liste, words: liste.words.filter((w) => w.id !== wordId) });
    } catch {
      setError('Fehler beim Löschen des Wortes.');
    }
  }

  if (loading) return <LoadingSpinner />;
  if (!liste) return <div className="text-center text-gray-500">Liste nicht gefunden.</div>;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">{liste.name}</h1>
          {liste.description && <p className="text-gray-500 mt-1">{liste.description}</p>}
        </div>
        <div className="flex gap-2">
          <Link to={`/swipe-learn/${id}`} className="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
            Lernen
          </Link>
          <Link to={`/list-update/${id}`} className="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
            Bearbeiten
          </Link>
          <Link to="/library" className="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
            Zurück
          </Link>
        </div>
      </div>

      <ErrorMessage message={error} />

      {/* Add Word Form */}
      <div className="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
        <h2 className="font-semibold text-gray-900 mb-3">Wort hinzufügen</h2>
        <form onSubmit={handleAddWord} className="flex gap-3">
          <input
            type="text"
            placeholder="Basiswort"
            value={newWord.baseWord}
            onChange={(e) => setNewWord({ ...newWord, baseWord: e.target.value })}
            className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          />
          <input
            type="text"
            placeholder="Zielwort"
            value={newWord.targetWord}
            onChange={(e) => setNewWord({ ...newWord, targetWord: e.target.value })}
            className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          />
          <button
            type="submit"
            disabled={adding}
            className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50"
          >
            {adding ? 'Hinzufügen...' : 'Hinzufügen'}
          </button>
        </form>
      </div>

      {/* Words Table */}
      <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table className="w-full">
          <thead>
            <tr className="bg-gray-50 border-b border-gray-100">
              <th className="text-left px-6 py-3 text-sm font-medium text-gray-700">Basiswort</th>
              <th className="text-left px-6 py-3 text-sm font-medium text-gray-700">Zielwort</th>
              <th className="text-left px-6 py-3 text-sm font-medium text-gray-700">Aktionen</th>
            </tr>
          </thead>
          <tbody>
            {liste.words?.length === 0 ? (
              <tr>
                <td colSpan={3} className="px-6 py-8 text-center text-gray-400">
                  Noch keine Wörter in dieser Liste.
                </td>
              </tr>
            ) : (
              liste.words?.map((word) => (
                <tr key={word.id} className="border-b border-gray-50 last:border-0">
                  <td className="px-6 py-3 text-gray-900">{word.base_word}</td>
                  <td className="px-6 py-3 text-gray-900">{word.target_word}</td>
                  <td className="px-6 py-3">
                    <button
                      onClick={() => handleDeleteWord(word.id)}
                      className="text-sm text-red-600 hover:underline"
                    >
                      Löschen
                    </button>
                  </td>
                </tr>
              ))
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
