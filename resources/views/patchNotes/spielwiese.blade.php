@extends('layouts.lingua_main')
@section('title', 'ReleaseNotes')
@section('head')
    @vite(['resources/css/library.scss'])
@endsection
@section('content')
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

    @endsection