@extends('layouts.lingua_main')
@section('title', 'addText')
@section('head')


<style> 
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
.subscription-banner {
    background-color: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    text-align: center;
}
.subscription-banner a {
    color: #856404;
    font-weight: bold;
    text-decoration: underline;
}
</style>
@endsection
@section('content')

<p class="pagetitle">{{ __('api_texts.addNewText') }}</p>

    @php
        $subscribedUntil = auth()->user()->subscribed_until;
        $hasActiveSubscription = $subscribedUntil && \Carbon\Carbon::parse($subscribedUntil)->isAfter(now());
    @endphp

    @if($hasActiveSubscription)
        <a href="/generate-text">
            <button class="approveButton">{{ __('api_texts.generateNewText') }}</button>
        </a>
    @else
        <div class="subscription-banner">
            <p>{{ __('api_texts.upgrade_to_generate') }}</p>
            <a href="/checkout">{{ __('api_texts.upgrade_now') }}</a>
        </div>
    @endif
<form action="/createNewText" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">{{ __('api_texts.text-title') }}</label>
        <input type="text" class="form-control" id="add-title-field" name="title" required>
    </div>

    <div class="form-group">
        <label for="text">{{ __('api_texts.text') }}</label>
        <textarea class="form-control" id="text" name="add-text-field" rows="3" required></textarea>
    </div>
    <div class="form-group"><label for="language" class="section-content">{{ __('api_texts.add-language') }}</label>
        <br>
        <select id="lang" name="lang[]" class="standartSelect">
            @foreach ($languages as $language)
                <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                
            @endforeach
        </select>
        <br><br>
    

    <div class="submit-wrapper-addText ">
        <button type="submit" class="approveButton">{{ __('api_texts.submit') }}</button>
    </div>
    
</form>
@endsection
