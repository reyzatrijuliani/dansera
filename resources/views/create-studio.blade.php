<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Studio | Dansera</title>

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

        nav {
            background: #17171d;
            padding: 18px 8%;
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #292932;
        }

        .back-button {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #24242c;
            color: #ff4f91;
            border: 1px solid #38313a;
            border-radius: 12px;
            font-size: 24px;
            text-decoration: none;
            transition: 0.2s;
            flex-shrink: 0;
        }

        .back-button:hover {
            background: #ff4f91;
            color: white;
        }

        .logo {
            color: #ff4f91;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }

        .container {
            width: 85%;
            max-width: 700px;
            margin: 50px auto;
            background: #19191f;
            padding: 35px;
            border: 1px solid #292932;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #ffffff;
            margin-bottom: 10px;
            font-size: 27px;
        }

        .subtitle {
            color: #9999a6;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-weight: 600;
            font-size: 13px;
            color: #e8e8ec;
        }

        input, textarea {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #383842;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #222229;
            color: #ffffff;
            transition: 0.2s;
        }

        input::placeholder, textarea::placeholder {
            color: #777783;
        }

        input:focus, textarea:focus {
            border-color: #ff4f91;
            box-shadow: 0 0 0 3px rgba(255, 79, 145, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error {
            color: #ff829d;
            font-size: 12px;
            margin-top: 7px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 10px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: 0.2s;
        }

        .btn-primary {
            background: #ff4f91;
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            background: #e83d7e;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #30212b;
            color: #ff75a8;
            border: 1px solid #593044;
        }

        .btn-secondary:hover {
            background: #493044;
        }

        @media (max-width: 600px) {
            nav {
                padding: 16px 5%;
                gap: 15px;
            }

            .logo {
                font-size: 21px;
            }

            .container {
                width: 92%;
                margin: 30px auto;
                padding: 25px 20px;
            }

            h1 {
                font-size: 23px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav>
    <a href="{{ route('admin.studios.index') }}"
       class="back-button"
       title="Kembali ke Kelola Studio"
       aria-label="Kembali ke Kelola Studio">&#8592;</a>

    <a href="{{ route('admin.dashboard') }}" class="logo">
        dansera ♡
    </a>
</nav>

<div class="container">
    <h1>Tambah Studio</h1>
    <p class="subtitle">Tambahkan studio dance baru ke Dansera.</p>

    <form action="{{ route('admin.studios.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Studio</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Contoh: Studio Beginner"
                required
            >

            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Lokasi Studio</label>
            <input
                type="text"
                id="location"
                name="location"
                value="{{ old('location') }}"
                placeholder="Contoh: Jakarta"
                required
            >

            @error('location')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price_per_hour">Harga per Jam (Rp)</label>
            <input
                type="number"
                id="price_per_hour"
                name="price_per_hour"
                value="{{ old('price_per_hour') }}"
                placeholder="Contoh: 75000"
                min="0"
                required
            >

            @error('price_per_hour')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Studio</label>
            <textarea
                id="description"
                name="description"
                placeholder="Ceritakan fasilitas atau keunggulan studio..."
                required
            >{{ old('description') }}</textarea>

            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">
                Simpan Studio
            </button>

            <a href="{{ route('admin.studios.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

</body>
</html>