@extends('layouts.lingua_main')
@section('title', 'Home')
@section('content')
<!-- this has no route yet. -->
    <!--
<p class="pagetitle">Entdecke Lingua Tech</p>
<p class="sectiontitle">Die smarte Art, Sprachen zu lernen</p>
<p class="section-content">Willkommen bei LinguaTech, der zukunftsorientierten Web-App, die dein Sprachlernen revolutioniert. Egal, ob du gerade erst anfängst oder deine Mehrsprachigkeit perfektionieren möchtest, LinguaTech bietet dir eine intuitive und effektive Methode, um Sprachen schneller zu lernen und dabei Spass zu haben.</p>

<p class="sectiontitle">Lerne mit Kognaten</p>
<p class="section-content">Tauche ein in die reichhaltige Sammlung von Texten und entdecke, wie Kognaten - Wörter, die in verschiedenen Sprachen ähnlich sind - deinen Lernprozess beschleunigen können. Mit LinguaTech wirst du die Verbindungen zwischen Sprachen sehen und verstehen, wie nie zuvor.</p>

<p class="sectiontitle">Kontext macht Meister</p>
<p class="section-content">Bei LinguaTech ist der Kontext entscheidend. Du lernst nicht nur neue Wörter, sondern auch, wie du sie in Gesprächen und Schriftstücken natürlich anwendest.</p>

<p class="sectiontitle">Dein Sprachkurs deine Regeln</p>
<p class="section-content">Bei LinguaTech bist du der Gestalter deiner Lernerfahrung. Hier kannst du dir deine eigenen Textsammlungen zusammenstellen und sie so anpassen, dass sie genau zu deinem Lernstil passen. Beobachte, wie dein Verständnis für die Sprache mit jeder Session wächst, dank unserer Tools zur Fortschrittsverfolgung. Und weil das Leben nicht stillsteht, begleitet dich LinguaTech – lerne auf jedem Gerät, wann und wo du willst.</p>

<p class="sectiontitle">Bereit, die Sprache zu sprechen, die dich fasziniert?</p>
<p class="hyperlink">Registriere dich jetzt und beginne deine Reise!</p>

<p class="sectiontitle">Kontaktiere mich</p>
<p class="section-content">Falls sie mehr über mich erfahren wollen, dann clicken sie <a href="/about_me">hier</a> drauf.</p>
<p class="section-content">Hast du Fragen, Anregungen oder Feedback? Ich freue mich, von dir zu hören! Schreib mir eine Nachricht an <a href="#">discord: phrandsisgo</a></p>

<p class="sectiontitle">Folge mir</p>
<p class="section-content">Folge mir auf <a href="#">Twitter</a> und <a href="#">Instagram</a> für Updates und Neuigkeiten.</p>
-->



<p class="pagetitle">{{ __('about_project.discoverLinguaTech') }}</p>

<p class="sectiontitle">Was ist LinguaTech?</p>
<p class="section-content">LinguaTech ist ein Lernplattform die das Ziel hat Sprachen den Benutzer beizubringen. Es wurde von Francisco Wohlgemuth entwickelt als Abschlussprojekt in einem coding Bootcamp</p>
<br>

<p class="sectiontitle">{{ __('about_project.smartWayToLearn') }}</p>
<p class="section-content">{{ __('about_project.welcomeMessage') }}</p>

<p class="sectiontitle">{{ __('about_project.learnWithCognates') }}</p>
<p class="section-content">{{ __('about_project.cognatesDescription') }}</p>

<p class="sectiontitle">{{ __('about_project.contextMatters') }}</p>
<p class="section-content">{{ __('about_project.contextDescription') }}</p>

<p class="sectiontitle">{{ __('about_project.yourCourseYourRules') }}</p>
<p class="section-content">{{ __('about_project.courseCustomization') }}</p>

<p class="sectiontitle">{{ __('about_project.readyToSpeak') }}</p>
<p class="section-content">{{ __('about_project.registerNow') }}</p>

<p class="sectiontitle">{{ __('about_project.contactMe') }}</p>
<p class="section-content">{{ __('about_project.moreAboutMe') }} <a href="/about_me">{{ __('about_project.clickHere') }}</a></p>
<p class="section-content">{{ __('about_project.questionsFeedback') }} <a href="#">{{ __('about_project.contactDiscord') }}</a></p>

<p class="sectiontitle">{{ __('about_project.followMe') }}</p>
<p class="section-content">{{ __('about_project.followOnSocial') }}</p>

@endsection
