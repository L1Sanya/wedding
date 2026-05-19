<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход — Админ-панель</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Georgia', serif;
            background: #f5ede4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            background: #fffdf9;
            padding: 50px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.08);
            border: 1px solid #e8dccf;
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .login-box h1 {
            font-size: 1.8em;
            color: #2c1f1a;
            margin-bottom: 6px;
        }
        .login-box .subtitle {
            color: #8c7b6e;
            font-style: italic;
            margin-bottom: 24px;
            font-size: 0.95em;
        }
        .login-box input {
            width: 100%;
            padding: 14px;
            border: 1px solid #e0d5c7;
            border-radius: 8px;
            font-size: 1em;
            text-align: center;
            font-family: inherit;
            background: #fdf8f2;
            letter-spacing: 0.1em;
        }
        .login-box input:focus {
            outline: none;
            border-color: #c9a96e;
            box-shadow: 0 0 0 3px rgba(201,169,110,0.15);
        }
        .login-box button {
            margin-top: 16px;
            width: 100%;
            padding: 14px;
            background: #7a2e3b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.05em;
            cursor: pointer;
            font-family: inherit;
            transition: 0.3s;
        }
        .login-box button:hover {
            background: #9a4a56;
        }
        .error {
            color: #c0392b;
            margin-top: 12px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h1>🔐 Админ-панель</h1>
    <p class="subtitle">Цырен & Сарюна</p>

    <form method="POST" action="/admin/login">
        @csrf
        <input
            type="password"
            name="password"
            placeholder="Введите пароль"
            required
            autofocus
        >
        <button type="submit">Войти</button>
    </form>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
</div>
</body>
</html>
