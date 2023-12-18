
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
                <option value="ru">Russisch</option>
            </select>
        </div>
    </div>

</form>
<br><br>
<p class="sectiontitle">Bitte gebe deine Interessen an.</p>
<form action="/updateInterests" method="post">
    @csrf
    <div class ="interestsWrapper">
    @foreach ($interests as $interest)
    <div class="displayFlex interestsWords">
            <input type="checkbox" id="interest_{{ $interest->id }}" class="interestCheckbox" value="{{$interest->id}}" name="interests[]" {{ $user->interests && $user->interests->contains($interest->id) ? 'checked' : '' }}/>

        
            <label for="interest_{{ $interest->id }}" class="section-content">{{ $interest->name }}</label>
    </div>
    @endforeach
    </div>
    <br>
    <button type="submit" class="button">Interesse aktualisieren</button>
</form>