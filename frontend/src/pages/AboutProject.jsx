import React from 'react';
import { __ } from '../hooks/useTranslation';

export default function AboutProject() {
  return (
    <>
      <p className="pagetitle">{__('about_project.discoverLinguaTech')}</p>

      <p className="sectiontitle">{__('about_project.whatIsLinguaTech')}</p>
      <p className="section-content">{__('about_project.linguaTechDescription')}</p>
      <br />

      <p className="sectiontitle">{__('about_project.smartWayToLearn')}</p>
      <p className="section-content">{__('about_project.welcomeMessage')}</p>

      <p className="sectiontitle">{__('about_project.contextMatters')}</p>
      <p className="section-content">{__('about_project.contextDescription')}</p>

      <p className="sectiontitle">{__('about_project.yourCourseYourRules')}</p>
      <p className="section-content">{__('about_project.courseCustomization')}</p>

      <p className="sectiontitle">{__('about_project.readyToSpeak')}</p>
      <p className="section-content">{__('about_project.registerNow')}</p>

      <p className="sectiontitle">{__('about_project.contactMe')}</p>
      <p className="section-content">{__('about_project.moreAboutMe')} <a href="/about_me">{__('about_project.clickHere')}</a>.</p>
      <p className="section-content">{__('about_project.linkedIn')} <a href="https://www.linkedin.com/in/francisco-wohlgemuth/">LinkedIn</a>.</p>
      <p className="section-content">{__('about_project.github')} <a href="https://github.com/phrandsisgo/LinguaTech">GitHub</a>.</p>
    </>
  );
}
