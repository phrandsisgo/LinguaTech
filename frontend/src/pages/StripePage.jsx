export default function StripePage() {
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Premium Abonnement</h1>
      <div className="bg-white rounded-xl p-8 shadow-sm border border-gray-100 text-center">
        <div className="text-6xl mb-4">⭐</div>
        <h2 className="text-2xl font-bold text-gray-900 mb-3">LinguaTech Premium</h2>
        <p className="text-gray-600 mb-6 max-w-md mx-auto">
          Mit Premium hast du unbegrenzten Zugang zu KI-generierten Texten und allen weiteren Features.
        </p>
        <div className="bg-indigo-50 rounded-xl p-6 mb-6 inline-block">
          <div className="text-4xl font-bold text-indigo-600">CHF 4.99</div>
          <div className="text-gray-500">/ Monat</div>
        </div>
        <ul className="text-left text-gray-700 space-y-2 mb-8 max-w-sm mx-auto">
          <li className="flex items-center gap-2"><span className="text-green-500">✓</span> Unbegrenzte KI-Text Generierung</li>
          <li className="flex items-center gap-2"><span className="text-green-500">✓</span> Alle Sprachen verfügbar</li>
          <li className="flex items-center gap-2"><span className="text-green-500">✓</span> Unbegrenzte Wortlisten</li>
          <li className="flex items-center gap-2"><span className="text-green-500">✓</span> Priorisierter Support</li>
        </ul>
        <a
          href="/checkout"
          className="bg-indigo-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-indigo-700 transition-colors text-lg inline-block"
        >
          Jetzt abonnieren
        </a>
      </div>
    </div>
  );
}
