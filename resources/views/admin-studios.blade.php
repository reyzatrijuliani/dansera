<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Studio | Dansera</title>

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
            padding: 35px 40px;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .header h1 {
            color: #ffffff;
            font-size: 30px;
            font-weight: 700;
        }

        .header p {
            color: #9999a6;
            margin-top: 8px;
            font-size: 14px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-add {
            background: #ff4f91;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(255, 79, 145, 0.15);
        }

        .btn-add:hover {
            background: #e83d7e;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #30212b;
            color: #ff75a8;
            border: 1px solid #593044;
        }

        .btn-edit:hover {
            background: #493044;
        }

        .btn-delete {
            background: #352027;
            color: #ff7188;
            border: 1px solid #63303d;
        }

        .btn-delete:hover {
            background: #512632;
        }

        .table-wrapper {
            background: #19191f;
            border: 1px solid #292932;
            border-radius: 18px;
            overflow-x: auto;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        thead {
            background: #222229;
        }

        th {
            color: #ff75a8;
            font-size: 12px;
            font-weight: 600;
            text-align: left;
            padding: 18px 20px;
            letter-spacing: 0.3px;
        }

        td {
            padding: 18px 20px;
            border-bottom: 1px solid #292932;
            vertical-align: middle;
            color: #d1d1d8;
            font-size: 13px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #202027;
        }

        td strong {
            color: #ffffff;
            font-weight: 600;
        }

        .price {
            color: #ff75a8;
            font-weight: 600;
            white-space: nowrap;
        }

        .description {
            max-width: 250px;
            line-height: 1.6;
            color: #a5a5b0;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .actions form {
            display: inline;
        }

        .actions .btn {
            padding: 9px 14px;
            font-size: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #9999a6;
            line-height: 2;
        }

        .success {
            background: #192c25;
            color: #8be0ad;
            border: 1px solid #315b43;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .error {
            background: #351f29;
            color: #ff829d;
            border: 1px solid #633344;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                padding: 25px;
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

            .header h1 {
                font-size: 24px;
            }

            .header {
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                text-align: center;
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
                <div>
                    <h1>Kelola Studio</h1>
                    <p>Atur dan kelola studio dance yang tersedia.</p>
                </div>

                <a href="{{ route('admin.studios.create') }}" class="btn btn-add">
                    + Tambah Studio
                </a>
            </div>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Studio</th>
                            <th>Lokasi</th>
                            <th>Harga/Jam</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($dancePlaces as $studio)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $studio->name }}</strong>
                                </td>

                                <td>{{ $studio->location }}</td>

                                <td class="price">
                                    Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }}
                                </td>

                                <td class="description">
                                    {{ $studio->description }}
                                </td>

                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.studios.edit', $studio->id) }}"
                                           class="btn btn-edit">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.studios.destroy', $studio->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus studio {{ $studio->name }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    Belum ada studio yang ditambahkan.
                                    <br>
                                    Klik tombol Tambah Studio untuk memulai.
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