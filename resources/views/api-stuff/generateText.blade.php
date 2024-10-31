@extends('layouts.lingua_main')
@section('title', 'GenerateText')
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

<p class="pagetitle">{{ __('api_texts.generateNewText') }}</p>

<form action="/createNewText" method="POST">
    @csrf
    <br>

        <div class="form-group">
            <label for="explanation" id="explanation-label" style="display: none;">{{ __('api_texts.explanation') }}</label>
            <p class="section-content">Hier können Sie beschreiben was Sie genau in Ihrem Text haben wollen und was alles im Text vorkommen sollte.
                
            </p>
            <button type="button" class="btn btn-info" onclick="toggleExplanation()">Show Explanation</button>
        </div>
    <div class="form-group">
        <label for="text">{{ __('api_texts.textDescription') }}</label>

        <textarea class="form-control" id="text" name="add-text-field" rows="3" required></textarea>
    <div class="form-group">
        <label for="description">{{ __('api_texts.text-title') }}</label>
        <input type="description" class="form-control" id="add-title-field" name="title" required>
    </div>
    <div class="form-group">
        <label for="text">{{ __('api_texts.text') }}</label>
        <textarea class="form-control" id="text" name="add-text-field" rows="3" required></textarea>
    </div>
    <div class="form-group"><label for="language" class="section-content">{{ __('api_texts.add-language') }}</label>
        <br>
        <select id="lang" name="lang[]" class="standartSelect">

            @for ($i = 0; $i < 5; $i++)
                <option value="language{{ $i }}">Language {{ $i + 1 }}</option>
            @endfor
        </select>
        <br><br>
    

    <div class="submit-wrapper-addText ">
        <button type="submit" class="approveButton">Submit</button>
    </div>
    
</form>
<script>
function toggleExplanation() {
    var label = document.getElementById('explanation-label');
    var textarea = document.getElementById('explanation');
    var button = event.target;

    if (label.style.display === 'none') {
        label.style.display = 'block';
        textarea.style.display = 'block';
        button.textContent = 'Hide Explanation';
    } else {
        label.style.display = 'none';
        textarea.style.display = 'none';
        button.textContent = 'Show Explanation';
    }
}
</script>
@endsection