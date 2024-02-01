<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class patchnotesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('release_notes')->insert([
            [
            'title' => 'Erste Release Notes 04.Dezember.2023',
            'content' => '<p class="section-content">

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
            
                <img src="/BilderPatchNotes/screenshot2.png" alt="impressum Icon" class="screenshots">
                    <p class="Bildunterschrift">
                        Screenshot der aktuellen Version
                    </p>
                    
                    <img src="/BilderPatchNotes/screenshot1.png" alt="impressum Icon" class="screenshots">
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
            
                <img src="/BilderPatchNotes/AIEinbindung.png" alt="Bild von 4 Screenshots wie die Implementierung aussehen könnte." class="screenshots">
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
              </p>',
            'version' => '0.1',
            'created_at' => '2023-12-04 09:43:00',
            'updated_at' => '2023-12-04 10:23:00',
            ],
            [
            'title' => 'Abgabe bereit (MVP Status) 1. Februar 2024',
            'content' => '<p class="section-content">

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
              </p>',
            'version' => '0.2',
            'created_at' => '2024-02-30 09:43:00',
            'updated_at' => '2024-02-30 15:23:00',
            ],

        ]);
    }
}
