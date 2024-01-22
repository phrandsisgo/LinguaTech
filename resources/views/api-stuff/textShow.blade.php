@extends('layouts.lingua_main')
@section('title', 'textPlay')
@section('head')
<style>
        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }

        .highlighted {
            background-color: yellow;
        }

        .word {
            cursor: pointer;
            display: inline;
        }
    </style>
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            const textContainer = document.getElementById('textContainer');
            // Russischer Text mit deutscher Übersetzung in Klammern
            const text = {!! json_encode($text->text) !!};
            //alert("text");
        
            
            //В свободное время Кирилл также занимается программированием. Он создает собственные проекты и участвует в хакатонах. Ему нравится решать сложные задачи и находить новые способы улучшить веб-сайты.Кирилл любит свою работу и гордится тем, что он веб-разработчик. Он знает, что его работа помогает людям делать интернет лучше и более интересным местом.
            
            
            // Teile den Text in Sätze
            const sentences = text.split(/(?<=[.\?!]) /);


            sentences.forEach(sentence => {
                sentence.split(/([\p{L}]+)/gu).forEach(part => {
                    const span = document.createElement('span');
                    span.textContent = part;
                    span.className = 'word';

                    if (/\p{L}/u.test(part)) {
                        span.addEventListener('mouseover', () => span.classList.add('highlighted'));
                        span.addEventListener('mouseout', () => span.classList.remove('highlighted'));
                        span.addEventListener('click', (e) => handleClick( part, sentence, e));
                    }

                    textContainer.appendChild(span);
                });
            });
        });

       
       /*  function handleClick(word, sentence) {
            document.getElementById('wordInput').value = word;
            document.getElementById('wordTranslateForm').submit();
        } */

    </script>
@endsection
@section('content')

<form id="wordTranslateForm" method="POST" action="{{ route('translate') }}" style="display: none;">
    @csrf
    <input type="hidden" name="word" id="wordInput">
</form>
<div class="dropdown-wrapper">
    <button class="dropbtn" onclick="myFunction()">Andere Texte</button>
    <div id="myDropdown" class="dropdown-content" >
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
        
    @foreach ($allTexts as $textL)
        <a href="/textShow/{{$textL->id}}">{{$textL->title}},{{$textL->langOption->language_name}}</a>
    @endforeach
    </div>
</div>
<p class="pagetitle ">{{$text->title}}</p>
<p id="textContainer" class="section-content"> </p>
<br><br><br>

<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}  
</script>
<!-- Modal-Struktur -->
<div id="translationModal">
    <div class="modal-content">
        <p>Das Wort übersetzt bedeutet: </p>
        <p id="translationText"></p>
        <br>
        <p >Das Wort nach dem Sie gefragt haben: </p>
        <p id="originalWord"></p>
        <br>
        
        <br>
        <form action="/list_add_word"method="post" id="wordAddForm">
            @csrf
            <!-- muss zu einem späteren Zeitpunkt noch angeben, welche Sprache die base und targetLang ist. -->
            <div class="dropdown">
            <p>Wollen sie dies einer Liste hinzufügen?</p>
                <select name="list" id="list">
                    @foreach ($ownLibraryList as $ownLibraryList)
                    <option value="{{$ownLibraryList->id}}">{{$ownLibraryList->name}}</option>
                    @endforeach
                    <input type="hidden" id="baseWordForm" name="baseWord" value="#">
                    <input type="hidden" id="targetWordForm" name="targetWord" value="#">
                </select>
            </div>
            <br>
            <button type="submit" onclick="prevDef(event)">Einfügen</button>
        </form>
        <button onclick="closeModal()">Schließen</button>
    </div>
</div>
<script>
    function prevDef(event){/* 
        event.preventDefault();
        document.getElementById('wordAddForm').submit(); */
    }
let anfrageWort=' ';
document.getElementById('wordTranslateForm').addEventListener('submit', function(event) {
    event.preventDefault();

  
    const word = document.getElementById('wordInput').value;
    anfrageWort = word;
    const formData = new FormData(this);
    let translatedWord='';
  
    fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {

                openModal(data);
                // return data;
        })
        .catch(error => console.error('Error:', error));

    });
    function handleClick(word, sentence, event) {
            event.preventDefault();
            document.getElementById('wordInput').value = word;
            document.getElementById('wordTranslateForm').dispatchEvent(new Event('submit'));
          
    }

    function openModal(data) {
        document.getElementById('translationText').textContent = data.translation;
        document.getElementById('translationModal').style.display = 'block';
        document.getElementById('originalWord').textContent = data.request;
        document.getElementById('baseWordForm').value = data.request;
        document.getElementById('targetWordForm').value = data.translation;
    }

    function closeModal() {
        document.getElementById('translationModal').style.display = 'none';
    }

</script>
@endsection
