export default function AboutProjectPage() {
  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Über das Projekt</h1>
      <div className="bg-white rounded-xl p-8 shadow-sm border border-gray-100 space-y-6">
        <div>
          <h2 className="text-xl font-bold text-gray-900 mb-3">Was ist LinguaTech?</h2>
          <p className="text-gray-700">
            LinguaTech ist eine Sprachlern-Plattform, die modernste KI-Technologie mit bewährten
            Lernmethoden kombiniert. Lerne Sprachen mit Karteikarten, KI-generierten Texten und
            intelligenten Übersetzungstools.
          </p>
        </div>

        <div>
          <h2 className="text-xl font-bold text-gray-900 mb-3">Technologie</h2>
          <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
            {['Laravel', 'React', 'Vite', 'Tailwind CSS', 'OpenAI GPT', 'DeepL'].map((tech) => (
              <div key={tech} className="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium text-center">
                {tech}
              </div>
            ))}
          </div>
        </div>

        <div>
          <h2 className="text-xl font-bold text-gray-900 mb-3">Features</h2>
          <ul className="space-y-2 text-gray-700">
            <li className="flex items-center gap-2"><span className="text-indigo-500">•</span> Wortlisten mit SwipeLearn</li>
            <li className="flex items-center gap-2"><span className="text-indigo-500">•</span> KI-generierte Lerntexte (GPT-4)</li>
            <li className="flex items-center gap-2"><span className="text-indigo-500">•</span> DeepL Übersetzung</li>
            <li className="flex items-center gap-2"><span className="text-indigo-500">•</span> Mehrsprachig</li>
            <li className="flex items-center gap-2"><span className="text-indigo-500">•</span> Mobile-first Design (Capacitor)</li>
          </ul>
        </div>
      </div>
    </div>
  );
}
