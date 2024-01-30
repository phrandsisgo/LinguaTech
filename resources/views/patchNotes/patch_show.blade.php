@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')
   <div class="displayFlex">
   <p class="pagetitle">Release notes Version {{$patch->version}}</p>
    <a href="/patchList">
        <button class="standartButton"style="margin-left:14px;">ältere Patches</button>
    </a>
   </div>

    <p class="sectiontitle">
        {{$patch->title}}

    </p>
    <div>

        {!! $patch->content !!}
    </div>
    <br>
    <br>
    <br>
   <p class="sectiontitle">Kommentarsektion:</p>
    <br>
    <div class="showComments">
        @foreach ($patch->comments as $comment)
            <div class="library-Card">
               <div class="displayFlex">
                    <p>{{$comment->user ? $comment->user->name : 'deleted-user'}}</p>
                    <div class="horizontal-fill"></div>
                    <p>{{$comment->created_at}}</p>
                    @if ($comment->user_id == auth()->user()->id)
                    <form action="/releaseNotesCommentDelete/{{$comment->id}}" method="POST" onsubmit="//return confirmDelete()">
                        @csrf
                        <button type="submit" class="delete-hitbox">
                    
                            <img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon">
                    
                        </button>
                    </form>
                    @endif
               </div>
                <p class="section-content"  >{{$comment->comment}}</p>
            
            </div>
        @endforeach
    </div>
    <br>
    @if (auth()->check())
        
    <form action="/releaseNotesComment/{{$patch->id}}" method="POST">
        @csrf
       <div class="patchCommentWrapper">
            <!-- <input type="hidden" name="patchId" value="{{$patch->id}}"> -->
            <label for="comment" class="section-content">Neuer Kommentar hinzufügen</label>
            <textarea name="comment" id="newComment" cols="30" rows="10"></textarea>
            <button type="submit" class="standartButton" style="margin:0px; margin-top:9px;">submit</button>
       </div>
    </form>
    @endif
 @endsection