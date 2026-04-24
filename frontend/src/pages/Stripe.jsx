import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';
import { __ } from '../hooks/useTranslation';

export default function Stripe() {
  const { isAuthenticated } = useAuth();
  const navigate = useNavigate();

  const handleSubscribe = () => {
    // Mock Stripe checkout
    alert('Redirecting to Stripe checkout...');
    navigate('/success');
  };

  return (
    <div className="container my-5">
      <h1 className="text-center font-color-main">{__('stripe.pricing_title')}</h1>
      <p className="text-center lead font-color-main">{__('stripe.pricing_subtitle')}</p>

      <div className="row justify-content-center mt-5">
        <div className="col-md-5">
          <div className="card mb-5 shadow-sm">
            <div className="card-header text-center">
              <h4 className="my-0 font-weight-normal">{__('stripe.plan_free')}</h4>
            </div>
            <div className="card-body">
              <h1 className="card-title pricing-card-title">0€ <small className="text-muted">/ {__('stripe.per_month')}</small></h1>
              <ul className="list-unstyled mt-3 mb-4">
                <li>{__('welcomepage.unlimited_stories')}</li>
                <li>{__('welcomepage.unlimited_decks')}</li>
                <li>{__('welcomepage.translate_words')}</li>
                <li>{__('welcomepage.no_text_generations')}</li>
                <li>{__('welcomepage.no_audiobooks')}</li>
              </ul>
              {!isAuthenticated ? (
                <Link to="/register" className="btn btn-lg btn-block btn-outline-primary">{__('stripe.sign_up')}</Link>
              ) : (
                <Link to="/library" className="standartButton" style={{ textDecoration: 'none' }}>{__('stripe.go_to_library')}</Link>
              )}
            </div>
          </div>
        </div>
        <div className="col-md-5">
          <div className="card mb-5 shadow-sm">
            <div className="card-header text-center">
              <h4 className="my-0 font-weight-normal">{__('stripe.plan_premium')}</h4>
            </div>
            <div className="card-body">
              <h1 className="card-title pricing-card-title">3€ <small className="text-muted">/ {__('stripe.per_month')}</small></h1>
              <ul className="list-unstyled mt-3 mb-4">
                <li>{__('welcomepage.unlimited_stories')}</li>
                <li>{__('welcomepage.unlimited_decks')}</li>
                <li>{__('welcomepage.translate_words')}</li>
                <li>{__('welcomepage.generate_texts')}</li>
                <li>{__('welcomepage.future_audiobook_generation')}</li>
              </ul>
              {!isAuthenticated ? (
                <Link to="/register" className="approveButton" style={{ textDecoration: 'none' }}>{__('stripe.sign_up')}</Link>
              ) : (
                <button onClick={handleSubscribe} className="approveButton">{__('stripe.subscribe_now')}</button>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
