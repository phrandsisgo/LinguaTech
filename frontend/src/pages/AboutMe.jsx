import React from 'react';
import { Link } from 'react-router-dom';
import { __ } from '../hooks/useTranslation';
import '../styles/library.scss';

export default function AboutMe() {
  return (
    <>
      <div className="hero">
        <div className="image-crop">
          <img src="/profilbild.jpg" alt="" id="profilBild" />
        </div>
        <div className="heroLeading">
          <p className="pagetitle">Francisco <br /> Wohlgemuth</p>
        </div>
      </div>
      <p className="section-content">{__('about_me.introduction')} <a href="https://github.com/phrandsisgo" target="_blank" rel="noreferrer">phrandsisgo</a>.</p>
      <p className="section-content"><Link to="/about_project">{__('about_me.project_link')}</Link></p>

      <br />
      <p className="sectiontitle"><b>{__('about_me.skills_title')}</b></p>

      <div className="displayFlex" style={{ flexWrap: 'wrap', justifyContent: 'center' }}>
        <div className="library-Card displayFlex media-Card">
          <div className="aboutCardsIcons">
            <img src="/svg-icons/codingLogo.svg" alt="Icon für coding" />
          </div>
          <div className="card-title-about">
            <p className="cardTitle">{__('about_me.techstack')}</p>
            <p>{__('about_me.techstack_details')}</p>
          </div>
        </div>
        <div className="library-Card displayFlex media-Card">
          <div className="aboutCardsIcons">
            <img src="/svg-icons/globeIcon.svg" alt="Icon für Sprachen" />
          </div>
          <div className="card-title-about">
            <p className="cardTitle">{__('about_me.nationality_languages')}</p>
            <p>{__('about_me.nationality_languages_details')}</p>
          </div>
        </div>
        <div className="library-Card displayFlex media-Card">
          <div className="aboutCardsIcons">
            <img src="/svg-icons/educationIcon.svg" alt="Icon für Ausbildung" />
          </div>
          <div className="card-title-about">
            <p className="cardTitle">{__('about_me.education')}</p>
            <p>{__('about_me.education_details')}</p>
          </div>
        </div>
        <div className="library-Card displayFlex media-Card">
          <div className="aboutCardsIcons">
            <img src="/svg-icons/brushIcon.svg" alt="Icon für Hobbys" />
          </div>
          <div className="card-title-about">
            <p className="cardTitle">{__('about_me.hobbies')}</p>
            <p>{__('about_me.hobbies_details')}</p>
          </div>
        </div>
      </div>
    </>
  );
}
