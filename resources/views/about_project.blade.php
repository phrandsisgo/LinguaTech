@extends('layouts.lingua_main')
@section('title', 'Home')
@section('content')



<p class="pagetitle">{{ __('about_project.discoverLinguaTech') }}</p>

<p class="sectiontitle">{{ __('about_project.whatIsLinguaTech') }}</p>
<p class="section-content">{{ __('about_project.linguaTechDescription') }}</p>
    <br>

<p class="sectiontitle">{{ __('about_project.smartWayToLearn') }}</p>
<p class="section-content">{{ __('about_project.welcomeMessage') }}</p>

<p class="sectiontitle">{{ __('about_project.contextMatters') }}</p>
<p class="section-content">{{ __('about_project.contextDescription') }}</p>

<p class="sectiontitle">{{ __('about_project.yourCourseYourRules') }}</p>
<p class="section-content">{{ __('about_project.courseCustomization') }}</p>

<p class="sectiontitle">{{ __('about_project.readyToSpeak') }}</p>
<p class="section-content">{{ __('about_project.registerNow') }}</p>

<p class="sectiontitle">{{ __('about_project.contactMe') }}</p>
<p class="section-content">{{ __('about_project.moreAboutMe') }} <a href="/about_me">{{ __('about_project.clickHere') }}</a>.</p>
<p class="section-content">{{ __('about_project.questionsFeedback') }} <a href="#">{{ __('about_project.contactDiscord') }}</a>.</p>
<!-- sollte erst nach erfolgreicher Sozialen Medien angezeigt werden.
<p class="sectiontitle">{{ __('about_project.followMe') }}</p>
<p class="section-content">{{ __('about_project.followOnSocial') }}</p>
-->
@endsection
