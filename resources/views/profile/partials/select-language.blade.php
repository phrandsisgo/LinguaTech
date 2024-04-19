@if ($path == 'profile')
<p class="pagetitle">Welche Sprachen können Sie schon?</p>

@elseif($path == 'initiate')
<p class="pagetitle">Toll, dass Sie ein Profil bei Linguatech.</p>
<p class="section-content"> Um Lernlisten aus dem Katalog auf Ihr Profil zu laden, wäre es toll, wenn sie die Sprachen angeben könnten die sie lernen.</p>
@endif
<div class="sectionWrapper">
    <div class="interestsWrapper">
        <p class="sectiontitle"> Wählen sie die Sprachen aus die Sie vorhaben zu lernen.</p>
        
       @foreach ($user->languages as $language)
        
           <div class="langWrapper displayFlex interestsWords">
                <p class="centerTextvertical">{{ $language->language_name }}</p>
                @if($path=='profile')
                <form action="/removeLanguage/{{ $language->id }}" method="post" class="delete-hitbox">
                @elseif($path=='initiate')
                <form action="/removeLanguageInitiate/{{ $language->id }}" method="post" class="delete-hitbox">
                @endif
                   @csrf
                   @method('delete')
                   
                   <button type="submit"><img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon"></button>
               </form>
           </div>
           
       @endforeach
    </div>
    @if($path=='profile')
    <form action="/addLanguage" method="post">

@elseif($path == 'initiate')
    <form action="/addLanguageInitiate" method="post">
@endif
        @csrf
        <label for="language" class="section-content">Sprache hinzufügen:</label>
        <br>
        <select id="language" name="language[]" class="standartSelect">
            @foreach ($languages as $language)
                <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                
            @endforeach
        </select>
        <br><br>
        

        <input type="submit" value="Hinzufügen" class="approveButton">
        @if ($path == 'initiate')
        <button class="standartButton">
            <a href="/library"  style="text-decoration: none;">Weiter</a>
        </button>
        @endif
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

