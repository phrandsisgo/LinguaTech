
@extends('layouts.lingua_main')
@section('title', 'under construction')
@section('head')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .lauf-Text{
            text-align: left;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <p class="sectiontitle">Willkommen!</p>
        <div class="lauf-Text">
            <p class="section-content">Hallo! Es freut mich, dass Sie zur Seite von Linguatech gefunden haben.
                Hier Legen wir Wert Darauf, dass Sie Sprachenlernen können mit dem Fokus auf Vokabular erweiterung.
                Sie Können selbst Ihr Wissen Testen in dem sie die SwipeLearn Funktion ausprobieren. 
            </p>
            <img src="{{ asset('Images/SwipeLearn.gif')}}" alt="Eine Animation die Zeigt wie die Swipe funktionalität funktioniert auf dem SwipeLearn">
            <p>Eine Darstellung der SwipeFunktion die beim drauf klicken auch die Übersetzung zeigt.</p>

            <br><br><br>

            <p class="section-content">Ausserdem gibt es eine Bibliothek mit Texten in verschiedenen Schwierigkeitsstufen in derzeit 5 Sprachen: Deutsch, Englisch, Russisch, Französisch und Portugiesisch.
                Mit diesen Texten können sie leicht und effektiv Wörter die sie nicht kennen, simpel übersetzen lassen. Und damit nicht genug, Sie können diese Wörter auch gleich Ihrer Lernliste hinzufügen.
            </p>
            <img src="{{ asset('Images/apiGif.gif')}}" alt="Eine Animation um zu Zeigen wie es mit den Texten Funktioniert.">
            <p>Eine Darstellung der Textfunktion die beim drauf klicken auch die Übersetzung zeigt.</p>
            <br><br><br>
            <p class="section-content">
                Spricht sie diese Lernmethode an, dann <a href="/register">Registrieren sie sich</a> doch gleich und fangen an zu lernen.<br>
                Oder falls sie schon ein Konto haben, dann <a href="/login">loggen sie sich ein</a> und fangen an zu lernen.
            </p>
        </div>

        
       
@endsection
