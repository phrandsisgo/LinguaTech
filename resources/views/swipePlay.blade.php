@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')


<script src="https://hammerjs.github.io/dist/hammer.js"></script> 
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@vite(['resources/js/animations.js', 'resources/css/application.scss', 'resources/css/animations.scss'])
@endsection

@section('content')

<div class="karteContent">
    <div class="flip-card-inner"id="flip-card-inner">
        <div class="flashCardContent frontface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
                <div class="countAnzeige">12/23 Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin">11</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="baseWord">word</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">

            </div>

        </div>

        <div class="flashCardContent backface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin">12</p></div>
                <div class="countAnzeige">12/23 Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin">11</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="targetWord">Wort</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
            </div>
        </div>
    </div>
</div>

<script>

function showUebersetzung(){
    var flipcard = document.getElementById('flip-card-inner');
    //I need a function that checks if the class turnCard is already there and if so, removes it
    
    if(flipcard.classList.contains('turnCard')){
        flipcard.classList.remove('turnCard');
    }else{
        flipcard.classList.add('turnCard');
    }
}
</script>
@endsection
