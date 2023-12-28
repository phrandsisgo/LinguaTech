@extends('layouts.lingua_main')
@section('title', 'Initiate')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection
<?php 
$path = "initiate";
?>
@section('content')

@include('profile.partials.select-language')
<!--  -->
@endsection