import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { apiGetPatchNotes } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';

export default function PatchListPage() {
  const [patches, setPatches] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiGetPatchNotes()
      .then(({ data }) => setPatches(data))
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <LoadingSpinner />;

  return (
    <div className="space-y-6">
      <h1 className="text-3xl font-bold text-gray-900">Patch Notes</h1>
      {patches.length === 0 ? (
        <div className="bg-white rounded-xl p-12 text-center text-gray-400">
          Keine Patch Notes vorhanden.
        </div>
      ) : (
        <div className="grid gap-4">
          {patches.map((patch) => (
            <Link
              key={patch.id}
              to={`/patch-notes/${patch.id}`}
              className="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:border-indigo-200 transition-colors block"
            >
              <div className="flex items-center justify-between">
                <div>
                  <h3 className="font-semibold text-gray-900 text-lg">{patch.title || `Version ${patch.version}`}</h3>
                  <p className="text-sm text-gray-400 mt-1">
                    {new Date(patch.updated_at).toLocaleDateString('de-CH')}
                  </p>
                </div>
                <span className="text-indigo-400">→</span>
              </div>
            </Link>
          ))}
        </div>
      )}
    </div>
  );
}
