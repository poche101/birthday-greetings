<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Pastor Funke 50th</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css'])

    <style>
        :root {
            --navy:       #06091f;
            --navy-mid:   #0d1235;
            --navy-card:  #111530;
            --gold:       #c9943a;
            --gold-light: #e8b86d;
            --gold-pale:  #f5e6c8;
            --cream:      #faf6ee;
            --text-muted: #7a7a9a;
            --danger:     #e87c7c;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--navy);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* Subtle grid pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201,148,58,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201,148,58,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .login-card {
            background: var(--navy-card);
            border: 1px solid rgba(201,148,58,0.18);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6);
            position: relative;
        }

        /* Top gold accent line */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border-radius: 0 0 4px 4px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.25rem;
        }

        .login-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(201,148,58,0.15), rgba(201,148,58,0.05));
            border: 1px solid rgba(201,148,58,0.3);
            margin-bottom: 1.25rem;
            font-size: 1.6rem;
        }

        .login-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--cream);
            line-height: 1.2;
        }

        .login-header p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            color: var(--text-muted);
            margin-top: 0.4rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            margin-bottom: 1.1rem;
        }

        .field label {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .field input {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(201,148,58,0.18);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            color: var(--cream);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            outline: none;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .field input::placeholder { color: rgba(122,122,154,0.6); }

        .field input:focus {
            border-color: var(--gold);
            background: rgba(201,148,58,0.05);
            box-shadow: 0 0 0 3px rgba(201,148,58,0.1);
        }

        .field input.is-invalid {
            border-color: var(--danger);
        }

        .field-error {
            font-size: 0.65rem;
            color: var(--danger);
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }

        .remember-row input[type="checkbox"] {
            accent-color: var(--gold);
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 0.75rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #b8842e 0%, var(--gold) 50%, #d4a84c 100%);
            border: none;
            border-radius: 10px;
            color: var(--navy);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 24px rgba(201,148,58,0.3);
        }

        .login-btn:hover  { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(201,148,58,0.4); }
        .login-btn:active { transform: translateY(0); }

        .login-footer {
            text-align: center;
            margin-top: 1.75rem;
        }

        .login-footer a {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-footer a:hover { color: var(--gold-light); }

        /* Alert for invalid credentials */
        .alert-error {
            background: rgba(232,124,124,0.08);
            border: 1px solid rgba(232,124,124,0.3);
            border-radius: 10px;
            padding: 0.8rem 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.78rem;
            color: #e87c7c;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="login-header">
        <div class="login-logo">✦</div>
        <h1>Dashboard Login</h1>
        <p>Pastor Funke 50th Birthday</p>
    </div>

    {{-- Validation error alert --}}
    @if ($errors->any())
    <div class="alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <div class="field">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@example.com"
                autocomplete="email"
                autofocus
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
            />
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                autocomplete="current-password"
                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
            />
        </div>

        <div class="remember-row">
            <input type="checkbox" id="remember" name="remember" />
            <label for="remember">Keep me signed in</label>
        </div>

        <button type="submit" class="login-btn">Sign In to Dashboard</button>
    </form>

    <div class="login-footer">
        <a href="{{ route('home') }}">← Back to Birthday Page</a>
    </div>

</div>

</body>
</html>
