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
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Create New Podcast Episode</h3>
        </div>
        <div class="card-body">
            <form id="podcastForm" action="{{ route('podcast.generate') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="wordPairs" class="form-label">Word Pairs (JSON format)</label>
                    <textarea id="wordPairs" name="wordInput" class="form-control" placeholder='[{"Base": "Hello", "Ziel": "Hallo"}, {"Base": "Goodbye", "Ziel": "Auf Wiedersehen"}]' required></textarea>
                    <small class="text-muted">Enter word pairs in JSON format</small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="baseLanguage" class="form-label">Base Language</label>
                        <select id="baseLanguage" name="base_language_main" class="form-select" required>
                            <option value="">Select Language</option>
                            <option value="EN">English</option>
                            <option value="DE">German</option>
                            <option value="ES">Spanish</option>
                            <option value="FR">French</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="targetLanguage" class="form-label">Target Language</label>
                        <select id="targetLanguage" name="target_language_main" class="form-select" required>
                            <option value="">Select Language</option>
                            <option value="DE">German</option>
                            <option value="EN">English</option>
                            <option value="ES">Spanish</option>
                            <option value="FR">French</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Language Level</label>
                    <select id="level" name="level_main" class="form-select" required>
                        <option value="">Select Level</option>
                        <option value="A1">A1 - Beginner</option>
                        <option value="A2">A2 - Elementary</option>
                        <option value="B1">B1 - Intermediate</option>
                        <option value="B2">B2 - Upper Intermediate</option>
                        <option value="C1">C1 - Advanced</option>
                        <option value="C2">C2 - Proficient</option>
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Generate Podcast Episode</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection