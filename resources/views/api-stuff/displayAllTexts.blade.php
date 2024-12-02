@extends('layouts.lingua_main')
@section('title', 'Text Show')
@section('head')

@vite(['resources/css/library.scss'])

@endsection
@section('content')
<div class="titleMargin">
    <div class="toggle-wrapper">
        <input type="checkbox" id="toggleButton" class="toggle-checkbox">
        <label for="toggleButton" class="toggle-label">
            <span class="toggle-inner"></span>
            <span class="toggle-on">{{__('library.own') }}</span>
            <span class="toggle-off">{{__('library.public') }}</span>
        </label>
    </div>

    <p class="pagetitle">{{ __('api_texts.allAvailableTexts') }}</p>
    <a href="/addText" class="section-content">{{ __('api_texts.addNewText') }}</a>

    <div class="textSortierer">
        <!-- Own texts section -->
        <div id="privateTexts">
            <div class="text-container">
                @foreach($allTexts->sortByDesc('updated_at') as $text)
                    @if ($text->created_by == Auth::user()->id) 
                        <a href="/textShow/{{$text->id}}">
                            <div class="Texts-Card">
                                <p class="cardTitle">{{ $text->title }}</p>
                                <div class="displayFlex">
                                    <p>{{$text->langOption->language_name}}</p>
                                    <div class="horizontal-fill"></div>
                                    <p>{{ $text->updated_at->format('d-m-Y') }}</p>
                                </div>
                                <br>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Public texts section -->
        <div id="publicTexts" style="display: none;">
            <!-- All existing language sections (DE, FR, RU, etc.) go here -->
            <div class="language-spez-text">
                <button class="language-button " data-target="DE" onclick="changeArrowDirection('DE')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                    </svg>
                    <p>{{ __('api_texts.german') }}</p>
                </button>
                <div id="DE" style="display: none;" class="text-container">
                    @foreach($allTexts as $text)
                        @if ($text->langOption->language_code == 'DE' && $text->created_by == 1) 
                            <a href="/textShow/{{$text->id}}">
                                <div class="Texts-Card">
                                    <p>{{ $text->title }}</p>
                                    <p>{{$text->langOption->language_name}}</p>
                                    <br>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="language-spez-text">
                <button class="language-button " data-target="FR" onclick="changeArrowDirection('FR')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                    </svg>
                    <p>{{ __('api_texts.french') }}</p>
                </button>
                <div id="FR" style="display: none;" class="text-container">
                    @foreach($allTexts as $text)
                        @if ($text->langOption->language_code == 'FR') 
                            <a href="/textShow/{{$text->id}}">
                                <div class="Texts-Card">
                                    <p>{{ $text->title }}</p>
                                    <p>{{$text->langOption->language_name}}</p>
                                    <br>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="language-spez-text">
                <button class="language-button" data-target="RU" onclick="changeArrowDirection('RU')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                    </svg>
                    <p>{{ __('api_texts.russian') }}</p>
                </button>
                <div id="RU" style="display: none;" class="text-container">
                    @foreach($allTexts as $text)
                        @if ($text->langOption->language_code == 'RU' && $text->created_by == 1) 
                            <a href="/textShow/{{$text->id}}">
                                <div class="Texts-Card">
                                    <p>{{ $text->title }}</p>
                                    <p>{{$text->langOption->language_name}}</p>
                                    <br>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="language-spez-text">
                <button class="language-button" data-target="EN" onclick="changeArrowDirection('EN')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                    </svg>
                    <p>{{ __('api_texts.english') }}</p>
                </button>
                <div id="EN" style="display: none;" class="text-container">
                    @foreach($allTexts as $text)
                        @if ($text->langOption->language_code == 'EN' && $text->created_by == 1) 
                            <a href="/textShow/{{$text->id}}">
                                <div class="Texts-Card">
                                    <p>{{ $text->title }}</p>
                                    <p>{{$text->langOption->language_name}}</p>
                                    <br>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="language-spez-text">
                <button class="language-button" data-target="PT" onclick="changeArrowDirection('PT')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
                    </svg>
                    <p>{{ __('api_texts.portuguese') }}</p>
                </button>
                <div id="PT" style="display: none;" class="text-container">
                    @foreach($allTexts as $text)
                        @if ($text->langOption->language_code == 'PT' && $text->created_by == 1) 
                            <a href="/textShow/{{$text->id}}">
                                <div class="Texts-Card">
                                    <p>{{ $text->title }}</p>
                                    <p>{{$text->langOption->language_name}}</p>
                                    <br>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div> 
        </div>
    </div>
</div>

<script>
document.getElementById('toggleButton').addEventListener('change', function() {
    if(this.checked) {
        document.getElementById('privateTexts').style.display = 'none';
        document.getElementById('publicTexts').style.display = 'block';
    } else {
        document.getElementById('privateTexts').style.display = 'block';
        document.getElementById('publicTexts').style.display = 'none';
    }
});

function changeArrowDirection(lang_code) {
    const button = document.querySelector(`[data-target="${lang_code}"]`);
    const svg = button.querySelector('svg');
    svg.classList.toggle('arrow-Right');
}
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.language-button').forEach(button => {
            button.addEventListener('click', function() {
                let targetId = this.getAttribute('data-target');
                let targetElement = document.getElementById(targetId);

                if (targetElement.style.display === 'none') {
                    targetElement.style.display = '';
                } else {
                    targetElement.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
