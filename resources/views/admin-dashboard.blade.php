<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Dansera</title>

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
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
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

        /* MAIN CONTENT */
        .main {
            flex: 1;
            padding: 35px 40px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            gap: 20px;
        }

        .topbar h1 {
            font-size: 25px;
            font-weight: 600;
            color: #fff;
        }

        .topbar p {
            font-size: 13px;
            color: #9999a5;
            margin-top: 6px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #19191f;
            padding: 10px 16px;
            border: 1px solid #303039;
            border-radius: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #382332;
            color: #ff75a8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-profile strong {
            font-size: 13px;
            display: block;
            color: #fff;
        }

        .admin-profile span {
            font-size: 11px;
            color: #9999a5;
        }

        /* STATISTICS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #19191f;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #303039;
            transition: 0.2s;
        }

        .stat-card:hover {
            border-color: #ff4f91;
            transform: translateY(-3px);
        }

        .stat-card p {
            font-size: 13px;
            color: #9999a5;
            margin-bottom: 12px;
        }

        .stat-card h2 {
            font-size: 30px;
            color: #ff4f91;
            font-weight: 600;
        }

        .stat-icon {
            font-size: 25px;
            color: #ff75a8;
            margin-bottom: 15px;
        }

        /* BOOKING TABLE */
        .booking-section {
            background: #19191f;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #303039;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .section-header h2 {
            font-size: 17px;
            font-weight: 600;
            color: #fff;
        }

        .section-header a {
            color: #ff75a8;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
        }

        .section-header a:hover {
            color: #fff;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .booking-table th {
            text-align: left;
            padding: 13px 12px;
            color: #ff75a8;
            background: #222229;
            font-size: 12px;
            font-weight: 600;
        }

        .booking-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #303039;
            color: #c4c4ce;
            font-size: 12px;
        }

        .booking-table tbody tr:last-child td {
            border-bottom: none;
        }

        .booking-table tbody tr:hover {
            background: #222229;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #9999a5;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                padding: 25px;
            }

            .stats {
                grid-template-columns: 1fr;
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

            .main {
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 20px;
            }

            .topbar h1 {
                font-size: 22px;
            }

            .booking-section {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    @include('partials.admin-sidebar')

    <!-- MAIN CONTENT -->
    <main class="main">

        <div class="topbar">

            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang kembali di Dansera!</p>
            </div>

            <div class="admin-profile">

                <div class="avatar">A</div>

                <div>
                    <strong>Administrator</strong>
                    <span>Admin Dansera</span>
                </div>

            </div>

        </div>

        <!-- STATISTIK -->
        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon">♡</div>
                <p>Total Booking</p>
                <h2>{{ $totalBookings }}</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">▣</div>
                <p>Booking Hari Ini</p>
                <h2>{{ $todayBookings }}</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon">♫</div>
                <p>Total Studio</p>
                <h2>{{ $totalStudios }}</h2>
            </div>

        </div>

        <!-- BOOKING TERBARU -->
        <div class="booking-section">

            <div class="section-header">

                <h2>Booking Terbaru</h2>

                <a href="{{ route('bookings.index') }}">
                    Lihat Semua →
                </a>

            </div>

            @if($recentBookings->isEmpty())

                <div class="empty">
                    Belum ada booking yang masuk.
                </div>

            @else

                <div class="table-wrapper">

                    <table class="booking-table">

                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Studio</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($recentBookings as $booking)

                                <tr>

                                    <td>
                                        {{ $booking->name }}
                                    </td>

                                    <td>
                                        {{ $booking->dancePlace->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ $booking->start_time }}
                                    </td>

                                    <td>
                                        {{ ucfirst($booking->status ?? 'confirmed') }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>
