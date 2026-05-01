export default function AboutMePage() {
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Über den Entwickler</h1>
      <div className="bg-white rounded-xl p-8 shadow-sm border border-gray-100">
        <div className="flex items-center gap-6 mb-6">
          <div className="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center text-4xl">
            👨‍💻
          </div>
          <div>
            <h2 className="text-2xl font-bold text-gray-900">Francesco</h2>
            <p className="text-gray-500">Entwickler & Gründer von LinguaTech</p>
          </div>
        </div>
        <div className="prose text-gray-700 space-y-4">
          <p>
            LinguaTech ist ein Projekt, das aus der Leidenschaft für Sprachen und Technologie entstanden ist.
            Als Sprachlernender selbst kenne ich die Herausforderungen, Vokabeln zu memorisieren und
            authentische Texte zu finden.
          </p>
          <p>
            Mit LinguaTech möchte ich dir helfen, Sprachen effektiver und mit mehr Spass zu lernen –
            durch intelligente Karteikarten, KI-generierte Texte und DeepL-Übersetzungen.
          </p>
        </div>
      </div>
    </div>
  );
}
