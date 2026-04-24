import React from 'react';
import { Link } from 'react-router-dom';

const mockPatches = [
  { id: 1, version: '0.3.0', title: 'New Features', created_at: '2024-01-15' },
  { id: 2, version: '0.2.0', title: 'Bug Fixes', created_at: '2024-01-01' },
];

export default function PatchList() {
  return (
    <>
      <p className="pagetitle">Patch Notes</p>
      {mockPatches.map(patch => (
        <div className="library-Card" key={patch.id}>
          <Link to={`/patch_show/${patch.id}`} className="anker-no-underline">
            <div className="displayFlex">
              <p className="cardTitle">{patch.version} - {patch.title}</p>
              <div className="horizontal-fill"></div>
              <p className="leadingText">{patch.created_at}</p>
            </div>
          </Link>
        </div>
      ))}
    </>
  );
}
