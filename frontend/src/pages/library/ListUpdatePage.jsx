import { useState, useEffect } from 'react';
import { useParams, useNavigate, Link } from 'react-router-dom';
import { apiGetWordList, apiUpdateWordList } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function ListUpdatePage() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [listTitle, setListTitle] = useState('');
  const [listDescription, setListDescription] = useState('');
  const [words, setWords] = useState([]);
  const [deletedWordIds, setDeletedWordIds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    apiGetWordList(id)
      .then(({ data }) => {
        setListTitle(data.name);
        setListDescription(data.description || '');
        setWords(data.words.map((w) => ({ ...w, _id: w.id })));
      })
      .catch(() => setError('Fehler beim Laden.'))
      .finally(() => setLoading(false));
  }, [id]);

  function addWord() {
    setWords([...words, { _id: 'new', base_word: '', target_word: '' }]);
  }

  function removeWord(index) {
    const word = words[index];
    if (word._id !== 'new') {
      setDeletedWordIds([...deletedWordIds, word._id]);
    }
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
    setSaving(true);
    try {
      await apiUpdateWordList(id, {
        listTitle,
        listDescription,
        baseWord: words.map((w) => w.base_word),
        targetWord: words.map((w) => w.target_word),
        wordIds: words.map((w) => String(w._id)),
        deletedWordIds,
      });
      navigate(`/list-show/${id}`);
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

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">Liste bearbeiten</h1>
        <Link to={`/list-show/${id}`} className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
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
            <button type="button" onClick={addWord} className="text-sm text-indigo-600 hover:underline">
              + Wort hinzufügen
            </button>
          </div>
          <div className="space-y-2">
            {words.map((word, index) => (
              <div key={index} className="flex gap-2 items-center">
                <input
                  type="text"
                  placeholder="Basiswort"
                  value={word.base_word}
                  onChange={(e) => updateWord(index, 'base_word', e.target.value)}
                  className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Zielwort"
                  value={word.target_word}
                  onChange={(e) => updateWord(index, 'target_word', e.target.value)}
                  className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                  required
                />
                <button
                  type="button"
                  onClick={() => removeWord(index)}
                  className="text-red-500 hover:text-red-700 px-2"
                >
                  ✕
                </button>
              </div>
            ))}
          </div>
        </div>

        <button
          type="submit"
          disabled={saving}
          className="w-full bg-indigo-600 text-white py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors disabled:opacity-50"
        >
          {saving ? 'Speichern...' : 'Änderungen speichern'}
        </button>
      </form>
    </div>
  );
}
