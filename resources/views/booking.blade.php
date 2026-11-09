<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Studio | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 45px 20px;
            font-family: 'Poppins', sans-serif;
            background: #101014;
            color: #fff;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 35px;
            background: #19191f;
            border: 1px solid #303039;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.25);
        }

        .top-label {
            text-align: center;
            color: #ff4f91;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        h1 {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }

        h1 span {
            color: #ff4f91;
        }

        .subtitle {
            text-align: center;
            color: #9999a5;
            font-size: 13px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 20px;
            margin-bottom: 9px;
            color: #eeeeF2;
            font-size: 13px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #383841;
            border-radius: 10px;
            background: #222229;
            color: #fff;
            font-size: 14px;
            font-family: inherit;
            transition: 0.2s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #ff4f91;
            box-shadow: 0 0 0 3px rgba(255, 79, 145, 0.12);
        }

        input[type="date"],
        input[type="time"] {
            color-scheme: dark;
        }

        select option {
            background: #222229;
            color: #fff;
        }

        .name-display {
            padding: 14px;
            border: 1px solid #383841;
            border-radius: 10px;
            background: #222229;
            color: #ff80ad;
            font-size: 14px;
        }

        button {
            width: 100%;
            margin-top: 30px;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: #ff4f91;
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s;
        }

        button:hover {
            background: #e9367b;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(255, 79, 145, 0.2);
        }

        .alert {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 13px;
        }

        .alert-success {
            background: #173526;
            color: #8be0ac;
            border: 1px solid #286342;
        }

        .alert-danger {
            background: #3a2028;
            color: #ff9eaa;
            border: 1px solid #713440;
        }

        .alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .empty-studio {
            text-align: center;
            padding: 20px;
            background: #222229;
            border: 1px solid #383841;
            border-radius: 12px;
            color: #aaaab5;
            font-size: 13px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 23px;
            color: #ff75a8;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .back-link:hover {
            color: #fff;
        }

        @media (max-width: 500px) {
            body {
                padding: 25px 14px;
            }

            .container {
                padding: 25px 20px;
            }

            h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="top-label">DANSERA STUDIO</div>

        <h1>Book Your <span>Studio.</span></h1>

        <p class="subtitle">
            Atur jadwal latihan dance kamu sekarang.
        </p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Booking gagal!</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($dancePlaces->isEmpty())
            <div class="empty-studio">
                Belum ada studio yang tersedia.
                Silakan coba lagi nanti.
            </div>
        @else
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <label>Nama Pemesan</label>

                <div class="name-display">
                    {{ Auth::user()->name }}
                </div>

                <label for="dance_place_id">Pilih Studio</label>

                <select id="dance_place_id" name="dance_place_id" required>
                    <option value="">-- Pilih Studio --</option>

                    @foreach ($dancePlaces as $studio)
                        <option
                            value="{{ $studio->id }}"
                            {{ old('dance_place_id') == $studio->id ? 'selected' : '' }}
                        >
                            {{ $studio->name }}
                            - Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }}/jam
                        </option>
                    @endforeach
                </select>

                <label for="booking_date">Tanggal Booking</label>

                <input
                    type="date"
                    id="booking_date"
                    name="booking_date"
                    min="{{ date('Y-m-d') }}"
                    value="{{ old('booking_date') }}"
                    required
                >

                <label for="start_time">Jam Mulai</label>

                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    value="{{ old('start_time') }}"
                    required
                >

                <label for="duration">Durasi (Jam)</label>

                <select id="duration" name="duration" required>
                    <option value="">-- Pilih Durasi --</option>

                    @for ($i = 1; $i <= 12; $i++)
                        <option
                            value="{{ $i }}"
                            {{ old('duration') == $i ? 'selected' : '' }}
                        >
                            {{ $i }} Jam
                        </option>
                    @endfor
                </select>

                <button type="submit">
                    Booking Sekarang
                </button>
            </form>
        @endif

        <a href="{{ route('dashboard') }}" class="back-link">
            ← Kembali ke Beranda
        </a>

    </div>
</body>
</html>