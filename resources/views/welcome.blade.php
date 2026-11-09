<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dansera | Booking Studio Dance</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #101014;
            color: #ffffff;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 8%;
            background: #151519;
            border-bottom: 1px solid #29232d;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            color: #ff4f91;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        nav a {
            text-decoration: none;
            color: #eeeeee;
            margin-left: 22px;
            font-size: 14px;
            transition: 0.3s;
        }

        nav a:hover {
            color: #ff4f91;
        }

        .logout-btn {
            background: #ff4f91;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            margin-left: 22px;
            transition: 0.3s;
        }

        .logout-btn:hover,
        .btn:hover {
            background: #e9367c;
            transform: translateY(-2px);
        }

        /* HERO */
        .hero {
            min-height: 540px;
            display: flex;
            align-items: center;
            padding: 90px 8%;
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    90deg,
                    rgba(10, 10, 14, 0.96) 0%,
                    rgba(10, 10, 14, 0.78) 50%,
                    rgba(10, 10, 14, 0.35) 100%
                ),
                url("{{ asset('images/BackgroundDashboard(hero).jpg') }}");

            background-size: cover;
            background-position: center;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 680px;
        }

        .hero-label {
            display: inline-block;
            color: #ff70a7;
            background: rgba(255, 79, 145, 0.13);
            border: 1px solid rgba(255, 79, 145, 0.3);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: clamp(38px, 6vw, 65px);
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: #ff4f91;
        }

        .hero p {
            font-size: 16px;
            line-height: 1.8;
            color: #d0cbd2;
            max-width: 530px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background: #ff4f91;
            color: white;
            padding: 13px 25px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
        }

        /* STUDIO SECTION */
        .section {
            padding: 75px 8%;
        }

        .section h2 {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .section-subtitle {
            color: #aaa3ae;
            font-size: 14px;
            line-height: 1.7;
        }

        .section-title span {
            color: #ff4f91;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-top: 35px;
        }

        .card {
            background: #19191f;
            border: 1px solid #302a35;
            border-radius: 16px;
            overflow: hidden;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-6px);
            border-color: #ff4f91;
            box-shadow: 0 12px 30px rgba(255, 79, 145, 0.10);
        }

        .card-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
            display: block;
        }

        .card-content {
            padding: 23px;
        }

        .card h3 {
            font-size: 19px;
            margin-bottom: 10px;
        }

        .card p {
            color: #aaa3ae;
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        /* BOOKING SECTION */
        .booking-section {
            margin: 20px 8% 75px;
            padding: 55px 40px;
            text-align: center;
            border-radius: 18px;
            background: linear-gradient(
                120deg,
                #21151e,
                #321727
            );
            border: 1px solid #492239;
        }

        .booking-section h2 {
            font-size: 30px;
            margin-bottom: 12px;
        }

        .booking-section p {
            color: #c8bac4;
            font-size: 14px;
            margin-bottom: 25px;
        }

        footer {
            text-align: center;
            padding: 25px;
            background: #151519;
            color: #aaa3ae;
            border-top: 1px solid #29232d;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            nav {
                padding: 20px 6%;
            }

            nav > div:last-child {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 12px;
            }

            nav a {
                margin-left: 0;
                font-size: 12px;
            }

            .logout-btn {
                margin-left: 0;
            }

            .hero {
                min-height: 480px;
                padding: 75px 6%;
                background-position: center;
            }

            .hero h1 {
                font-size: 39px;
            }

            .section {
                padding: 55px 6%;
            }

            .section h2 {
                font-size: 26px;
            }

            .booking-section {
                margin: 10px 6% 55px;
                padding: 40px 20px;
            }

            .booking-section h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">dansera.</div>

        <div>
            <a href="#home">Home</a>
            <a href="#studio">Studio</a>
            <a href="{{ route('booking.create') }}">Booking</a>
            <a href="{{ route('bookings.mine') }}">Riwayat Booking</a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="hero-content">

            <div class="hero-label">
                YOUR SPACE, YOUR RHYTHM
            </div>

            <h1>
                Find Your Rhythm,<br>
                <span>Own The Stage.</span>
            </h1>

            <p>
                Temukan studio dance favoritmu, pilih jadwal latihan,
                dan booking ruang latihan dengan mudah bersama Dansera.
            </p>

            <a class="btn" href="{{ route('booking.create') }}">
                Mulai Booking
            </a>

        </div>
    </section>

    <section class="section" id="studio">

        <h2 class="section-title">
            Temukan <span>Studio</span> Pilihanmu
        </h2>

        <p class="section-subtitle">
            Pilih ruang yang cocok untuk latihan dan kembangkan bakatmu.
        </p>

        <div class="cards">

            <!-- STUDIO BEGINNER -->
            <div class="card">
                <img
                    class="card-image"
                    src="{{ asset('images/StudioBeginner.jpg') }}"
                    alt="Studio Beginner"
                >

                <div class="card-content">
                    <h3>Studio Beginner</h3>
                    <p>
                        Ruang nyaman untuk belajar koreografi
                        dan latihan dasar.
                    </p>

                    <a class="btn" href="{{ route('booking.create') }}">
                        Booking Studio
                    </a>
                </div>
            </div>

            <!-- STUDIO PREMIUM -->
            <div class="card">
                <img
                    class="card-image"
                    src="{{ asset('images/StudioPremium.jpg') }}"
                    alt="Studio Premium"
                >

                <div class="card-content">
                    <h3>Studio Premium</h3>
                    <p>
                        Ruang luas dengan cermin untuk
                        latihan bersama tim.
                    </p>

                    <a class="btn" href="{{ route('booking.create') }}">
                        Booking Studio
                    </a>
                </div>
            </div>

            <!-- STUDIO PRACTICE -->
            <div class="card">
                <img
                    class="card-image"
                    src="{{ asset('images/StudioPractice.jpg') }}"
                    alt="Studio Practice"
                >

                <div class="card-content">
                    <h3>Studio Practice</h3>
                    <p>
                        Tempat latihan koreografi dan
                        persiapan penampilan.
                    </p>

                    <a class="btn" href="{{ route('booking.create') }}">
                        Booking Studio
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section class="booking-section" id="booking">
        <h2>Ready to <span style="color: #ff4f91;">Dance?</span></h2>

        <p>
            Jadwalkan latihanmu dan mulai pengalaman dance bersama Dansera.
        </p>

        <a class="btn" href="{{ route('booking.create') }}">
            Booking Sekarang
        </a>
    </section>

    <footer>
        &copy; 2026 Dansera. Dance your way.
    </footer>

</body>
</html>