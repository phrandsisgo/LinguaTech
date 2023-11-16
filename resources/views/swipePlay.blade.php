@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')


<script src="https://hammerjs.github.io/dist/hammer.js"></script> 
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@vite(['resources/js/animations.js', 'resources/css/application.scss'])
@endsection

@section('content')
<!--
<div class="karteContent">
    <div class="flashCardContent flip-card-inner" id="flashCardContent">
        <div class="countZeile">
            <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
            <div class="countAnzeige">12/23 Wörter</div>
            <div class="doneCountBox"><p class="anzeigemargin">12</p></div>
        </div>
        <div class="flipcardWordWrapper">
            <p class="flipcardWord">word</p>
        </div>
        <div class="displayFlex">
            <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
            <div class="horizontal-fill"></div>
            <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">

        </div>

    </div>

    <div class="flashCardContent" id="flashCardContent">
        <div class="countZeile">
            <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
            <div class="countAnzeige">12/23 Wörter</div>
            <div class="doneCountBox"><p class="anzeigemargin">12</p></div>
        </div>
        <div class="flipcardWordWrapper">
            <p class="flipcardWord">word</p>
        </div>
        <div class="displayFlex">
            <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
            <div class="horizontal-fill"></div>
            <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">

        </div>

    </div>
</div>
-->
<div class="karteContent">
    <div class="flip-card-inner">
        <div class="flashCardContent frontface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
                <div class="countAnzeige">12/23 Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin">11</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord">word</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">

            </div>

        </div>

        <div class="flashCardContent backface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
                <div class="countAnzeige">12/23 Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin">11</p></div>
            </div>
            <div class="flipcardWordWrapper">
                <p class="flipcardWord">Wort</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">

            </div>

        </div>
    </div>
</div>

@endsection
