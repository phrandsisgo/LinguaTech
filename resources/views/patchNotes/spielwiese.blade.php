@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')

<p class="section-content">

Wow, es ist schon wieder eine Weile her, seitdem ich das letzte Mal ein Update veröffentlicht habe. <br>
Ich kann nun stolz verkünden, dass dies die erste Version ist von LinguaTech.  <br>

<br><br>
</p>
<p class="sectiontitle">
Der aktuelle Stand: <br>
</p> <br>
<div class="sectionWrapper">
    <p class="sectionSubTitle">
        Funktionalität:
    </p>
    <p class="section-content">
        Grundsätzlich bin ich ja mit dem Projekt sehr zufrieden. Natürlich hätte ich gerne weitere Funktionalitäten implementiert, aber ich muss auch realistisch bleiben. <br>
        Was bisher gut gegangen ist, ist dass man Texte nachlesen Kann und die mir auch 
        <br><br>
    </p>
    <p class="sectionSubTitle">
        Neue Funktionalitäten: 
    </p>
    <p class="section-content">
            Als erstes dürfte vielleicht aufgefallen sein, dass nun auch Texte in verschiedenen Schwierigkeitsstufen verfügbar sind. <br>
            Das Tolle daran ist, dass man sich nicht nur die Übersetzung anzeigen lassen kann sondern man kann auch gleich die Begriffe in einer bestehenden Liste einfügen. Für die Übersetzung wird der Dienst von Deep<l verwendet. <br>
        <br><br>
    </p>
    <p class="sectionSubTitle">
        Was leider nicht geklappt hat:
    </p>
    <p class="section-content">
        Ich hatte mir fest vorgenommen, die Seite auch in Englisch verfügbar zu machen.
        Der Grund, warum dies nicht geklappt hat, ist, dass sich die Übersetzungen sich als sehr Zeitintensiv herausgestellt haben und ich doch lieber den Fokus auf weitere Funktionalitäten gelegt habe. <br>
        Was ich aus Zeitgründen auch nicht implementiert habe ist, dass Benutzer ihre eigene Texte hochladen können. 
        <br><br>
    </p>
</div>


<br>
<p class="sectiontitle">
    Auf welche Probleme ich gestossen bin:
</p>
<p class="section-content">
     Natürlich ist es klar, dass mir Fehler passieren werden, wenn ich meine erste Fullstack-App baue. <br>
        Was ich nicht erwartet habe ist, dass ich so viele Probleme mit der Datenbank haben werde. <br>
        Oder um es anders zu sagen, ich habe die Datenbankstruktur am Anfang falsch aufgebaut, was mir Schwierigkeiten bereitet hat.
<br><br>
    </p>
<div class="sectionWrapper">
    <p class="sectionSubTitle">
        Datenbank:
    </p>
    <p class="section-content">
        Was die Datenbank betrifft, so habe ich die Struktur am Anfang leider viel zu kompliziert aufgebaut. 
        Mein Nächster Schritt müsste sein diese aufzuarbeiten und zu vereinfachen. <br>
        Die derzeitige Datenbankstruktur verursacht leider auch sicherheitsrelevante Fehler (Middle ware)
        Jedoch mache mich mir diesbezüglich nicht viele Sorgen, da ich keinen einzigen aktiven Nutzer habe. (stand Januar 2024) <br> 
    <br><br>
    </p>
    <p class="sectionSubTitle"> Mehrsprachige Unterstützung:</p>
    <p class="section-content">
        Ich habe tatsächlich ein paar Seiten übersetzt (siehe Pfad: LinguaTech/lang/en) <br>
        Jedoch kann man es nicht auf der Seite Anzeigen lassen. Ich habe dies bewusst getan da es nicht Vollständig ist.
        Da ich gemerkt habe, dass es sehr zeitaufwändig ist und werde deshalb in näherer Zukunft nicht daran weiterarbeiten. <br>
    </p>


    <br><br>
</div>

<p class="sectiontitle">
    Wie sieht die Zukunft aus?
</p>
        

<div class="sectionWrapper">
    <p class="section-content">
        Also als erstes werde ich mir eine kleine Auszeit von diesem Projekt gönnen. <br> 
        Ich habe nun die vergangenen 3 Monaten an diesem Projekt gearbeitet und ich könnte gut mal einen frischen Wind vertragen. <br>
        Ich werde mich in der Zwischenzeit mit anderen Projekten beschäftigen (namentlich ein Django Fullstack-Projekt). <br> 
        Und natürlich werde ich auch Linguatech dazu verwenden, das ich es als Bewerbungsprojekt verwenden kann. <br>
    </p>
    <br><br>
    <p class ="sectionSubTitle">
        Die Zukunft von LinguaTech: <br>
    </p>
    <p class="section-content">
        Ich möchte damit anfangen, dass ich noch unzählige Ideen habe was man noch alles implementieren könnte. <br>
        Dennoch werde ich eher in naher Zukunft versuchen, gute Rückmeldungen zu bekommen um zu schauen wo es am meisten Sinn macht weiter zu arbeiten.
        Persönlich denke ich mir, dass es ein sehr interessantes Projekt ist, jedoch nocht nicht ganz meiner Vorstellung entspricht von einer sehr guten Sprachlern-Plattform. <br>

    </p>
</div>
<br><br>  
<p class="section-content">
    Ich freue mich über  eure Rückmeldungen und Vorschläge.
    <br>
    Vielen Dank für eure Unterstützung und euer Interesse an diesem Projekt.
      
      <br><br>  
    Beste Grüsse, <br>
    Francisco Wohlgemuth
  </p>
    @endsection