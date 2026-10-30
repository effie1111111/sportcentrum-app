<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportcentrum De Linde</title>

    <style>
        :root {
            --navy: #0a2a66;
            --blue: #1e5bff;
            --sky: #e8f0ff;
            --ink: #0b1b3a;
            --white: #ffffff;
            --font-display: "Arial Black", "Helvetica Neue", Arial, sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--ink);
            line-height: 1.5;
        }

        a { color: inherit; text-decoration: none; }
        a:focus-visible { outline: 3px solid var(--blue); outline-offset: 3px; }

        .wrap { max-width: 1100px; margin: 0 auto; padding: 0 24px; }

        /* Titels: zelfde stijl op alle plekken */
        .logo-name, h1, h2 {
            font-family: var(--font-display);
            font-style: italic;
            font-weight: 900;
            color: var(--navy);
        }

        /* ---------- Header ---------- */
        .topbar { border-bottom: 1px solid var(--sky); }
        .topbar .wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
        }

        .logo { display: flex; align-items: center; gap: 12px; }
        .logo img { height: 52px; }
        .logo-name { font-size: 18px; line-height: 1.1; }

        .nav { display: flex; align-items: center; gap: 24px; font-weight: 600; }
        .nav a:hover { color: var(--blue); }

        /* ---------- Knoppen ---------- */
        .btn {
            display: inline-block;
            padding: 12px 26px;
            font-weight: 800;
            border: 2px solid var(--white);
            border-radius: 4px;
        }
        .btn-blue { background: var(--blue); color: var(--white); border-color: var(--blue); }
        .btn-blue:hover { background: var(--navy); color: var(--white); }
        .btn-white { background: var(--white); color: var(--navy); }
        .btn-white:hover { background: var(--sky); color: var(--navy); }
        .btn-line { color: var(--white); }
        .btn-line:hover { background: var(--white); color: var(--navy); }

        /* ---------- Hero ---------- */
        .hero {
            background: linear-gradient(135deg, var(--navy), var(--blue));
            color: var(--white);
            padding: 96px 0 150px;
            clip-path: polygon(0 0, 100% 0, 100% 82%, 0 100%);
        }
        .hero h1 {
            color: var(--white);
            text-transform: uppercase;
            font-size: clamp(2.4rem, 7vw, 5rem);
            line-height: 1;
            max-width: 12ch;
        }
        .hero p { margin-top: 24px; max-width: 46ch; font-size: 1.15rem; color: #dce7ff; }
        .actions { margin-top: 36px; display: flex; flex-wrap: wrap; gap: 16px; }

        /* ---------- Zo werkt het ---------- */
        .steps { padding: 40px 0 80px; }
        .steps h2 { font-size: clamp(1.6rem, 4vw, 2.4rem); margin-bottom: 36px; }
        .steps-grid { display: grid; grid-template-columns: repeat(3, 1fr); }
        .step { padding: 8px 32px; border-left: 4px solid var(--blue); }
        .step h3 { font-size: 1.2rem; color: var(--navy); margin-bottom: 8px; }
        .step p { color: #3a4a6b; }

        /* ---------- Footer ---------- */
        .footer { background: var(--navy); color: #c7d6ff; padding: 28px 0; }

        @media (max-width: 760px) {
            .hide-sm, .logo-name { display: none; }
            .hero { padding: 64px 0 110px; }
            .steps-grid { grid-template-columns: 1fr; gap: 28px; }
        }
    </style>
</head>
<body>

    <header class="topbar">
        <div class="wrap">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sportcentrum De Linde">
                <span class="logo-name">Sportcentrum<br>De Linde</span>
            </a>

            <nav class="nav">
                <a href="#zo-werkt-het" class="hide-sm">Zo werkt het</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-blue">Mijn omgeving</a>
                @else
                    <a href="{{ route('login') }}">Inloggen</a>
                    <a href="{{ route('register') }}" class="btn btn-blue">Account aanmaken</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="wrap">
                <h1>Reserveer je les. Kom in beweging.</h1>
                <p>Bekijk de lessen van Sportcentrum De Linde, schrijf je in en meld je af. Alles online, geen schriftjes meer.</p>

                <div class="actions">
                    <a href="{{ route('register') }}" class="btn btn-white">Account aanmaken</a>
                    <a href="{{ route('login') }}" class="btn btn-line">Inloggen</a>
                </div>
            </div>
        </section>

        <section class="steps" id="zo-werkt-het">
            <div class="wrap">
                <h2>Zo werkt het</h2>
                <div class="steps-grid">
                    <div class="step">
                        <h3>Reserveer een les</h3>
                        <p>Kies een lesmoment dat je past en schrijf je in met je eigen account.</p>
                    </div>
                    <div class="step">
                        <h3>Zit de les vol?</h3>
                        <p>Ga op de wachtlijst. Komt er een plek vrij, dan krijg je een e-mail.</p>
                    </div>
                    <div class="step">
                        <h3>Afmelden tot 2 uur van tevoren</h3>
                        <p>Kun je niet? Annuleer je reservering vanuit je overzicht.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="wrap">&copy; {{ date('Y') }} Sportcentrum De Linde</div>
    </footer>

</body>
</html>