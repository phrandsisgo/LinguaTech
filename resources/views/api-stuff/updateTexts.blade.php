@extends('layouts.lingua_main')
@section('title', 'update-text')
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
</style>
@endsection
@section('content')


<div class="text-learn-wrapper">
    <p class="pagetitle">Den Text mit dem Titel "{{ $text->title }}" bearbeiten.</p>

    <form action="/updateTextFunction/{{ $text->id }}" method="post" class="text-form">
        @csrf
        <input type="hidden" name="id" value="{{ $text->id }}">
        <div class="form-group">
            <label for="title">Titel</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $text->title }}" required>
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control" id="text" name="text" rows="3" required>{{ $text->text }}</textarea>
        </div>
        <div class="form-group">
            <label for="language">Sprache</label>
            <select id="lang" name="lang" class="standartSelect">
                @foreach ($languages as $language)
                    <option value="{{ $language->id }}" @if ($language->id == $text->language_id) selected @endif>{{ $language->language_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="submit-wrapper-addText">
            <button type="submit" class="approveButton">Speichern</button>
        </div>
    </form>
</div>
@endsection