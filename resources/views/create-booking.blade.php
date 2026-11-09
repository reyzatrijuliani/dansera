<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Booking | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            font-family: 'Poppins', sans-serif;
            background: #fff5f8;
            color: #4a3440;
        }

        .container {
            max-width: 650px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(230, 150, 180, 0.12);
        }

        .logo {
            color: #d96c98;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        h1 {
            color: #d96c98;
            margin-bottom: 8px;
            font-size: 27px;
        }

        h2 {
            margin-top: 0;
            font-size: 20px;
        }

        p {
            color: #987b89;
            font-size: 14px;
            line-height: 1.7;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #f0cbd5;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            background: #fffafd;
            color: #4a3440;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #d96c98;
            box-shadow: 0 0 0 3px rgba(217, 108, 152, 0.1);
        }

        button,
        .button {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            background: #e88eaf;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            font-family: inherit;
            font-size: 14px;
            transition: 0.2s;
        }

        button:hover,
        .button:hover {
            background: #d96c98;
        }

        .back {
            background: #fce2ec;
            color: #bd5b83;
        }

        .back:hover {
            background: #f5c9dc;
        }

        .error {
            color: #c62828;
            font-size: 13px;
            margin-top: 6px;
        }

        .alert-error {
            background: #fff0f0;
            color: #b42335;
            border: 1px solid #f3b7bd;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .alert-success {
            background: #e8f8ee;
            color: #287a49;
            border: 1px solid #b7e6c7;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .empty-studio {
            padding: 15px;
            background: #fff5f8;
            color: #987b89;
            border-radius: 10px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container {
                padding: 22px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="logo">
            dansera ♡
        </div>

        <h1>Tambah Booking Studio</h1>

        <p>
            Admin dapat menambahkan data booking studio dance melalui form berikut.
        </p>

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="alert-error">
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
                Silakan tambahkan studio terlebih dahulu.
            </div>
        @else
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                {{-- Nama Pemesan --}}
                <label for="name">Nama Pemesan</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama pemesan"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Pilih Studio --}}
                <label for="dance_place_id">Pilih Studio</label>

                <select
                    id="dance_place_id"
                    name="dance_place_id"
                    required
                >
                    <option value="">-- Pilih Studio --</option>

                    @foreach ($dancePlaces as $dancePlace)
                        <option
                            value="{{ $dancePlace->id }}"
                            {{ old('dance_place_id') == $dancePlace->id ? 'selected' : '' }}
                        >
                            {{ $dancePlace->name }}
                            - Rp{{ number_format($dancePlace->price_per_hour, 0, ',', '.') }}/jam
                        </option>
                    @endforeach
                </select>

                @error('dance_place_id')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Tanggal Booking --}}
                <label for="booking_date">Tanggal Booking</label>

                <input
                    type="date"
                    id="booking_date"
                    name="booking_date"
                    value="{{ old('booking_date') }}"
                    min="{{ date('Y-m-d') }}"
                    required
                >

                @error('booking_date')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Jam Mulai --}}
                <label for="start_time">Jam Mulai</label>

                <input
                    type="time"
                    id="start_time"
                    name="start_time"
                    value="{{ old('start_time') }}"
                    required
                >

                @error('start_time')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Durasi --}}
                <label for="duration">Durasi Booking</label>

                <select
                    id="duration"
                    name="duration"
                    required
                >
                    <option value="">-- Pilih Durasi --</option>

                    @for ($i = 1; $i <= 12; $i++)
                        <option
                            value="{{ $i }}"
                            {{ old('duration') == $i ? 'selected' : '' }}
                        >
                            {{ $i }} jam
                        </option>
                    @endfor
                </select>

                @error('duration')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Status --}}
                <label for="status">Status Booking</label>

                <select
                    id="status"
                    name="status"
                    required
                >
                    <option value="">-- Pilih Status --</option>

                    <option
                        value="pending"
                        {{ old('status') == 'pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="confirmed"
                        {{ old('status') == 'confirmed' ? 'selected' : '' }}
                    >
                        Confirmed
                    </option>

                    <option
                        value="cancelled"
                        {{ old('status') == 'cancelled' ? 'selected' : '' }}
                    >
                        Cancelled
                    </option>
                </select>

                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror

                {{-- Tombol --}}
                <div class="buttons">
                    <button type="submit">
                        Simpan Booking
                    </button>

                    <a
                        href="{{ route('bookings.index') }}"
                        class="button back"
                    >
                        Kembali
                    </a>
                </div>
            </form>
        @endif

    </div>
</body>
</html>