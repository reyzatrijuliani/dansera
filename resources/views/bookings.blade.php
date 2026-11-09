<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #101014;
            color: #fff;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #151519;
            padding: 30px 20px;
            border-right: 1px solid #292930;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .logo {
            font-size: 27px;
            font-weight: 700;
            color: #ff4f91;
            text-decoration: none;
            margin-bottom: 45px;
        }

        .menu-title {
            font-size: 11px;
            color: #777783;
            font-weight: 600;
            margin: 0 12px 15px;
            letter-spacing: 1.5px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            border-radius: 10px;
            text-decoration: none;
            color: #a0a0ab;
            font-size: 13px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #30212a;
            color: #ff75a8;
        }

        .menu a span {
            font-size: 18px;
        }

        .logout {
            margin-top: auto;
        }

        .main {
            flex: 1;
            min-width: 0;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
                border-right: none;
                border-bottom: 1px solid #292930;
            }

            .logo {
                margin-bottom: 20px;
            }

            .menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .menu a {
                padding: 10px 12px;
                font-size: 12px;
            }

            .logout {
                margin-top: 15px;
            }
        }
        .container {
            width: 90%;
            max-width: 1400px;
            margin: 45px auto;
        }

        .top-label {
            color: #ff4f91;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 30px;
        }

        .header h1 span {
            color: #ff4f91;
        }

        .header p {
            color: #9999a5;
            margin-top: 8px;
            font-size: 13px;
        }

        .table-wrapper {
            background: #19191f;
            border: 1px solid #303039;
            border-radius: 16px;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        th {
            text-align: left;
            padding: 15px 12px;
            color: #ff75a8;
            font-size: 12px;
            font-weight: 600;
            background: #222229;
            white-space: nowrap;
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #303039;
            font-size: 12px;
            color: #c4c4ce;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #222229;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending,
        .status-unpaid,
        .status-waiting_verification {
            background: #3b3020;
            color: #f5c66b;
        }

        .status-confirmed,
        .status-paid {
            background: #193728;
            color: #83dca3;
        }

        .status-cancelled,
        .status-rejected {
            background: #3a2028;
            color: #ff91a5;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-edit {
            background: #ff4f91;
            color: #fff;
        }

        .btn-delete {
            background: #33232a;
            color: #ff91a5;
            border: 1px solid #713440;
        }

        .btn-proof {
            background: #26384a;
            color: #c9e2ff;
        }

        .btn-paid {
            background: #193728;
            color: #83dca3;
        }

        .btn-reject {
            background: #3a2028;
            color: #ff91a5;
        }

        .payment-actions {
            display: flex;
            flex-direction: column;
            gap: 7px;
            min-width: 135px;
        }

        .success,
        .error {
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

        .error ul {
            padding-left: 20px;
            margin-top: 8px;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #9999a5;
        }

        @media (max-width: 600px) {
            .container {
                width: 94%;
                margin: 30px auto;
            }

            .header h1 {
                font-size: 24px;
            }



            .table-wrapper {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="layout">
        @include('partials.admin-sidebar')

        <main class="main">
    <div class="container">
        <div class="header">
            <div class="top-label">ADMIN MANAGEMENT</div>

            <h1>Daftar <span>Booking.</span></h1>

            <p>Pantau booking dan verifikasi pembayaran User.</p>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                <strong>Terjadi kesalahan!</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Email Akun</th>
                        <th>Studio</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Durasi</th>
                        <th>Status Booking</th>
                        <th>Status Pembayaran</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($bookings as $booking)
                        @php
                            $bookingStatus = $booking->status ?? 'pending';
                            $paymentStatus = $booking->payment_status ?? 'unpaid';
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $booking->name }}</td>

                            <td>{{ $booking->user->email ?? 'Booking lama' }}</td>

                            <td>{{ $booking->dancePlace->name ?? '-' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                            </td>

                            <td>{{ $booking->duration }} jam</td>

                            <td>
                                <span class="status status-{{ $bookingStatus }}">
                                    {{ ucfirst($bookingStatus) }}
                                </span>
                            </td>

                            <td>
                                <span class="status status-{{ $paymentStatus }}">
                                    {{ str_replace('_', ' ', ucfirst($paymentStatus)) }}
                                </span>
                            </td>

                            <td>
                                @if ($booking->payment_proof_path)
                                    <a
                                        href="{{ route('bookings.payment-proof', $booking->id) }}"
                                        target="_blank"
                                        class="btn btn-proof"
                                    >
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>

                            <td>
                                <div class="payment-actions">
                                    @if ($paymentStatus === 'waiting_verification')
                                        <form
                                            action="{{ route('bookings.payment.review', $booking->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                name="payment_status"
                                                value="paid"
                                                class="btn btn-paid"
                                            >
                                                Verifikasi Lunas
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('bookings.payment.review', $booking->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tolak bukti pembayaran ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                name="payment_status"
                                                value="rejected"
                                                class="btn btn-reject"
                                            >
                                                Tolak Bukti
                                            </button>
                                        </form>
                                    @endif

                                    <a
                                        href="{{ route('bookings.edit', $booking->id) }}"
                                        class="btn btn-edit"
                                    >
                                        Edit Booking
                                    </a>

                                    <form
                                        action="{{ route('bookings.destroy', $booking->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus booking ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus Booking
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="empty">
                                Belum ada booking studio.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
        </main>
    </div>
</body>
</html>
