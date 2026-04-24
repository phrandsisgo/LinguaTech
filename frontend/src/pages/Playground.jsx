import React from 'react';

export default function Playground() {
  return (
    <>
      <p className="pagetitle">Playground</p>
      <div className="flip-card">
        <div className="flip-card-inner">
          <div className="flip-card-front">
            <h1>Front</h1>
          </div>
          <div className="flip-card-back">
            <h1>Back</h1>
          </div>
        </div>
      </div>
    </>
  );
}
