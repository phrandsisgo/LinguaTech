import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { apiGetText, apiTranslate } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';
import ErrorMessage from '../../components/ErrorMessage';

export default function TextShowPage() {
  const { id } = useParams();
  const [text, setText] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [wordToTranslate, setWordToTranslate] = useState('');
  const [targetLang, setTargetLang] = useState('DE');
  const [translation, setTranslation] = useState('');
  const [translating, setTranslating] = useState(false);

  useEffect(() => {
    apiGetText(id)
      .then(({ data }) => setText(data))
      .catch(() => setError('Text nicht gefunden.'))
      .finally(() => setLoading(false));
  }, [id]);

  async function handleTranslate(e) {
    e.preventDefault();
    if (!wordToTranslate.trim()) return;
    setTranslating(true);
    setTranslation('');
    try {
      const { data } = await apiTranslate({
        word: wordToTranslate,
        targetLang,
        baseLang: text?.lang_option?.language_code || null,
        context: text?.text?.substring(0, 200) || '',
      });
      setTranslation(data.translation);
    } catch {
      setTranslation('Übersetzung fehlgeschlagen.');
    } finally {
      setTranslating(false);
    }
  }

  function handleTextSelection() {
    const selected = window.getSelection()?.toString().trim();
    if (selected) {
      setWordToTranslate(selected);
    }
  }

  if (loading) return <LoadingSpinner />;
  if (!text) return <div className="text-center text-gray-500 py-12">Text nicht gefunden.</div>;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">{text.title}</h1>
          {text.lang_option && (
            <span className="text-sm bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full mt-2 inline-block">
              {text.lang_option.language_name}
            </span>
          )}
        </div>
        <div className="flex gap-2">
          <Link
            to={`/update-text/${id}`}
            className="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors"
          >
            Bearbeiten
          </Link>
          <Link to="/texts" className="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
            Zurück
          </Link>
        </div>
      </div>

      <ErrorMessage message={error} />

      {/* Text Content */}
      <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p className="text-gray-400 text-xs mb-3">Markiere ein Wort für die Übersetzung</p>
        <p
          className="text-gray-800 leading-relaxed whitespace-pre-wrap text-lg"
          onMouseUp={handleTextSelection}
          onTouchEnd={handleTextSelection}
        >
          {text.text}
        </p>
      </div>

      {/* Translation Tool */}
      <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 className="font-semibold text-gray-900 mb-4">🔤 Wort übersetzen</h2>
        <form onSubmit={handleTranslate} className="space-y-3">
          <div className="flex gap-3">
            <input
              type="text"
              placeholder="Wort oder Phrase eingeben..."
              value={wordToTranslate}
              onChange={(e) => setWordToTranslate(e.target.value)}
              className="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />
            <select
              value={targetLang}
              onChange={(e) => setTargetLang(e.target.value)}
              className="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              <option value="DE">Deutsch</option>
              <option value="EN">Englisch</option>
              <option value="FR">Französisch</option>
              <option value="ES">Spanisch</option>
              <option value="IT">Italienisch</option>
              <option value="PT">Portugiesisch</option>
              <option value="NL">Niederländisch</option>
              <option value="PL">Polnisch</option>
            </select>
            <button
              type="submit"
              disabled={translating}
              className="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50"
            >
              {translating ? '...' : 'Übersetzen'}
            </button>
          </div>
          {translation && (
            <div className="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
              <p className="text-sm text-gray-500 mb-1">Übersetzung:</p>
              <p className="text-xl font-semibold text-indigo-700">{translation}</p>
            </div>
          )}
        </form>
      </div>
    </div>
  );
}
