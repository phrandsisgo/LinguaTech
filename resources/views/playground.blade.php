@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')


<script src="https://hammerjs.github.io/dist/hammer.js"></script> 
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
@vite(['resources/js/animations.js', 'resources/css/application.scss', 'resources/css/playground.scss'])
@endsection

@section('content')

<h1>Your Coordinates</h1>
    <p>Latitude: <span id="latitude">Loading...</span></p>
    <p>Longitude: <span id="longitude">Loading...</span></p>

    <script>
        // JavaScript code to fetch and display coordinates
        function displayCoordinates(position) {
            const latitudeElement = document.getElementById("latitude");
            const longitudeElement = document.getElementById("longitude");

            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            latitudeElement.textContent = latitude.toFixed(6);
            longitudeElement.textContent = longitude.toFixed(6);
        }

        function displayError(error) {
            const latitudeElement = document.getElementById("latitude");
            const longitudeElement = document.getElementById("longitude");

            latitudeElement.textContent = "Error fetching latitude";
            longitudeElement.textContent = "Error fetching longitude";
        }

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(displayCoordinates, displayError);
        } else {
            const latitudeElement = document.getElementById("latitude");
            const longitudeElement = document.getElementById("longitude");

            latitudeElement.textContent = "Geolocation is not available in this browser.";
            longitudeElement.textContent = "Geolocation is not available in this browser.";
        }
    </script>
@endsection
