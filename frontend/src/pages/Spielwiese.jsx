import React, { useState } from 'react';

export default function Spielwiese() {
  const [counter, setCounter] = useState(0);

  return (
    <>
      <p className="pagetitle">Spielwiese (Dev Playground)</p>
      <p className="section-content">This is a development playground for testing components.</p>
      <div className="library-Card">
        <p className="sectiontitle">Counter Demo</p>
        <p className="section-content">Count: {counter}</p>
        <button className="standartButton" onClick={() => setCounter(c => c + 1)}>Increment</button>
        <button className="standartButton" onClick={() => setCounter(0)}>Reset</button>
      </div>
    </>
  );
}
