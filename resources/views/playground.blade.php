
@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')

<script>
  //maby put the script behind the npm view
    const scrollContainer = document.querySelector('.scroll-content');

scrollContainer.addEventListener('mouseover', () => {
  scrollContainer.style.animationPlayState = 'paused';
});

scrollContainer.addEventListener('mouseout', () => {
  scrollContainer.style.animationPlayState = 'running';
});

</script>
<style>
.scroll-container {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 300px;
}

.scroll-content {
  display: flex;
  width: max-content;
  animation: scroll-loop 20s linear infinite;
}

.scroll-item {
  min-width: 300px;
  padding: 20px;
  text-align: center;
  border: 1px solid #ddd;
  background: #f9f9f9;
  border-radius: 10px;
  margin-right: 20px;
}

@keyframes scroll-loop {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

</style>
@endsection
@section('content')

{{-- first hero --}}
<div class="container col-xxl-8 px-4" style="padding-bottom: 1rem;">
  <div class="row align-items-center g-5 py-5">
    <!-- Title and Text Block -->
    <div class="col-lg-6">
      <h1 class="display-6 fw-bold lh-1 mb-3 font-color-main">
        A new way to create flashcards
      </h1>
      <!-- Image (Visible on smaller screens) -->
      <div class="d-lg-none text-center">
        <img id="gif1" src="{{ asset('Images/SwipeLearn.gif') }}" alt="Swipe Function" class="img-fluid custom-img my-4">
      </div>
      <p class="lead font-color-main">
        let's make a better way of creating your flashcards so you can spend more time learning and less with fumbling with new vocabulary
      </p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a href="/register">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 approveButton">Start Creating Now</button>
        </a>
      </div>
    </div>
    <!-- Image Block (Visible on larger screens) -->
    <div class="col-lg-6 d-none d-lg-block">
      <img id="gif1" src="{{ asset('Images/SwipeLearn.gif') }}" alt="Swipe Function" class="horizontal-fill img-fluid">
    </div>
  </div>
</div>

{{-- carousel of features spotlighted --}}
<div id="featureCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="4000" >
    <!-- Indicators/Dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#featureCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#featureCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#featureCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner" style="padding:2%">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: rgba(206, 212, 218, 0.1);">
                <div class="text-center text-carousel-welcome">
                    <h3 class="font-color-main">Choose Topics that Matter to You</h3>
                    <p class="font-color-main">Select from a wide range of topics to focus your learning. Whether it’s business, travel, or everyday conversation, we’ve got you covered.</p>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: rgba(206, 212, 218, 0.1);">
                <div class="text-center text-carousel-welcome">
                    <h3 class="font-color-main">Read Texts at Your Level and Interests</h3>
                    <p class="font-color-main">Dive into AI-generated or self-provided texts that match your language proficiency. Learn in context with materials that grow with your skills.</p>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: rgba(206, 212, 218, 0.1);">
                <div class="text-center text-carousel-welcome">
                    <h3 class="font-color-main">Effortlessly Add Words from Texts to Your Learning List</h3>
                    <p class="font-color-main">Found a new word? Just tap to add it to your learning list. Build your vocabulary directly from the texts you’re reading.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#featureCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon " aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#featureCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon " aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<br><br>
<br><br>

{{-- reverse Hero --}}
<div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
  <div class="col-lg-4 p-0 overflow-hidden shadow-lg d-none d-lg-block">
    <img id="gif2" class="rounded-lg-3" src="{{ asset('Images/apiGif.gif')}}" alt="Text Function" style="padding-bottom:5px; max-width: 100%; height: auto;">
  </div>
  <div class="col-lg-7 offset-lg-1 p-3 p-lg-5 pt-lg-3">
    <h1 class="display-6 fw-bold lh-1 font-color-main">Custom Texts and Flashcards: Learn the Language Your Way</h1>
    <p class="lead font-color-main">Unlock your language learning potential with custom flashcards and texts tailored to your needs. Swipe through your learning lists and expand your vocabulary with ease.</p>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
      <a href="/register">
      <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold approveButton">Register now and start your journey!</button>
    </a>
    </div>
  </div>
</div>

<br><br>
<br><br>

{{-- how to use linguatech --}}
<h1 class=" font-color-main" style="font-weight:700;">How to use Linguatech to improve your language skills:</h1>


<div class="container my-5">
  <div class="scroll-container">
    <div class="scroll-content">
      <div class="scroll-item">
        <h5 class="align-items-center font-color-main">Create Word List</h5>
        <p class="align-items-center font-color-main">Start your journey by building your learning list.</p>
      </div>
      <div class="scroll-item">
        <h5 class="align-items-center font-color-main">Swipe to Learn</h5>
        <p class="align-items-center font-color-main">Swipe through flashcards to solidify your memory.</p>
      </div>
      <div class="scroll-item">
        <h5 class="align-items-center font-color-main">Generate Text</h5>
        <p class="align-items-center font-color-main">Create customized texts for immersive learning.</p>
      </div>
      <div class="scroll-item">
        <h5 class="align-items-center font-color-main">Add New Words</h5>
        <p class="align-items-center font-color-main">Loop back by adding new words from your texts.</p>
      </div>
    </div>
  </div>
</div>



<div class="container py-5">
    <h1 class="text-center font-color-main">Pricing</h1>
    <p class="text-center lead font-color-main">Choose the plan that fits your needs</p>

    <!-- Introductory Text -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <p class="font-color-main">In the free version, you get unlimited access to saved stories and learning decks, as well as a limited number of generated stories. With our premium subscription, you get unlimited story generation and audiobooks to make learning even more interactive.</p>
            <p class="font-color-main">Our course is constantly evolving. New features, improved learning content, and expanded APIs are at the forefront to continuously enhance your language learning experience.</p>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <!-- Free Plan -->
        <div class="col-md-5">
            <div class="card mb-5 shadow-sm">
                <div class="card-header text-center">
                    <h4 class="my-0 font-weight-normal">Free</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">0€ <small class="text-muted">/ month</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Unlimited saved stories</li>
                        <li>Unlimited saved learning decks</li>
                        <li>Limited story generation</li>
                        <li>No audiobook generation</li>
                    </ul>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-lg btn-block btn-outline-primary">Sign Up</a>
                    @else
                    <a href="/library" class="standartButton" style="text-decoration: none;">Go to Library</a>
                    @endguest
                </div>
            </div>
        </div>
        <!-- Premium Plan -->
        <div class="col-md-5">
            <div class="card mb-5 shadow-sm">
                <div class="card-header text-center">
                    <h4 class="my-0 font-weight-normal">Premium</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">3€ <small class="text-muted">/ month</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Unlimited saved stories</li>
                        <li>Unlimited saved learning decks</li>
                        <li>Unlimited story generation</li>
                    </ul>
                    @guest
                        <a href="/register" class="approveButton" style="text-decoration: none;">Sign Up</a>
                    @else
                        <button id="checkout-button" class="approveButton" onclick="StripeInitiation()">Subscribe Now</button>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript"> 
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

    var checkoutButton = document.getElementById('checkout-button');

    checkoutButton.addEventListener('click', function () {
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            if (session.error) {
                alert(session.error);
                return;
            }
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    });
</script>
<script type="text/javascript">
    @if (app()->environment('production'))
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    @else
        var stripe = Stripe('{{ env('STRIPE_TEST_PUBLIC') }}');
    @endif

    var checkoutButton = document.getElementById('checkout-button');

    checkoutButton.addEventListener('click', function () {
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    });


    function StripeInitiation() {
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Falls du CSRF-Schutz verwendest
            },
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            if (session.error) {
                alert(session.error);
                return;
            }

            var stripe = Stripe('{{ env('STRIPE_TEST_PUBLIC') }}'); //bei production auf live key ändern

            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    }
</script>
@endsection