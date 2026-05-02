import { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { apiGetPatchNote } from '../../api';
import LoadingSpinner from '../../components/LoadingSpinner';

export default function PatchShowPage() {
  const { id } = useParams();
  const [patch, setPatch] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiGetPatchNote(id)
      .then(({ data }) => setPatch(data))
      .catch(() => {})
      .finally(() => setLoading(false));
  }, [id]);

  if (loading) return <LoadingSpinner />;
  if (!patch) return <div className="text-center text-gray-500 py-12">Patch Note nicht gefunden.</div>;

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-3xl font-bold text-gray-900">{patch.title || `Version ${patch.version}`}</h1>
        <Link to="/patch-notes" className="text-gray-600 hover:text-indigo-600">← Zurück</Link>
      </div>

      <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <p className="text-sm text-gray-400 mb-4">
          {new Date(patch.updated_at).toLocaleDateString('de-CH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
          })}
        </p>
        <div className="prose text-gray-700 whitespace-pre-wrap">
          {patch.content || patch.description || patch.body || 'Kein Inhalt verfügbar.'}
        </div>
      </div>

      {patch.comments && patch.comments.length > 0 && (
        <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
          <h2 className="font-semibold text-gray-900 text-lg mb-4">Kommentare ({patch.comments.length})</h2>
          <div className="space-y-3">
            {patch.comments.map((comment) => (
              <div key={comment.id} className="bg-gray-50 rounded-lg p-4">
                <p className="text-gray-700">{comment.comment}</p>
                <p className="text-xs text-gray-400 mt-2">
                  {new Date(comment.created_at).toLocaleDateString('de-CH')}
                </p>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
