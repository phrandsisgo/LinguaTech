

<br><br>
    @if ($path == "edit")
        <p class="sectiontitle">Interessen aktualisieren.</p>
    @elseif($path==initiate)
        <p class="pagetitle">Danke dass Sie ein Profil angelegt haben. Sie können nun Ihre Sprachen angeben</p>
        <p class="section-content">Mit diesen Spracheinstellungen wird es Ihnen vereinfacht, was Sie nachher für Lerntexte und Lernlisten vorgeschlagen bekommen</p>
    @endif

<form action="/updateInterests" method="post">
    @csrf
    <div class="sectionWrapper">
        <div class ="interestsWrapper">
        @foreach ($interests as $interest)
        <div class="displayFlex interestsWords">
                <input type="checkbox" id="interest_{{ $interest->id }}" class="interestCheckbox" value="{{$interest->id}}" name="interests[]" {{ $user->interests->contains(function ($val) use ($interest) { return $val->id == $interest->id; }) ? 'checked' : '' }}/>


            
                <label for="interest_{{ $interest->id }}" class="section-content">{{ $interest->name }}</label>
        </div>
        @endforeach
        </div>
        <br>
        <button type="submit" class="approveButton">Interesse aktualisieren</button>
    </div>
</form>