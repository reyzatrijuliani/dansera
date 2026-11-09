<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun | Dansera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #101014;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
        }

        .card {
            width: 100%;
            max-width: 430px;
            padding: 38px;
            background: #19191f;
            border: 1px solid #2b2b34;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #ff4f91;
            font-size: 34px;
            margin: 0 0 8px;
            font-weight: 700;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 28px;
            color: #9999a5;
            font-size: 13px;
        }

        label {
            display: block;
            margin: 16px 0 8px;
            font-size: 13px;
            font-weight: 500;
            color: #eeeeee;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #363640;
            border-radius: 10px;
            outline: none;
            background: #222229;
            color: #ffffff;
            font-family: inherit;
            font-size: 13px;
            transition: 0.2s;
        }

        input::placeholder {
            color: #777782;
        }

        input:focus {
            border-color: #ff4f91;
            box-shadow: 0 0 0 3px rgba(255, 79, 145, 0.12);
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #ff4f91;
            color: white;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #ed347b;
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            color: #9999a5;
            font-size: 13px;
        }

        a {
            color: #ff4f91;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            color: #ff80ae;
            text-decoration: underline;
        }

        .error {
            color: #ff8ba9;
            font-size: 12px;
            margin-top: 6px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="card">

        <h1>Dansera.</h1>

        <p class="subtitle">
            Buat akun untuk mulai booking studio dance.
        </p>

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <label for="name">Nama Lengkap</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Masukkan nama lengkap"
                required
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email"
                required
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Minimal 8 karakter"
                required
            >
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password_confirmation">Konfirmasi Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Ulangi password"
                required
            >

            <button type="submit">Daftar Akun</button>
        </form>

        <p class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </p>

    </div>
</body>
</html>