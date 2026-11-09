<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking | Dansera</title>

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
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #292930;
        }

        .back-arrow {
            text-decoration: none;
            color: #ff4f91;
            font-size: 30px;
            font-weight: bold;
            line-height: 1;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #ff4f91;
        }

        .container {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .header {
            margin-bottom: 30px;
        }

        .top-label {
            color: #ff4f91;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .header p,
        .detail,
        .muted {
            color: #9999a5;
            font-size: 13px;
        }

        .header p span {
            color: #ff75a8;
            font-weight: 600;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success {
            background: #173526;
            color: #8be0ac;
            border: 1px solid #286342;
        }

        .error {
            background: #3a2028;
            color: #ff9eaa;
            border: 1px solid #713440;
        }

        .booking-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 22px;
        }

        .booking-card,
        .empty {
            background: #19191f;
            border: 1px solid #303039;
            border-radius: 16px;
            padding: 25px;
        }

        .booking-card h3 {
            color: #ff75a8;
            font-size: 19px;
            margin-bottom: 18px;
        }

        .detail {
            margin-bottom: 11px;
        }

        .detail strong {
            color: #eeeef2;
            font-weight: 500;
        }

        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 9px;
        }

        .pending {
            background: #3b3020;
            color: #f5c66b;
        }

        .confirmed,
        .paid {
            background: #193728;
            color: #83dca3;
        }

        .cancelled,
        .rejected {
            background: #3a2028;
            color: #ff91a5;
        }

        .unpaid,
        .waiting_verification {
            background: #3b3020;
            color: #f5c66b;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        .btn {
            display: inline-block;
            border: none;
            padding: 10px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-edit,
        .btn-upload,
        .btn-booking {
            background: #ff4f91;
            color: #fff;
        }

        .btn-cancel {
            background: #33232a;
            color: #ff91a5;
            border: 1px solid #713440;
        }

        .payment-box {
            margin-top: 22px;
            padding: 18px;
            border: 1px solid #383841;
            border-radius: 12px;
            background: #151519;
        }

        .payment-box h4 {
            color: #ff75a8;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .qris-image {
            display: block;
            width: 220px;
            max-width: 100%;
            margin: 15px auto;
            padding: 8px;
            background: #fff;
            border-radius: 10px;
        }

        .payment-box input[type="file"] {
            display: block;
            width: 100%;
            margin: 14px 0;
            color: #c4c4ce;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 55px 20px;
        }

        .empty h3 {
            color: #ff75a8;
            font-size: 21px;
            margin-bottom: 10px;
        }

        .empty p {
            color: #9999a5;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .btn-booking {
            padding: 12px 22px;
            border-radius: 10px;
            font-size: 13px;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            nav {
                padding: 17px 6%;
            }

            .container {
                margin: 30px auto;
            }

            .header h1 {
                font-size: 25px;
            }

            .booking-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ route('dashboard') }}" class="back-arrow" title="Kembali ke Beranda">
            &#8592;
        </a>

        <div class="logo">Dansera.</div>
    </nav>

    <div class="container">
        <div class="header">
            <div class="top-label">YOUR ACTIVITY</div>

            <h1>Riwayat Booking</h1>

            <p>
                Hai, <span>{{ Auth::user()->name }}</span>!
                Berikut daftar booking studio dance kamu.
            </p>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if ($bookings->count() > 0)
            <div class="booking-list">
                @foreach ($bookings as $booking)
                    @php
                        $paymentStatus = $booking->payment_status ?? 'unpaid';
                    @endphp

                    <div class="booking-card">
                        <h3>{{ $booking->dancePlace->name ?? 'Studio tidak tersedia' }}</h3>

                        <div class="detail">
                            Tanggal:
                            <strong>{{ $booking->booking_date->format('d-m-Y') }}</strong>
                        </div>

                        <div class="detail">
                            Jam mulai:
                            <strong>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</strong>
                        </div>

                        <div class="detail">
                            Durasi:
                            <strong>{{ $booking->duration }} jam</strong>
                        </div>

                        <div class="detail">
                            Lokasi:
                            <strong>{{ $booking->dancePlace->location ?? '-' }}</strong>
                        </div>

                        <div class="detail">
                            Status booking:
                            <span class="status {{ $booking->status }}">
                                @if ($booking->status === 'pending')
                                    Menunggu konfirmasi
                                @elseif ($booking->status === 'confirmed')
                                    Disetujui
                                @elseif ($booking->status === 'cancelled')
                                    Dibatalkan
                                @else
                                    {{ ucfirst($booking->status) }}
                                @endif
                            </span>
                        </div>

                        @if (
                            $booking->status === 'pending'
                            && $paymentStatus === 'unpaid'
                            && !$booking->payment_proof_path
                        )
                            <div class="actions">
                                <a href="{{ route('bookings.mine.edit', $booking->id) }}"
                                   class="btn btn-edit">
                                    Edit Booking
                                </a>

                                <form action="{{ route('bookings.mine.cancel', $booking->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-cancel">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        @endif

                        @if (in_array($booking->status, ['pending', 'confirmed']))
                            <div class="payment-box">
                                <h4>Pembayaran QRIS</h4>

                                @if ($paymentStatus === 'unpaid' || $paymentStatus === 'rejected')
                                    <p class="muted">
                                        Scan QRIS berikut, lalu unggah bukti transfer.
                                    </p>

                                    <img
                                        src="{{ asset('images/QrisDansera.png') }}"
                                        alt="QRIS Dansera"
                                        class="qris-image"
                                    >

                                    @if ($paymentStatus === 'rejected')
                                        <p class="alert error">
                                            Bukti pembayaran sebelumnya ditolak. Silakan unggah ulang.
                                        </p>
                                    @endif

                                    <form
                                        action="{{ route('bookings.payment.upload', $booking->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >
                                        @csrf

                                        <label for="payment_proof_{{ $booking->id }}" class="muted">
                                            Pilih foto bukti pembayaran (JPG, PNG, atau WEBP; maks. 2 MB)
                                        </label>

                                        <input
                                            id="payment_proof_{{ $booking->id }}"
                                            type="file"
                                            name="payment_proof"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            required
                                        >

                                        <button type="submit" class="btn btn-upload">
                                            Kirim Bukti Pembayaran
                                        </button>
                                    </form>
                                @elseif ($paymentStatus === 'waiting_verification')
                                    <p class="status waiting_verification">
                                        Bukti pembayaran menunggu verifikasi Admin.
                                    </p>
                                @elseif ($paymentStatus === 'paid')
                                    <p class="status paid">
                                        Pembayaran sudah diverifikasi dan lunas.
                                    </p>

                                    @if ($booking->payment_verified_at)
                                        <p class="detail">
                                            Diverifikasi:
                                            <strong>{{ $booking->payment_verified_at->format('d-m-Y H:i') }}</strong>
                                        </p>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <h3>Belum Ada Booking</h3>

                <p>Kamu belum memiliki riwayat booking studio dance.</p>

                <a href="{{ route('booking.create') }}" class="btn-booking">
                    Booking Sekarang
                </a>
            </div>
        @endif
    </div>
</body>
</html>