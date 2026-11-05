
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sportcentrum De Linde</title>

    <style>
        /* Algemene instellingen */
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

        /* Navigatiebalk */
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

        /* Knoppen */
        .button {
            background-color: #1e5bff;
            color: white;
            padding: 12px 22px;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #0a2a66;
        }

        /* Welkomstgedeelte */
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
            display: inline-block;
        }

        /* Informatieblokken */
        .steps {
            padding: 60px 5%;
            text-align: center;
        }

        .steps h2 {
            font-size: 32px;
            margin-bottom: 40px;
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

        .step p {
            line-height: 1.6;
        }

        /* Footer */
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

        /* Mobiele weergave */
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

    <!-- Navigatie -->
    <header>

        <a href="/" class="logo">
            <img src="{{ asset('images/logo-horizontaal.png') }}"
                 alt="Sportcentrum De Linde">
        </a>

        <nav>
            <a href="/">Home</a>
            <a href="/lessen">Lessen</a>
            <a href="/reserveren">Reserveren</a>
            <a href="/over-ons">Over ons</a>
            <a href="/contact">Contact</a>

            <a href="{{ route('login') }}">Inloggen</a>

            <a href="{{ route('register') }}" class="button">
                Account aanmaken
            </a>
        </nav>

    </header>


    <!-- Welkomstgedeelte -->
    <main>

        <section class="hero">

            <h1>Reserveer je les. Kom in beweging!</h1>

            <p>
                Bekijk de lessen van Sportcentrum De Linde,
                schrijf je in en meld je af.
                Alles online, snel en eenvoudig.
            </p>

            <a href="/lessen" class="button">
                Bekijk de lessen
            </a>

        </section>


        <!-- Zo werkt het -->
        <section class="steps" id="zo-werkt-het">

            <h2>Zo werkt het</h2>

            <div class="steps-container">

                <div class="step">
                    <h3>Reserveer een les</h3>
                    <p>
                        Kies een lesmoment dat bij je past
                        en schrijf je in met je eigen account.
                    </p>
                </div>

                <div class="step">
                    <h3>Zit de les vol?</h3>
                    <p>
                        Ga op de wachtlijst.
                        Komt er een plek vrij, dan krijg je een e-mail.
                    </p>
                </div>

                <div class="step">
                    <h3>Afmelden</h3>
                    <p>
                        Kun je niet komen?
                        Annuleer je reservering eenvoudig online.
                    </p>
                </div>

            </div>

        </section>

    </main>


    <!-- Footer -->
    <footer>

        <p>&copy; {{ date('Y') }} Sportcentrum De Linde</p>

        <br>

        <a href="/">Home</a>
        <a href="/lessen">Lessen</a>
        <a href="/reserveren">Reserveren</a>
        <a href="/over-ons">Over ons</a>
        <a href="/contact">Contact</a>

    </footer>

</body>
</html>
