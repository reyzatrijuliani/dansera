<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #101014;
            color: #fff;
        }

        nav {
            background: #151519;
            padding: 18px 8%;
            border-bottom: 1px solid #292930;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #ff4f91;
        }

        .container {
            max-width: 650px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .form-card {
            background: #19191f;
            padding: 35px;
            border-radius: 18px;
            border: 1px solid #303039;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .top-label {
            color: #ff4f91;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        h1 {
            color: #fff;
            font-size: 27px;
            margin-bottom: 8px;
        }

        h1 span {
            color: #ff4f91;
        }

        .subtitle {
            color: #9999a5;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #eeeeF2;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        input,
        select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #383841;
            border-radius: 10px;
            outline: none;
            color: #fff;
            background: #222229;
            font-size: 13px;
            font-family: inherit;
            transition: 0.2s;
        }

        input:focus,
        select:focus {
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
            background: #222229;
            padding: 13px 14px;
            border: 1px solid #383841;
            border-radius: 10px;
            color: #ff80ad;
            font-size: 13px;
        }

        .error {
            color: #ff91a5;
            font-size: 12px;
            margin-top: 7px;
        }

        .alert {
            background: #3a2028;
            color: #ff9eaa;
            padding: 14px;
            border: 1px solid #713440;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        button,
        .btn-back {
            flex: 1;
            padding: 13px;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-family: inherit;
            transition: 0.2s;
        }

        .btn-save {
            background: #ff4f91;
            color: white;
        }

        .btn-save:hover {
            background: #e9367b;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(255, 79, 145, 0.2);
        }

        .btn-back {
            background: #29232a;
            color: #ff80ad;
            border: 1px solid #49313d;
        }

        .btn-back:hover {
            background: #383039;
            color: white;
        }

        @media (max-width: 500px) {
            nav {
                padding: 17px 6%;
            }

            .container {
                margin: 30px auto;
            }

            .form-card {
                padding: 25px 20px;
            }

            h1 {
                font-size: 23px;
            }

            .buttons {
                flex-direction: column-reverse;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">Dansera.</div>
    </nav>

    <div class="container">

        <div class="form-card">

            <div class="top-label">MANAGE YOUR BOOKING</div>

            <h1>Edit <span>Booking.</span></h1>

            <p class="subtitle">
                Perbarui jadwal booking studio dance kamu.
            </p>

            @if($errors->any())
                <div class="alert">
                    <strong>Periksa kembali data kamu:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.mine.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Pemesan</label>

                    <div class="name-display">
                        {{ Auth::user()->name }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="dance_place_id">Pilih Studio</label>

                    <select name="dance_place_id" id="dance_place_id" required>
                        <option value="">-- Pilih Studio --</option>

                        @foreach($dancePlaces as $studio)
                            <option value="{{ $studio->id }}"
                                {{ old('dance_place_id', $booking->dance_place_id) == $studio->id ? 'selected' : '' }}>
                                {{ $studio->name }} - Rp{{ number_format($studio->price_per_hour, 0, ',', '.') }}/jam
                            </option>
                        @endforeach
                    </select>

                    @error('dance_place_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="booking_date">Tanggal Booking</label>

                    <input
                        type="date"
                        name="booking_date"
                        id="booking_date"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}"
                        required
                    >

                    @error('booking_date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_time">Jam Mulai</label>

                    <input
                        type="time"
                        name="start_time"
                        id="start_time"
                        value="{{ old('start_time', \Carbon\Carbon::parse($booking->start_time)->format('H:i')) }}"
                        required
                    >

                    @error('start_time')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Durasi (Jam)</label>

                    <select name="duration" id="duration" required>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"
                                {{ old('duration', $booking->duration) == $i ? 'selected' : '' }}>
                                {{ $i }} Jam
                            </option>
                        @endfor
                    </select>

                    @error('duration')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">
                    <a href="{{ route('bookings.mine') }}" class="btn-back">
                        Kembali
                    </a>

                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>

    </div>

</body>
</html>