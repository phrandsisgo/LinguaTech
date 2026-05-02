import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiGetHome } from '../api';
import LoadingSpinner from '../components/LoadingSpinner';

export default function HomePage() {
  const [data, setData] = useState({ decks: [], texts: [] });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiGetHome()
      .then((res) => setData(res.data))
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-8">
      <div>
        <h1 className="text-3xl font-bold text-gray-900 mb-1">Willkommen zurück! 👋</h1>
        <p className="text-gray-500">Hier ist dein aktueller Lernstand.</p>
      </div>

      {/* Quick Actions */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        <Link to="/library" className="bg-indigo-600 text-white rounded-xl p-4 text-center hover:bg-indigo-700 transition-colors">
          <div className="text-2xl mb-1">📚</div>
          <div className="text-sm font-medium">Library</div>
        </Link>
        <Link to="/texts" className="bg-green-600 text-white rounded-xl p-4 text-center hover:bg-green-700 transition-colors">
          <div className="text-2xl mb-1">📄</div>
          <div className="text-sm font-medium">Texte</div>
        </Link>
        <Link to="/generate-text" className="bg-purple-600 text-white rounded-xl p-4 text-center hover:bg-purple-700 transition-colors">
          <div className="text-2xl mb-1">🤖</div>
          <div className="text-sm font-medium">KI generieren</div>
        </Link>
        <Link to="/list-create" className="bg-orange-500 text-white rounded-xl p-4 text-center hover:bg-orange-600 transition-colors">
          <div className="text-2xl mb-1">➕</div>
          <div className="text-sm font-medium">Neues Deck</div>
        </Link>
      </div>

      {/* Recent Decks */}
      <div>
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-xl font-semibold text-gray-900">Letzte Decks</h2>
          <Link to="/library" className="text-sm text-indigo-600 hover:underline">Alle anzeigen →</Link>
        </div>
        {data.decks.length === 0 ? (
          <div className="bg-white rounded-xl p-6 text-center text-gray-400">
            <p>Noch keine Decks erstellt.</p>
            <Link to="/list-create" className="mt-2 inline-block text-indigo-600 hover:underline text-sm">
              Erstes Deck erstellen
            </Link>
          </div>
        ) : (
          <div className="grid md:grid-cols-3 gap-4">
            {data.decks.map((deck) => (
              <div key={deck.id} className="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <h3 className="font-semibold text-gray-900 mb-1">{deck.name}</h3>
                <p className="text-sm text-gray-500 mb-3 line-clamp-2">{deck.description || 'Keine Beschreibung'}</p>
                <div className="flex gap-2">
                  <Link
                    to={`/list-show/${deck.id}`}
                    className="text-xs bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full hover:bg-indigo-100"
                  >
                    Anzeigen
                  </Link>
                  <Link
                    to={`/swipe-learn/${deck.id}`}
                    className="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full hover:bg-green-100"
                  >
                    Lernen
                  </Link>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>

      {/* Recent Texts */}
      <div>
        <div className="flex items-center justify-between mb-4">
          <h2 className="text-xl font-semibold text-gray-900">Letzte Texte</h2>
          <Link to="/texts" className="text-sm text-indigo-600 hover:underline">Alle anzeigen →</Link>
        </div>
        {data.texts.length === 0 ? (
          <div className="bg-white rounded-xl p-6 text-center text-gray-400">
            <p>Noch keine Texte vorhanden.</p>
            <Link to="/add-text" className="mt-2 inline-block text-indigo-600 hover:underline text-sm">
              Ersten Text hinzufügen
            </Link>
          </div>
        ) : (
          <div className="grid md:grid-cols-3 gap-4">
            {data.texts.map((text) => (
              <div key={text.id} className="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <h3 className="font-semibold text-gray-900 mb-1">{text.title}</h3>
                <p className="text-sm text-gray-500 mb-3 line-clamp-2">{text.text}</p>
                <Link
                  to={`/text/${text.id}`}
                  className="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full hover:bg-green-100"
                >
                  Lesen
                </Link>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
