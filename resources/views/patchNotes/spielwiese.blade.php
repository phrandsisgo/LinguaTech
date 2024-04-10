@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')

<p class="section-content">

So, es sind schon wieder 2 Monate vergangen seit dem letzten Update. <br>
Bei Linguatech hat sich so einiges getan. 
<br><br>
</p>
<p class="sectiontitle">
Was sich verändert hat. <br>
</p> <br>
<div class="sectionWrapper">
    <p class="sectionSubTitle">
        Übersetzung:
    </p>
    <p class="section-content">
        Mittlerweile ist die Seite auch vollständig ins Englische übersetzt worden. <br>
        Und somit ist die Seite Bilingual verfügbar. Theoretisch könnte ich jetzt die seite auch auf weitere Sprachen übersetzen was aber jedoch noch nicht geplant ist, falls Ihnen das wichtig ist, lassen sie es mich wissen. <br>
        <br><br>
    </p>
    <p class="sectionSubTitle">
       Übungswiederhulungen: 
    </p>
    <p class="section-content">
            Nun sind die Lernlisten auch zur wiederholung geignet <br>
            Das Tolle daran ist, dass man sich nicht nur die Übersetzung anzeigen lassen kann sondern man kann auch gleich die Begriffe in einer bestehenden Liste einfügen. Für die Übersetzung wird der Dienst von Deepl verwendet. <br>
      
    </p>
    <img src="/Images/EndScreen.png" alt="Endscreen of swipelearn as a screenshot" />
    <br><br><br>
    <p class="sectionSubTitle">
       Funktionen die hinzugefügt wurden:
    </p>
    <p class="section-content">
        Es wurde beim Swipe-learn die Funktion hinzugefügt, worden, dass man nach dem beenden eines Übungszyklus man erneut nur die Wörter üben kann die beim ersten zyklus nicht gewusst wurden. <br>
        Dann habe ich auch schon darüber geschrieben, dasss Linguatech nun auch auf Englisch verfügbar ist. <br>
        Und die Texte können genauer auf die jeweilige Sprache berücksichtigt werden.
        <br><br>
        Dazu möchte ich noch mitteilen, dass nun auch alle listen als JSON objekt exportiert werden können. Sodass man mit dem LLM seiner Wahl einen neuen Text erstellen kann.

    </p>
    <br><br><br>
    <img src="/Images/learncycle.png" alt="Ein Bild vom Zyklus wie man auf Linguatech lernen kann."style="width:90%">
    <p class="section-content">Hier eine darstellung wie man Linguatech zum Sprachenlernen verwenden kann.</p>
    <br><br><br>
    
    <p class="sectionSubTitle">
        Stolpersteine:
    </p>
    <p class="section-content">
        Ich hatte mir ja wie in der letzten Patchnotes vorgenommen eine Datenbank überarbeitung zu durchnehmen. Dies hat leider nur teilweise geklappt. <br>
        Mir ist leider beim migrieren der Datenbank (techn. für die Datenbank über programm code zu ändern) ein Fehler unterlaufen. Leider musste ich die Datenbank zurücksetzen und habe einige Daten verloren. <br>
        Das war mir auch ein guter Lernprozess, da ich nun weiss viel besser wie ich in Zukunft vorgehen muss. <br>
        <br><br>
    </p>
    <img src="/Images/DatabaseInfo.png" alt="Eine Bildnerische Darstellung wie die Datenbank strukturiert ist." style="width:90%">
    <p class="section-content">Hier eine Darstellung wie die Datenbank von Linguatech aufgebaut ist. </p>
    
</div>
<br><br>

<p class="sectiontitle">
    Was habe ich mir für die zukunft vorgenommen?
</p>
        

<div class="sectionWrapper">
    <p class="section-content">
        Nun habe ich fast alle geplanten Funktionen umgesetzt. <br>
        Das einzige was noch fehlt ist eine grössere Sprachenauswahl für die Benutzerinnen zur Verfügung zu stellen. <br>
        Auch etwas ist den Aufwand für die Benutzer zu reduzieren, sodass gewisse Funktionen ausprobiert werden können ohne überhaupt ein Konto zu erstellen. <br> 

        Abgesehen davon gibt es nur noch ein paar kleinigkeiten und ideen die ich noch umsetzen könnte. Jedoch denke ich, dass ich nun eher eine Pause mit der aktiven Entwicklung einlegen werde. <br>
        <br>
        Denn nun möchte ich Userfeedback einholen und schauen was ich noch verbessern könnte. <br>
        Desswegen wird mein nächster Schritt sein, hauptsächlich die Seite zu promoten und Feedback einzuholen. <br>
        <br>
        Ich habe schon viel Zeit investiert um das Projekt nach meiner persönlichen Vorstellung zu entwickeln. Jetzt ist es nun an der Zeit nach Tester/innen zu suchen und die Seite nach ihren Bedürfnissen an zu passen. <br>
        Falls Ihr grossartige Ideen oder Rückmeldungen habt, dann schreibt sie mir gerne auf francisco.wohlgemuth@hotmail.com oder hier unten in die Kommentar sektion. <br>
    </p>
</div>
<br><br>  

    <p class="sectiontitle">
        Ein herzliches Dankeschön:
    </p>
<div class="sectionWrapper">
    <p class="section-content">
        An dieser Stelle möchte ich einen Moment innehalten, um jedem Einzelnen von euch zu danken. Eure Unterstützung, Geduld und das wertvolle Feedback haben es möglich gemacht, LinguaTech stetig zu verbessern und weiterzuentwickeln. Es ist eine Reise, die ich ohne euch nicht hätte antreten können. <br><br>
        Ich bin unendlich dankbar für die Gemeinschaft, die sich um LinguaTech gebildet hat. Eure Begeisterung und euer Engagement sind für mich nicht nur eine Motivationsquelle, sondern auch ein ständiger Ansporn, die Plattform zu perfektionieren und neue Funktionen zu implementieren, die eure Sprachlernreise noch bereichernder machen. <br><br>
    
        Bitte wisst, dass eure Meinungen und Ideen immer willkommen sind und dass ich mich darauf freue, LinguaTech gemeinsam mit euch weiter zu gestalten. Lasst uns gemeinsam in eine Zukunft gehen, in der das Erlernen neuer Sprachen nicht nur einfacher, sondern auch inspirierender und freudvoller wird. <br><br>
        
        Vielen Dank im voraus für eure Unterstützung und euer Interesse an diesem Projekt. 
        
    </p>
</div>
<br>

        <p class="section-content">
      
      <br><br>  
    Beste Grüsse, <br>
    Francisco Wohlgemuth
  </p>
    @endsection