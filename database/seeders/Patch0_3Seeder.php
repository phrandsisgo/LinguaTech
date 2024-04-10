<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Patch0_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('release_notes')->insert([
            [
            'title' => '(DE) Linguatech gibt es nun in mehreren Sprachen 10.April.2024',
            'content' => '
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
              </p>',
            'created_at' => '2024-04-10 18:15:00',
            'updated_at' => '2024-04-10 20:40:00',
            'version' => '0.3',
            'lang_option_id' => 1,
            ],

            [
            'title' => '(EN) Linguatech is now available in multiple languages 10.April.2024',
            'content' => 
            <<<EOT
            <p class="section-content">
            So, it has been another 2 months since the last update. <br>
            A lot has happened at LinguaTech. 
            <br><br>
            </p>
            <p class="sectiontitle">
                What has changed. <br>
            </p> <br>
            <div class="sectionWrapper">
                <p class="sectionSubTitle">
                    Translation:
                </p>
                <p class="section-content">
                    The website has now been fully translated into English. <br>
                    Thus, the site is available bilingually. Theoretically, I could now translate the site into more languages, but that is not planned yet. If this is important to you, please let me know. <br>
                    <br><br>
                </p>
                <p class="sectionSubTitle">
                Exercise repetitions: 
                </p>
                <p class="section-content">
                        The learning lists are now also suitable for repetition. <br>
                        The great thing is that you can not only display the translation but also insert the terms directly into an existing list. The translation service by Deepl is used for this. <br>
                
                </p>
                <img src="/Images/EndScreen.png" alt="Endscreen of swipelearn as a screenshot" />
                <br><br><br>
                <p class="sectionSubTitle">
                Added features:
                </p>
                <p class="section-content">
                    A feature has been added to Swipe-learn, allowing you to practice only the words you did not know in the first cycle after completing an exercise cycle. <br>
                    Then, I have already written about LinguaTech being available in English now. <br>
                    And texts can be more accurately adjusted to the respective language.
                    <br><br>
                    Furthermore, I would like to inform that now all lists can be exported as a JSON object. This allows you to create a new text with the LLM of your choice.
            
                </p>
                <br><br><br>
                <img src="/Images/learncycle.png" alt="An image of the cycle how one can learn on LinguaTech." style="width:90%">
                <p class="section-content">Here is an illustration of how you can use LinguaTech for language learning.</p>
                <br><br><br>
                
                <p class="sectionSubTitle">
                    Stumbling blocks:
                </p>
                <p class="section-content">
                    As I mentioned in the last patch notes, I had planned to revise the database. Unfortunately, this only partially worked. <br>
                    Unfortunately, a mistake occurred while migrating the database (technical term for changing the database via program code). I had to reset the database and lost some data. <br>
                    This was also a good learning process, as I now know much better how to proceed in the future. <br>
                    <br><br>
                </p>
                <img src="/Images/DatabaseInfo.png" alt="A pictorial representation of how the database is structured." style="width:90%">
                <p class="section-content">Here is an illustration of how the LinguaTech database is structured. </p>
                
            </div>
            <br><br>
            
            <p class="sectiontitle">
                What I have planned for the future?
            </p>
                    
            
            <div class="sectionWrapper">
                <p class="section-content">
                    Now, I have implemented almost all the features I had planned. <br>
                    The only thing missing is to provide a larger selection of languages for the users. <br>
                    Another aspect is to reduce the effort for users so that certain functions can be tried out without even creating an account. <br> 
            
                    Besides, there are only a few minor things and ideas that I could still implement. However, I think that I will now rather take a break from active development. <br>
                    <br>
                    Because now I want to gather user feedback and see what I could improve. <br>
                    Therefore, my next step will be to mainly promote the site and gather feedback. <br>
                    <br>
                    I have already invested a lot of time to develop the project according to my personal vision. Now it's time to look for testers and adapt the site according to their needs. <br>
                    If you have great ideas or feedback, please write to me at francisco.wohlgemuth@hotmail.com or down here in the comment section. <br>
                </p>
            </div>
            <br><br>  
            
                <p class="sectiontitle">
                    A heartfelt thank you:
                </p>
            <div class="sectionWrapper">
                <p class="section-content">
                    At this point, I would like to pause for a moment to thank each and every one of you. Your support, patience, and valuable feedback have made it possible to continuously improve and develop LinguaTech. It's a journey I couldn't have embarked on without you. <br><br>
                    I am infinitely grateful for the community that has formed around LinguaTech. Your enthusiasm and commitment are not just a source of motivation for me but also a constant incentive to perfect the platform and implement new features that make your language learning journey even more enriching. <br><br>
                
                    Please know that your opinions and ideas are always welcome, and I look forward to shaping LinguaTech together with you. Let's move into a future where learning new languages is not only easier but also more inspiring and enjoyable. <br><br>
                    
                    Thank you in advance for your support and interest in this project. 
                    
                </p>
            </div>
            <br>
            
                    <p class="section-content">
                
                <br><br>  
                Best regards, <br>
                Francisco Wohlgemuth
            </p>  
            EOT
            ,
            'created_at' => '2024-04-10 18:15:00',
            'updated_at' => '2024-04-10 20:40:00',
            'version' => '0.3',
            'lang_option_id' => 8,




            ]
        ]);

    }
}
