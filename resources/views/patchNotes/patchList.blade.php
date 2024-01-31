@extends('layouts.lingua_main')
@section('title', 'All patches')
@section('head')


@endsection

@section('content')

@foreach ($patches as $patch)
    <div class="library-Card">
        <p class="section-content"> Version {{$patch->version}}:</p>
        <a href="/patchShow/{{$patch->id}}">
            <p class="sectiontitle">{{$patch->title}}</p>
        </a>
    </div>
@endforeach
@endsection