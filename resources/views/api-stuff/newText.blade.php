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

<p class="pagetitle">Text hinzufügen</p>

<form action="/createNewText">
    <div class="form-group">
        <label for="title">TextTitel</label>
        <input type="text" class="form-control" id="add-title-field" name="title" required>
    </div>
    <div class="form-group">
        <label for="text">Text</label>
        <textarea class="form-control" id="text" name="add-text-field" rows="3" required></textarea>
    </div>
    <div class="submit-wrapper-addText ">
        <button type="submit" class="approveButton">Submit</button>
    </div>
    
</form>
@endsection