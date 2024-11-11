@extends('layouts.lingua_main')
@section('title', 'home')
@section('head')
@vite(['resources/css/library.scss'])
@endsection
@section('content')

<div class="titleMargin">
    <div class="displayFlex">
        <p class="pagetitle">{{ __('Welcome back, ') }}{{ Auth::user()->name }}!</p>
        <div class="horizontal-fill"></div>
    </div>
</div>

<!-- Display Recent Decks -->
<div class="titleMargin">
    <div class="title-flex">
        <p class="pagetitle">{{ __('Your Recent Decks') }}</p>
        <div class="button-group">
            <a href="/library" class="noUnderline">
                <button class="standartButton">
                    {{ __('View All Decks') }}
                </button>
            </a>
            <a href="/list_create" class="noUnderline">
                <button class="standartButton">
                    {{ __('Create a new deck') }}
                </button>
            </a>
        </div>
    </div>

    @if ($decks->isEmpty())
        <p class="section-content">{{ __('You have not created any decks yet.') }}</p>
        <a href="/list_create" class="anker-no-underline">{{ __('Click here to create your first deck.') }}</a>
    @else
        @foreach ($decks as $deck)
            <div class="library-Card">
                <div class="displayFlex">
                    <a href="/list_show/{{ $deck->id }}" class="anker-no-underline displayFlex">
                        <p class="cardTitle">{{ $deck->name }}</p>
                    </a>
                    <div class="horizontal-fill"></div>
                    <a href="/swipeLearn/{{ $deck->id }}">
                        <img src="{{ asset('svg-icons/learnIcon.svg') }}" alt="Learn Icon" class="libraryIcon">
                    </a>
                    <a href="/list_update/{{ $deck->id }}">
                        <img src="{{ asset('svg-icons/pencil-icon.svg') }}" alt="Edit Icon" class="libraryIcon">
                    </a>
                    <form action="/list_delete_function/{{ $deck->id }}" method="POST" onsubmit="return confirmDeleteDeck()">
                        @csrf
                        <button type="submit" class="delete-hitbox">
                            <img src="{{ asset('svg-icons/trash-icon.svg') }}" alt="Delete Icon" class="libraryIcon">
                        </button>
                    </form>
                </div>
                <div>
                    <p class="begriffCount">{{ $deck->words()->count() }} {{ __('words') }}</p>
                </div>
                <div class="leading-library">
                    <p class="leadingText">{{ date('d.m.y', strtotime($deck->updated_at)) }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

<!-- Display Recent Texts -->
<div class="titleMargin">
    <div class="title-flex">
        <p class="pagetitle">{{ __('Your Recent Texts') }}</p>
        <div class="button-group">
            <a href="/displayAllTexts" class="noUnderline">
                <button class="standartButton">
                    {{ __('View All Texts') }}
                </button>
            </a>
            <a href="/addText" class="noUnderline">
                <button class="standartButton">
                    {{ __('Add a new text') }}
                </button>
            </a>
        </div>
    </div>

    @if ($texts->isEmpty())
        <p class="section-content">{{ __('You have not created any texts yet.') }}</p>
        <a href="/addText" class="anker-no-underline">{{ __('Click here to add your first text.') }}</a>
    @else
        @foreach ($texts as $text)
            <div class="library-Card">
                <div class="displayFlex">
                    <a href="/textShow/{{ $text->id }}" class="anker-no-underline displayFlex">
                        <p class="cardTitle">{{ $text->title }}</p>
                    </a>
                    <div class="horizontal-fill"></div>
                    <a href="/updateText/{{ $text->id }}">
                        <img src="{{ asset('svg-icons/pencil-icon.svg') }}" alt="Edit Icon" class="libraryIcon">
                    </a>
                    <form action="/deleteText" method="POST" onsubmit="return confirmDeleteText()">
                        @csrf
                        <input type="hidden" name="textId" value="{{ $text->id }}">
                        <button type="submit" class="delete-hitbox">
                            <img src="{{ asset('svg-icons/trash-icon.svg') }}" alt="Delete Icon" class="libraryIcon">
                        </button>
                    </form>
                </div>
                <div class="leading-library">
                    <p class="leadingText">{{ date('d.m.y', strtotime($text->updated_at)) }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
    function confirmDeleteDeck() {
        return confirm('{{ __('Are you sure you want to delete this deck?') }}');
    }
    function confirmDeleteText() {
        return confirm('{{ __('Are you sure you want to delete this text?') }}');
    }
</script>

@endsection