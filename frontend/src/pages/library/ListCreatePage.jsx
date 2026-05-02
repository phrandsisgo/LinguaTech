import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { apiCreateWordList } from '../../api';
import ErrorMessage from '../../components/ErrorMessage';

export default function ListCreatePage() {
  const navigate = useNavigate();
  const [listTitle, setListTitle] = useState('');
  const [listDescription, setListDescription] = useState('');
  const [words, setWords] = useState([{ baseWord: '', targetWord: '' }]);
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  function addWordRow() {
    setWords([...words, { baseWord: '', targetWord: '' }]);
  }

  function removeWordRow(index) {
    setWords(words.filter((_, i) => i !== index));
  }

  function updateWord(index, field, value) {
    const updated = [...words];
    updated[index][field] = value;
    setWords(updated);
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      await apiCreateWordList({
        listTitle,
        listDescription,
        baseWord: words.map((w) => w.baseWord),
        targetWord: words.map((w) => w.targetWord),
      });
      navigate('/library');
    } catch (err) {
      const errors = err.response?.data?.errors;
      if (errors) {
        setError(Object.values(errors).flat().join(' '));
      } else {
        setError(err.response?.data?.message || 'Fehler beim Erstellen der Liste.');
      }
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Neue Liste erstellen</h1>
        <Link to="/library" className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
      </div>

      <ErrorMessage message={error} />

      <form onSubmit={handleSubmit} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100 space-y-6">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Listenname *</label>
          <input
            type="text"
            value={listTitle}
            onChange={(e) => setListTitle(e.target.value)}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
            minLength={3}
            maxLength={40}
          />
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Beschreibung</label>
          <textarea
            value={listDescription}
            onChange={(e) => setListDescription(e.target.value)}
            className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            rows={2}
            maxLength={200}
          />
        </div>

        <div>
          <div className="flex items-center justify-between mb-3">
            <label className="text-sm font-medium text-gray-700">Wörter</label>
            <button
              type="button"
              onClick={addWordRow}
              className="text-sm text-indigo-600 hover:underline"
            >
              + Wort hinzufügen
            </button>
          </div>
          <div className="space-y-2">
            {words.map((word, index) => (
              <div key={index} className="flex gap-2 items-center">
                <input
                  type="text"
                  placeholder="Basiswort"
                  value={word.baseWord}
                  onChange={(e) => updateWord(index, 'baseWord', e.target.value)}
                  className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Zielwort"
                  value={word.targetWord}
                  onChange={(e) => updateWord(index, 'targetWord', e.target.value)}
                  className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  required
                />
                {words.length > 1 && (
                  <button
                    type="button"
                    onClick={() => removeWordRow(index)}
                    className="text-red-500 hover:text-red-700 px-2"
                  >
                    ✕
                  </button>
                )}
              </div>
            ))}
          </div>
        </div>

        <button
          type="submit"
          disabled={loading}
          className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
        >
          {loading ? 'Erstellen...' : 'Liste erstellen'}
        </button>
      </form>
    </div>
  );
}
