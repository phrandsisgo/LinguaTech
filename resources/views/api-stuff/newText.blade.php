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
</style>
@endsection
@section('content')

<p class="pagetitle">{{ __('api_texts.addNewText') }}</p>

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
        <button type="submit" class="approveButton">Submit</button>
    </div>
    
</form>
@endsection