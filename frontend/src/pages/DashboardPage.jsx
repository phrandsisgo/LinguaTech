import { Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';

export default function DashboardPage() {
  const { user } = useAuth();

  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Dashboard</h1>
      <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p className="text-gray-700 mb-4">Willkommen, <strong>{user?.name}</strong>!</p>
        <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
          <Link to="/library" className="flex items-center gap-3 p-4 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors">
            <span className="text-2xl">📚</span>
            <span className="font-medium text-indigo-700">Library</span>
          </Link>
          <Link to="/texts" className="flex items-center gap-3 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
            <span className="text-2xl">📄</span>
            <span className="font-medium text-green-700">Texte</span>
          </Link>
          <Link to="/generate-text" className="flex items-center gap-3 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors">
            <span className="text-2xl">🤖</span>
            <span className="font-medium text-purple-700">KI Text</span>
          </Link>
          <Link to="/profile" className="flex items-center gap-3 p-4 bg-yellow-50 rounded-xl hover:bg-yellow-100 transition-colors">
            <span className="text-2xl">👤</span>
            <span className="font-medium text-yellow-700">Profil</span>
          </Link>
          <Link to="/patch-notes" className="flex items-center gap-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
            <span className="text-2xl">📝</span>
            <span className="font-medium text-gray-700">Patch Notes</span>
          </Link>
          <Link to="/stripe" className="flex items-center gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
            <span className="text-2xl">💳</span>
            <span className="font-medium text-blue-700">Abonnement</span>
          </Link>
        </div>
      </div>
    </div>
  );
}
