@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')
    <p class="sectiontitle">
        {{$patch->title}}

    </p>
    <div>

        {!! $patch->content !!}
    </div>
   
    <br>
    <div class="showComments">
        @foreach ($patch->comments as $comment)
            <div class="library-Card">
               <div class="displayFlex">
               <p>{{$comment->user ? $comment->user->name : 'deleted-user'}}</p>
               <div class="horizontal-fill"></div>
                <p>{{$comment->created_at}}</p>
               </div>
                <p class="section-content"  >{{$comment->comment}}</p>
            
            </div>
        @endforeach
    </div>
    <br>
    <form action="/releaseNotesComment/{{$patch->id}}" method="POST">
        @csrf
       <div class="patchCommentWrapper">
            <!-- <input type="hidden" name="patchId" value="{{$patch->id}}"> -->
            <label for="comment" class="section-content">Neuer Kommentar hinzufügen</label>
            <textarea name="comment" id="newComment" cols="30" rows="10"></textarea>
            <button type="submit" class="standartButton">submit</button>
       </div>
    </form>
 @endsection