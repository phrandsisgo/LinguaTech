
<p class="pagetitle">Einstellungen für das Profil.</p>
<br><br>
<p class="sectiontitle">Bitte wäle deine Sprache aus</p>
<!-- muss noch alle spracheinstellungen von der Datenbank hierherladen. -->
<form action="#" method="post">
    <div class="sectionWrapper">
        <p class="section-content">    Hallo {{ Auth::user()->name }}, hier kannst du deine Interessen und Sprachen einstellen. Diese werden dann auf deinem Profil angezeigt.</p>
        <br>
        <div class="section-content">
            <label for="interests">Interessen</label>
            <br>
            <select name="accountLanguage" id="accountLanguage"><!-- diese Select liste muss noch über den Controller geladen werden und somit ist sie nur temporär hier. -->
                <option value="de">Deutsch</option>
                <option value="en">Englisch</option>
                <option value="fr">Französisch</option>
                <option value="es">Spanisch</option>
                <option value="it">Italienisch</option>
                <option value="ru">Russisch</option>
            </select>
        </div>
    </div>

</form>
<br><br>
<p class="sectiontitle">Bitte gebe deine Interessen an.</p>