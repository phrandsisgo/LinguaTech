
<p class="pagetitle">Welche Sprachen kannst du schon?</p>
<div class="sectionWrapper">
    <div class="interestsWrapper">
        <p class="sectiontitle"> diese Sprachen kannst du schon:</p>
        
       @foreach ($user->languages as $language)
        
           <div class="langWrapper displayFlex interestsWords">
               <p>{{ $language->language_name }}</p>
               <form action="/removeLanguage/{{ $language->id }}" method="post" class="delete-hitbox">
                   @csrf
                   <button type="submit"><img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon"></button>
               </form>
           </div>
           
       @endforeach
    </div>
    <form action="/addLanguage" method="post">
        @csrf
        <label for="language" class="section-content">Neue Sprache hinzufügen:</label>
        <br>
        <select id="language" name="language[]" class="standartSelect">
            @foreach ($languages as $language)
                <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                
            @endforeach
        </select>
        <br><br>
        

        <button type="button" onclick="addLanguage()" class="approveButton">Hinzufügen</button>
        <input type="submit" value="Speichern" class="approveButton">
    </form>
    <script>
function addLanguage() {
    var language = document.getElementById('language').value;
    var level = document.getElementById('level').value;

    // Fügen Sie die Sprache zur Liste hinzu
}

function removeLanguage(language, level) {
    // Entfernen Sie die Sprache aus der Liste
}


</script>
</div>

