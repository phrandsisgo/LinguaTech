import { useState, useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { apiGenerateText, apiGetLanguages, apiGetWordLists } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function GenerateTextPage() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ title: '', description: '', lang_option_id: '', deck_id: '' });
  const [languages, setLanguages] = useState([]);
  const [decks, setDecks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [generating, setGenerating] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    Promise.all([apiGetLanguages(), apiGetWordLists()])
      .then(([langRes, deckRes]) => {
        setLanguages(langRes.data);
        setDecks(deckRes.data);
      })
      .catch(() => setError('Fehler beim Laden.'))
      .finally(() => setLoading(false));
  }, []);

  function handleChange(e) {
    setForm({ ...form, [e.target.name]: e.target.value });
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setGenerating(true);
    try {
      const payload = {
        ...form,
        deck_id: form.deck_id || null,
      };
      const { data } = await apiGenerateText(payload);
      navigate(`/text/${data.id}`);
    } catch (err) {
      const errors = err.response?.data?.errors;
      if (errors) {
        setError(Object.values(errors).flat().join(' '));
      } else {
        setError(err.response?.data?.message || 'Fehler bei der Generierung.');
      }
      setGenerating(false);
    }
  }

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">🤖 Text generieren</h1>
          <p className="text-gray-500 mt-1">Lass KI einen Lerntext für dich erstellen.</p>
        </div>
        <Link to="/texts" className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
      </div>

      <ErrorMessage message={error} />

      {generating ? (
        <div className="bg-white rounded-xl p-12 text-center shadow-sm border border-gray-100">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mx-auto mb-4"></div>
          <p className="text-gray-700 font-medium">Text wird generiert...</p>
          <p className="text-gray-400 text-sm mt-2">Dies kann einige Sekunden dauern.</p>
        </div>
      ) : (
        <form onSubmit={handleSubmit} className="bg-white rounded-xl p-6 shadow-sm border border-gray-100 space-y-5">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Titel *</label>
            <input
              type="text"
              name="title"
              value={form.title}
              onChange={handleChange}
              placeholder="z.B. 'Der Markt in Sevilla'"
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
              required
              maxLength={255}
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Thema / Anweisungen *</label>
            <textarea
              name="description"
              value={form.description}
              onChange={handleChange}
              placeholder="Beschreibe das Thema oder gib spezifische Anweisungen, z.B. 'Eine Geschichte über einen Ausflug ans Meer, Präteritum verwenden'"
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
              rows={4}
              required
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Sprache *</label>
            <select
              name="lang_option_id"
              value={form.lang_option_id}
              onChange={handleChange}
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
              required
            >
              <option value="">Sprache auswählen...</option>
              {languages.map((lang) => (
                <option key={lang.id} value={lang.id}>{lang.language_name}</option>
              ))}
            </select>
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">Vokabular-Deck einbauen (optional)</label>
            <select
              name="deck_id"
              value={form.deck_id}
              onChange={handleChange}
              className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
              <option value="">Kein Deck auswählen</option>
              {decks.map((deck) => (
                <option key={deck.id} value={deck.id}>{deck.name}</option>
              ))}
            </select>
            <p className="text-xs text-gray-400 mt-1">
              Die Vokabeln aus dem gewählten Deck werden in den Text eingebaut.
            </p>
          </div>
          <button
            type="submit"
            className="w-full bg-purple-600 text-white py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors text-lg"
          >
            🤖 Text generieren
          </button>
        </form>
      )}
    </div>
  );
}
