<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #101014;
            color: #f5f5f7;
            min-height: 100vh;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            background: #17171d;
            border-bottom: 1px solid #292932;
        }

        .logo {
            font-size: 25px;
            font-weight: 700;
            color: #ff4f91;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-link a {
            color: #e5e5e9;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: 0.2s;
        }

        .nav-link a:hover {
            color: #ff4f91;
        }

        .logout-button {
            padding: 10px 18px;
            border: none;
            border-radius: 9px;
            background: #30212b;
            border: 1px solid #593044;
            color: #ff75a8;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .logout-button:hover {
            background: #ff4f91;
            color: white;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .welcome-card {
            position: relative;
            overflow: hidden;
            padding: 55px 50px;
            background: linear-gradient(120deg, #24151f, #19191f 75%);
            border: 1px solid #493044;
            border-radius: 22px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .welcome-card::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 79, 145, 0.09);
            right: -80px;
            top: -100px;
        }

        .welcome-card h1 {
            position: relative;
            z-index: 1;
            margin-bottom: 15px;
            color: #ffffff;
            font-size: 32px;
            line-height: 1.4;
        }

        .welcome-card h1 span {
            color: #ff4f91;
        }

        .welcome-card p {
            position: relative;
            z-index: 1;
            max-width: 600px;
            color: #aaaab5;
            font-size: 14px;
            line-height: 1.8;
        }

        .booking-button {
            position: relative;
            z-index: 1;
            display: inline-block;
            margin-top: 25px;
            padding: 13px 24px;
            background: #ff4f91;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-radius: 10px;
            transition: 0.2s;
        }

        .booking-button:hover {
            background: #e83d7e;
            transform: translateY(-2px);
        }

        .section-title {
            margin-top: 40px;
            margin-bottom: 18px;
            font-size: 20px;
            color: #ffffff;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .feature-card {
            padding: 25px;
            background: #19191f;
            border: 1px solid #292932;
            border-radius: 16px;
            transition: 0.2s;
        }

        .feature-card:hover {
            border-color: #75405a;
            transform: translateY(-4px);
        }

        .feature-card h3 {
            color: #ff75a8;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .feature-card p {
            color: #9999a6;
            font-size: 13px;
            line-height: 1.8;
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #777783;
            font-size: 12px;
            border-top: 1px solid #25252d;
            margin-top: 50px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 16px 5%;
            }

            .logo {
                font-size: 21px;
            }

            .nav-link {
                gap: 12px;
            }

            .nav-link a {
                font-size: 12px;
            }

            .logout-button {
                padding: 9px 12px;
            }

            .container {
                margin: 30px auto;
            }

            .welcome-card {
                padding: 32px 25px;
            }

            .welcome-card h1 {
                font-size: 24px;
            }

            .welcome-card p {
                font-size: 13px;
            }

            .section-title {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">Dansera.</div>

        <div class="nav-link">
            <a href="{{ route('dashboard') }}">Dashboard</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="container">

        <section class="welcome-card">
            <h1>
                Welcome to Dansera,<br>
                <span>{{ auth()->user()->name }}!</span>
            </h1>

            <p>
                Senang melihatmu kembali di Dansera.
                Temukan studio dance favoritmu dan mulai
                perjalanan latihanmu bersama kami.
            </p>

            <a href="{{ route('booking.create') }}" class="booking-button">
                Mulai Booking Studio
            </a>
        </section>

        <h2 class="section-title">Explore Dansera</h2>

        <section class="features">

            <div class="feature-card">
                <h3>Booking Studio</h3>

                <p>
                    Pilih studio dance yang sesuai dengan
                    kebutuhan latihanmu.
                </p>
            </div>

            <div class="feature-card">
                <h3>Jadwal Latihan</h3>

                <p>
                    Atur jadwal latihan agar kegiatan dance
                    kamu lebih terorganisir.
                </p>
            </div>

            <div class="feature-card">
                <h3>Dansera Community</h3>

                <p>
                    Wujudkan kreativitas dan ekspresikan
                    dirimu melalui dance.
                </p>
            </div>

        </section>

    </main>

    <footer>
        © {{ date('Y') }} Dansera. Dance, express, repeat.
    </footer>

</body>
</html>