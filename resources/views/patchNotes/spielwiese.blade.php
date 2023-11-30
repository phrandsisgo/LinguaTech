@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')

<p class="section-content">

Hallo, mein Name ist Francisco Wohlgemuth, und ich freue mich, die ersten Release Notes für mein Projekt vorzustellen. Derzeit befindet sich das Projekt in einer Closed-Beta-Phase und ist nur für eine kleine Gruppe ausgewählter Benutzer zugänglich.
<br><br>
</p>
<p class="sectiontitle">
Reden wir mal über den aktuellen Stand des Projekts:
</p> <br>
<div class="sectionWrapper">
    <p class="sectionSubTitle">
        User Interface:
    </p>
    <p class="section-content">
            Das Grundgerüst des User Interfaces (UI) ist bereits implementiert.
            <br>
            Gerne nehme ich Feedback von den Beta-Testern entgegen, um das UI zu verbessern.
        <br><br>
    </p>
    <p class="sectionSubTitle">
        Listenfunktionen:
    </p>
    <p class="section-content">
            Die Kernfunktionalitäten der Listen sind fertiggestellt.
            Die Benutzeroberfläche der Listenfunktionen bedarf einer weiteren optischen Überarbeitung, um die Benutzerfreundlichkeit zu erhöhen.
        <br><br>
    </p>
    <p class="sectionSubTitle">
        CRUD-Operationen:
    </p>
    <p class="section-content">
            Das komplette Create-Read-Update-Delete (CRUD)-System ist implementiert.
            <br>
            Jeder Benutzer kann seine eigenen Listen erstellen, bearbeiten und löschen.
            
        <br><br>
    </p>
</div>


<br>
<p class="sectiontitle">
    Zukünftige Entwicklungen: <br>
</p>
<div class="sectionWrapper">
    <p class="sectionSubTitle">
        UX-Überarbeitung:
    </p>
    <p class="section-content">
        Sobald ich genügend Rückmeldungen von den ersten Tesern erhalten habe, werde ich das UI und die UX überarbeiten, um die Benutzerfreundlichkeit zu erhöhen.
    <br><br>
    </p>
    <p class="sectionSubTitle"> Mehrsprachige Unterstützung:</p>
    <p class="section-content">
        Aktuell ist die Seite auf Deutsch verfügbar. <br>
        Die Implementierung einer englischen Version ist in Arbeit, um das Projekt einem breiteren Publikum zugänglich zu machen.
    <br>
    </p>

    <img src="{{ asset('BilderPatchNotes/screenshot2.png')}}" alt="impressum Icon" class="screenshots">
        <p class="Bildunterschrift">
            Screenshot der aktuellen Version
        </p>
        
        <img src="{{ asset('BilderPatchNotes/screenshot1.png')}}" alt="impressum Icon" class="screenshots">
        <p class="Bildunterschrift">
            Screenshot der Englischen Version
        </p>
        
    <br><br>
    <p class="sectionSubTitle"> Einbindung von Künstlicher Intelligenz:</p>
    <p class="section-content">
        Die Einbindung von Künstlicher Intelligenz ist ein langfristiges Ziel des Projekts. <br>
        Damit sollte es möglich sein, Texte anhand von den Wortlisten zu generieren und diese auch deinem Niveau anzupassen.
        <br>
    </p>

    <img src="{{ asset('BilderPatchNotes/AIEinbindung.png')}}" alt="Bild von 4 Screenshots wie die Implementierung aussehen könnte." class="screenshots">
        <p class="Bildunterschrift">
            Noch in der Ideen Phase.
        </p>
        <br>
        <p class="section-content">
            Im ersten Bild kann man sehen, wie man einen neuen Text erstellen könnte. <br>
            In der zweiten Phase sollte es möglich sein, auf ein einzelnes Wort zu drücken und dann entweder die Übersetzung anzuzeigen oder die Option haben, dieses Wort in eine Liste einzugügen. <br>
            Eine weitere Idee ist es, dass man auch aktuelle Nachrichten über ein Land in der Sprache, die man gerade lernt lesen kann und das auch im schwierigkeitsgrad in dem man sich gerade befindet.
            <br>
        <br>
    </p>
</div>
<br><br>  
<p class="section-content">
    Ich freue mich über  eure Feedbacks und Vorschläge.
    <br>
    Vielen Dank für eure Unterstützung und euer Interesse an diesem Projekt.
      
      <br><br>  
    Beste Grüsse, <br>
        Francisco Wohlgemuth
  </p>
    @endsection