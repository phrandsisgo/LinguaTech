import React from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';

export default function Welcome() {
  const { isAuthenticated } = useAuth();

  return (
    <>
      <div className="container col-xxl-8 px-4" style={{ paddingBottom: '1rem' }}>
        <div className="row align-items-center g-5 py-5">
          <div className="col-lg-12 text-center">
            <h1 className="display-6 fw-bold lh-1 mb-3 font-color-main">
              {__('welcomepage.new_flashcards_title')}
            </h1>
            <p className="lead font-color-main">{__('welcomepage.new_flashcards_text')}</p>
            <div className="d-grid gap-2 d-md-flex justify-content-md-center">
              {isAuthenticated ? (
                <Link to="/home">
                  <button type="button" className="btn btn-primary btn-lg px-4 me-md-2 approveButton">{__('welcomepage.start_learning_button')}</button>
                </Link>
              ) : (
                <Link to="/register">
                  <button type="button" className="btn btn-primary btn-lg px-4 me-md-2 approveButton">{__('welcomepage.start_creating_button')}</button>
                </Link>
              )}
            </div>
          </div>
        </div>
      </div>

      <div className="container my-5">
        <h2 className="text-center font-color-main mb-4">{__('welcomepage.feature_title')}</h2>
        <div className="row">
          <div className="col-md-4 text-center">
            <div className="p-4 border rounded shadow-sm">
              <img src="/Images/flashcard-icon.png" alt={__('welcomepage.flashcards')} className="mb-3" style={{ width: 80 }} />
              <h3 className="font-color-main">{__('welcomepage.feature1_title')}</h3>
              <p className="font-color-main">{__('welcomepage.feature1_text')}</p>
            </div>
          </div>
          <div className="col-md-4 text-center">
            <div className="p-4 border rounded shadow-sm">
              <img src="/Images/tracking-icon.png" alt={__('welcomepage.tracking')} className="mb-3" style={{ width: 80 }} />
              <h3 className="font-color-main">{__('welcomepage.feature2_title')}</h3>
              <p className="font-color-main">{__('welcomepage.feature2_text')}</p>
            </div>
          </div>
          <div className="col-md-4 text-center">
            <div className="p-4 border rounded shadow-sm">
              <img src="/Images/generate-icon.png" alt={__('welcomepage.generate')} className="mb-3" style={{ width: 80 }} />
              <h3 className="font-color-main">{__('welcomepage.feature3_title')}</h3>
              <p className="font-color-main">{__('welcomepage.feature3_text')}</p>
            </div>
          </div>
        </div>
      </div>

      <div className="container my-5">
        <h1 className="text-center font-color-main">{__('stripe.pricing_title')}</h1>
        <div className="row justify-content-center mt-5">
          <div className="col-md-5">
            <div className="card mb-5 shadow-sm">
              <div className="card-header text-center"><h4>{__('stripe.plan_free')}</h4></div>
              <div className="card-body">
                <h1 className="card-title pricing-card-title">0€ <small>/ {__('stripe.per_month')}</small></h1>
                <ul className="list-unstyled mt-3 mb-4">
                  <li>{__('welcomepage.unlimited_stories')}</li>
                  <li>{__('welcomepage.unlimited_decks')}</li>
                  <li>{__('welcomepage.translate_words')}</li>
                  <li>{__('welcomepage.no_text_generations')}</li>
                </ul>
                <Link to="/register" className="btn btn-lg btn-block btn-outline-primary">{__('stripe.sign_up')}</Link>
              </div>
            </div>
          </div>
          <div className="col-md-5">
            <div className="card mb-5 shadow-sm">
              <div className="card-header text-center"><h4>{__('stripe.plan_premium')}</h4></div>
              <div className="card-body">
                <h1 className="card-title pricing-card-title">3€ <small>/ {__('stripe.per_month')}</small></h1>
                <ul className="list-unstyled mt-3 mb-4">
                  <li>{__('welcomepage.unlimited_stories')}</li>
                  <li>{__('welcomepage.unlimited_decks')}</li>
                  <li>{__('welcomepage.translate_words')}</li>
                  <li>{__('welcomepage.generate_texts')}</li>
                  <li>{__('welcomepage.future_audiobook_generation')}</li>
                </ul>
                <Link to="/register" className="approveButton" style={{ textDecoration: 'none' }}>{__('stripe.sign_up')}</Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
