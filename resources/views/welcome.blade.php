<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sportcentrum De Linde</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #0a2a66;
        }

        a {
            text-decoration: none;
        }

        header {
            background-color: white;
            padding: 15px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #e8f0ff;
        }

        .logo img {
            height: 55px;
            width: auto;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        nav a {
            color: #0a2a66;
            font-weight: bold;
        }

        nav a:hover {
            color: #1e5bff;
        }

        .logout-form {
            display: inline;
        }

        .logout-button {
            border: 0;
            background: transparent;
            color: #0a2a66;
            cursor: pointer;
            font: inherit;
            font-weight: bold;
        }

        .logout-button:hover {
            color: #1e5bff;
        }

        .button {
            display: inline-block;
            background-color: #1e5bff;
            color: white;
            padding: 12px 22px;
            border: 0;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0a2a66;
            color: white;
        }

        .hero {
            background: linear-gradient(120deg, #0a2a66, #1e5bff);
            color: white;
            padding: 100px 8%;
            text-align: left;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 900;
            text-transform: uppercase;
            max-width: 650px;
            margin-bottom: 20px;
            font-style: italic;
        }

        .hero p {
            font-size: 19px;
            max-width: 550px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .hero .button {
            background-color: white;
            color: #0a2a66;
        }

        .steps,
        .info-section {
            padding: 60px 5%;
            text-align: center;
        }

        .steps h2,
        .info-section h2 {
            font-size: 32px;
            margin-bottom: 24px;
        }

        .steps-container {
            display: flex;
            gap: 25px;
            justify-content: center;
        }

        .step {
            background-color: #e8f0ff;
            padding: 30px;
            border-radius: 12px;
            flex: 1;
        }

        .step h3 {
            color: #1e5bff;
            margin-bottom: 15px;
        }

        .step p,
        .info-section p {
            line-height: 1.6;
        }

        .info-section {
            background-color: #f5f8ff;
        }

        footer {
            background-color: #0a2a66;
            color: white;
            padding: 35px 5%;
            text-align: center;
        }

        footer a {
            color: white;
            margin: 0 10px;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 20px;
            }

            nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .hero h1 {
                font-size: 34px;
            }

            .steps-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <a href="/" class="logo">
            <img
                src="{{ asset('images/logo-horizontaal.png') }}"
                alt="Sportcentrum De Linde">
        </a>

        <nav>
            <a href="/">Home</a>
            <a href="#over-ons">Over ons</a>
            <a href="#contact">Contact</a>

            @auth
                @if (auth()->user()->role === 'begeleider')
                    <a href="{{ route('begeleider.dashboard') }}">Mijn rooster</a>
                @else
                    <a href="{{ route('lessen.index') }}">Lessen</a>

                    @if (auth()->user()->role === 'gebruiker')
                        <a href="{{ route('lessen.mijn-inschrijvingen') }}">Mijn inschrijvingen</a>
                    @endif

                    @if (auth()->user()->role === 'admin' || auth()->user()->rol === 'beheerder')
                        <a href="{{ route('lessen.aanmaken') }}">Les aanmaken</a>
                    @endif
                @endif

                <form class="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-button" type="submit">
                        Uitloggen ({{ auth()->user()->name }})
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Inloggen</a>
                <a href="{{ route('register') }}" class="button">Account aanmaken</a>
            @endauth
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Schrijf je in voor een les. Kom in beweging!</h1>

            <p>
                Bekijk de lessen van Sportcentrum De Linde en vind een les
                die bij jou past.
            </p>

            @auth
                @if (auth()->user()->role === 'begeleider')
                    <a href="{{ route('begeleider.dashboard') }}" class="button">
                        Bekijk mijn rooster
                    </a>
                @else
                    <a href="{{ route('lessen.index') }}" class="button">
                        Bekijk de lessen
                    </a>
                @endif
            @else
                <a href="{{ route('lessen.index') }}" class="button">
                    Bekijk de lessen
                </a>
            @endauth
        </section>

        <section class="steps" id="zo-werkt-het">
            <h2>Zo werkt het</h2>

            <div class="steps-container">
                <div class="step">
                    <h3>Schrijf je in voor een les</h3>
                    <p>Kies een lesmoment dat bij je past en schrijf je in met je account.</p>
                </div>

                <div class="step">
                    <h3>Zit de les vol?</h3>
                    <p>Ga op de wachtlijst. Komt er een plek vrij, dan krijg je een e-mail.</p>
                </div>

                <div class="step">
                    <h3>Afmelden</h3>
                    <p>Kun je niet komen? Annuleer je inschrijving eenvoudig online.</p>
                </div>
            </div>
        </section>

        <section class="info-section" id="over-ons">
            <h2>Over ons</h2>
            <p>
                Sportcentrum De Linde helpt je om actief te blijven en lessen te
                vinden die bij jou passen. Bekijk het lesaanbod en ontdek wat bij
                jouw sportdoelen aansluit.
            </p>
        </section>

        <section class="info-section" id="contact">
            <h2>Contact</h2>
            <p>
                Heb je een vraag over lessen, je rooster of een inschrijving?
                Neem contact op met de balie van Sportcentrum De Linde.
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Sportcentrum De Linde</p>
        <br>
        <a href="/">Home</a>
        <a href="#over-ons">Over ons</a>
        <a href="#contact">Contact</a>
    </footer>
</body>
</html>