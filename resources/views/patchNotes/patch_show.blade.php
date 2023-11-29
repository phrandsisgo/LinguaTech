@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('content')
    <p>show the patch</p>
    <p>
        {{$patch->title}}

    </p>
    <p>
        {{$patch->content}}
    </p>
    <br>
    <div class="showComments">
        @foreach ($patch->comments as $comment)
            <div class="comment">
                <p>{{$comment->comment}}</p>
                <p>{{$comment->user ? $comment->user->name : 'deleted-user'}}</p>
            
            </div>
        @endforeach
    </div>
    <br>
    <p>KommentarSektion</p>
    <form action="/releaseNotesComment/{{$patch->id}}" method="POST">
        @csrf
        <!-- <input type="hidden" name="patchId" value="{{$patch->id}}"> -->
        <label for="comment">neuer Kommentar hinzufügen</label>
        <textarea name="comment" id="newComment" cols="30" rows="10"></textarea>
        <button type="submit">submit</button>
    </form>
 @endsection