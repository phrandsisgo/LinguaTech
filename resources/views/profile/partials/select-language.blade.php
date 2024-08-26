
@if ($path == 'profile')
<p class="pagetitle">{{ __('profile.whatLanguagesCanYouAlready') }}</p>

@elseif($path == 'initiate')
<p class="pagetitle">{{ __('profile.greatToHaveProfile') }}</p>
<p class="section-content">{{ __('profile.loadLearningLists') }}</p>
@endif
<div class="sectionWrapper">
    <div class="interestsWrapper">
        <p class="sectiontitle">{{ __('profile.chooseLanguagesToLearn') }}</p>
        
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
                   
                   <button type="submit"><img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="{{ __('profile.deleteIconAlt') }}"></button>
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
        <label for="language" class="section-content">{{ __('profile.addLanguage') }}</label>
        <br>
        <select id="language" name="language[]" class="standartSelect">
            @foreach ($languages as $language)
                <option value="{{ $language->id }}">{{ $language->language_name }}</option>
                
            @endforeach
        </select>
        <br><br>
        
        <input type="submit" value="{{ __('profile.add') }}" class="approveButton">
        @if ($path == 'initiate'&& count($user->languages) > 0)
        <button class="standartButton">
            <a href="/library"  style="text-decoration: none;">{{ __('profile.continue') }}</a>
        </button>
        @elseif($path == 'initiate'&& count($user->languages) == 0)
        <button class="standartButton">
            <a href="/library"  style="text-decoration: none;">{{ __('profile.skipOption') }}</a>
        </button>
        @endif

    </form>
</div>
