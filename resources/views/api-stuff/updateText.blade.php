@extends('layouts.lingua_main')

@section('title', 'addText')
@section('head')

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Update Text</h1>
                <form action="{{ route('api-stuff.updateText') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $text->title }}">
                    </div>
                    <div class="form-group
                    ">
                        <label for="text">Text</label>
                        <textarea class="form-control" id="text" name="text" rows="3">{{ $text->text }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    §
                </form>
            </div>
        </div>
    </div>
    
@endsection