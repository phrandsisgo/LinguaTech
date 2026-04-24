import React, { useState } from 'react';
import '../styles/application.scss';
import '../styles/animations.scss';

export default function SwipePlay() {
  const [isFlipped, setIsFlipped] = useState(false);

  return (
    <>
      <div className="karteContent">
        <div className={`flip-card-inner ${isFlipped ? 'turnCard' : ''}`}>
          <div className="flashCardContent frontface">
            <div className="countZeile">
              <div className="repetitionCountBox"><p className="anzeigemargin">12</p></div>
              <div className="countAnzeige">12/23 Wörter</div>
              <div className="doneCountBox"><p className="anzeigemargin">11</p></div>
            </div>
            <div className="flipcardWordWrapper" onClick={() => setIsFlipped(!isFlipped)}>
              <p className="flipcardWord">word</p>
            </div>
            <div className="displayFlex cardBottom">
              <img src="/icons/denyIcon.svg" alt="deny" className="iconSpacer" />
              <div className="horizontal-fill"></div>
              <img src="/icons/confirmIcon.svg" alt="confirm" className="iconSpacer" />
            </div>
          </div>

          <div className="flashCardContent backface">
            <div className="countZeile">
              <div className="repetitionCountBox"><p className="anzeigemargin">12</p></div>
              <div className="countAnzeige">12/23 Wörter</div>
              <div className="doneCountBox"><p className="anzeigemargin">11</p></div>
            </div>
            <div className="flipcardWordWrapper" onClick={() => setIsFlipped(!isFlipped)}>
              <p className="flipcardWord">Wort</p>
            </div>
            <div className="displayFlex">
              <img src="/icons/denyIcon.svg" alt="deny" className="iconSpacer" />
              <div className="horizontal-fill"></div>
              <img src="/icons/confirmIcon.svg" alt="confirm" className="iconSpacer" />
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
