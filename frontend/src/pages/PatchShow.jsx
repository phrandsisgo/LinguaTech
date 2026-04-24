import React from 'react';
import { useParams, Link } from 'react-router-dom';

const mockPatch = {
  id: 1, version: '0.3.0', title: 'New Features', content: 'Added swipe learning, text generation, and more!',
  comments: [
    { id: 1, user: 'Alice', content: 'Great update!', created_at: '2024-01-16' },
  ]
};

export default function PatchShow() {
  const { id } = useParams();
  const patch = mockPatch;

  return (
    <>
      <Link to="/patchList"><button className="standartButton">← All Patches</button></Link>
      <p className="pagetitle">{patch.version} - {patch.title}</p>
      <p className="section-content">{patch.content}</p>
      <br />
      <p className="sectiontitle">Comments</p>
      {patch.comments.map(comment => (
        <div className="library-Card" key={comment.id}>
          <p><strong>{comment.user}</strong> <span style={{ color: '#888' }}>{comment.created_at}</span></p>
          <p className="section-content">{comment.content}</p>
        </div>
      ))}
    </>
  );
}
