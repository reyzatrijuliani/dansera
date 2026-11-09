<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Dansera</title>

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
            font-family: 'Poppins', sans-serif;
            background: #101014;
            color: #ffffff;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 40px;
            background: #19191f;
            border: 1px solid #2b2b34;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
        }

        .logo {
            text-align: center;
            color: #ff4f91;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        h2 {
            text-align: center;
            font-size: 23px;
            font-weight: 600;
            margin: 0 0 8px;
        }

        .subtitle {
            text-align: center;
            color: #9999a5;
            font-size: 13px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 13px;
            color: #eeeeee;
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #363640;
            border-radius: 10px;
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
            outline: none;
            border-color: #ff4f91;
            box-shadow: 0 0 0 3px rgba(255, 79, 145, 0.12);
        }

        button {
            width: 100%;
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

        .error {
            padding: 13px;
            margin-bottom: 20px;
            background: #382027;
            border: 1px solid #713044;
            border-radius: 9px;
            color: #ff8ba9;
            font-size: 12px;
        }

        .success {
            padding: 13px;
            margin-bottom: 20px;
            background: #1d3429;
            border: 1px solid #315c42;
            border-radius: 9px;
            color: #8be0a5;
            font-size: 12px;
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #9999a5;
        }

        .register-link a {
            color: #ff4f91;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            color: #ff80ae;
            text-decoration: underline;
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            color: #696974;
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">

        <div class="logo">Dansera.</div>

        <h2>Welcome Back!</h2>

        <p class="subtitle">
            Login untuk booking studio dance favoritmu.
        </p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email kamu"
                required
                autofocus
            >

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">
                Login
            </button>
        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="/register">Daftar di sini</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} Dansera. Dance, express, repeat.
        </div>

    </div>
</body>
</html>