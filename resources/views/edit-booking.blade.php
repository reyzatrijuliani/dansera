<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Booking | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: 'Poppins', sans-serif;
            background: #101014;
            color: #ffffff;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            padding: 35px;
            background: #19191f;
            border: 1px solid #2b2b34;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
        }

        .logo {
            color: #ff4f91;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        h1 {
            color: #ffffff;
            font-size: 25px;
            margin-bottom: 8px;
        }

        p {
            color: #9999a5;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 13px;
            color: #eeeeee;
        }

        input, select {
            width: 100%;
            padding: 13px;
            border: 1px solid #363640;
            border-radius: 10px;
            font-size: 13px;
            font-family: inherit;
            background: #222229;
            color: #ffffff;
            transition: 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #ff4f91;
            box-shadow: 0 0 0 3px rgba(255, 79, 145, 0.12);
        }

        input::placeholder {
            color: #777782;
        }

        select option {
            background: #222229;
            color: #ffffff;
        }

        button, .back {
            display: inline-block;
            margin-top: 28px;
            padding: 13px 20px;
            border: 0;
            border-radius: 10px;
            background: #ff4f91;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #ed347b;
            transform: translateY(-1px);
        }

        .back {
            background: #303039;
            color: #eeeeee;
            margin-left: 8px;
        }

        .back:hover {
            background: #41414c;
        }

        .error {
            color: #ff8ba9;
            font-size: 12px;
            margin-top: 6px;
        }

        .alert-error {
            background: #382027;
            color: #ff8ba9;
            border: 1px solid #713044;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .alert-error ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .alert-success {
            background: #1d3429;
            color: #8be0a5;
            border: 1px solid #315c42;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 24px;
            }

            h1 {
                font-size: 22px;
            }

            button, .back {
                margin-top: 20px;
            }

            .back {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="logo">Dansera.</div>

        <h1>Edit Booking Studio</h1>

        <p>Perbarui detail booking studio dance.</p>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <strong>Periksa kembali data booking:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">Nama Pemesan</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $booking->name) }}"
                placeholder="Masukkan nama pemesan"
                required
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="dance_place_id">Pilih Studio</label>
            <select id="dance_place_id" name="dance_place_id" required>
                <option value="">-- Pilih Studio --</option>

                @foreach ($dancePlaces as $place)
                    <option
                        value="{{ $place->id }}"
                        {{ old('dance_place_id', $booking->dance_place_id) == $place->id ? 'selected' : '' }}
                    >
                        {{ $place->name }} -
                        Rp{{ number_format($place->price_per_hour, 0, ',', '.') }}/jam
                    </option>
                @endforeach
            </select>
            @error('dance_place_id')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="booking_date">Tanggal Booking</label>
            <input
                id="booking_date"
                name="booking_date"
                type="date"
                value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}"
                required
            >
            @error('booking_date')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="start_time">Jam Mulai</label>
            <input
                id="start_time"
                name="start_time"
                type="time"
                value="{{ old('start_time', substr($booking->start_time, 0, 5)) }}"
                required
            >
            @error('start_time')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="duration">Durasi Booking (Jam)</label>
            <select id="duration" name="duration" required>
                <option value="">-- Pilih Durasi --</option>

                @for ($i = 1; $i <= 12; $i++)
                    <option
                        value="{{ $i }}"
                        {{ old('duration', $booking->duration) == $i ? 'selected' : '' }}
                    >
                        {{ $i }} jam
                    </option>
                @endfor
            </select>
            @error('duration')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="status">Status Booking</label>
            <select id="status" name="status" required>
                <option value="pending"
                    {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="confirmed"
                    {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>
                    Confirmed
                </option>

                <option value="cancelled"
                    {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">
                Simpan Perubahan
            </button>

            <a class="back" href="{{ route('bookings.index') }}">
                Kembali
            </a>

        </form>
    </div>
</body>
</html>