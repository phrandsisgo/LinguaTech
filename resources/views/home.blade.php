@extends('layouts.lingua_main')
@section('title', 'home')
@section('head')
@vite(['resources/css/library.scss'])
@endsection
@section('content')

<div class="titleMargin">
    <div class="displayFlex">
        <p class="pagetitle">{{ __('home.welcome_back', ['name' => Auth::user()->name]) }}</p>
        <div class="horizontal-fill"></div>
    </div>
</div>

<!-- Display Recent Decks -->
<div class="titleMargin">
    <div class="title-flex">
        <p class="pagetitle">{{ __('home.your_recent_decks') }}</p>
        <div class="button-group">
            <a href="/library" class="noUnderline">
                <button class="standartButton">
                    {{ __('home.view_all_decks') }}
                </button>
            </a>
            <a href="/list_create" class="noUnderline">
                <button class="standartButton">
                    {{ __('home.create_new_deck') }}
                </button>
            </a>
        </div>
    </div>

    @if ($decks->isEmpty())
        <p class="section-content">{{ __('home.no_decks_yet') }}</p>
        <a href="/list_create" class="anker-no-underline">{{ __('home.click_here_to_create_first_deck') }}</a>
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
                    <p class="begriffCount">{{ $deck->words()->count() }} {{ __('home.words') }}</p>
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
        <p class="pagetitle">{{ __('home.your_recent_texts') }}</p>
        <div class="button-group">
            <a href="/displayAllTexts" class="noUnderline">
                <button class="standartButton">
                    {{ __('home.view_all_texts') }}
                </button>
            </a>
            <a href="/addText" class="noUnderline">
                <button class="standartButton">
                    {{ __('home.add_new_text') }}
                </button>
            </a>
        </div>
    </div>

    @if ($texts->isEmpty())
        <p class="section-content">{{ __('home.no_texts_yet') }}</p>
        <a href="/addText" class="anker-no-underline">{{ __('home.click_here_to_add_first_text') }}</a>
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
        return confirm('{{ __('home.confirm_delete_deck') }}');
    }
    function confirmDeleteText() {
        return confirm('{{ __('home.confirm_delete_text') }}');
    }
</script>

@endsection