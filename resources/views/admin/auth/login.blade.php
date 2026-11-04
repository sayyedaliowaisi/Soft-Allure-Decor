
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta name="robots" content="noindex, nofollow">

    <title>Admin Login | Soft Allure Décor</title>

    <style>
        :root {
            --gold: #b58a49;
            --gold-dark: #946b34;
            --dark: #24211e;
            --muted: #77716b;
            --border: #e9dfd1;
            --background: #faf8f4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            display: grid;
            place-items: center;
            padding: 20px;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(181, 138, 73, 0.09),
                    transparent 45%
                ),
                var(--background);
            font-family: Arial, sans-serif;
            color: var(--dark);
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 42px 36px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow:
                0 20px 60px rgba(36, 33, 30, 0.06);
        }

        .brand {
            margin: 0 0 8px;
            text-align: center;
            color: var(--dark);
            font-family: Georgia, serif;
            font-size: 32px;
            font-weight: 500;
        }

        .subtitle {
            margin: 0 0 32px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .form-label {
            display: block;
            margin: 18px 0 8px;
            color: var(--dark);
            font-size: 12px;
            font-weight: 700;
        }

        .form-input {
            width: 100%;
            min-height: 48px;
            padding: 13px 14px;
            border: 1px solid #ddd4c9;
            border-radius: 8px;
            background: #fff;
            color: var(--dark);
            font-size: 14px;
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow:
                0 0 0 3px rgba(181, 138, 73, 0.13);
        }

        .form-input[aria-invalid="true"] {
            border-color: #b54747;
        }

        .submit-btn {
            width: 100%;
            min-height: 49px;
            margin-top: 26px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: var(--gold);
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .submit-btn:hover {
            background: var(--gold-dark);
        }

        .submit-btn:focus-visible {
            outline: 3px solid var(--gold-dark);
            outline-offset: 3px;
        }

        .error {
            margin-top: 7px;
            color: #b54747;
            font-size: 12px;
            line-height: 1.5;
        }

        .alert {
            padding: 13px 15px;
            margin-bottom: 22px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .login-footer {
            margin-top: 28px;
            text-align: center;
            color: #a8a29e;
            font-size: 11px;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            body {
                padding: 14px;
            }

            .login-card {
                padding: 32px 22px;
                border-radius: 12px;
            }

            .brand {
                font-size: 28px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .form-input,
            .submit-btn {
                transition: none;
            }
        }
    </style>
</head>

<body>

    <main class="login-card">

        <h1 class="brand">
            Soft Allure
        </h1>

        <p class="subtitle">
            Décor · Admin Login
        </p>

        {{-- LOGOUT SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success" role="status">
                {{ session('success') }}
            </div>
        @endif

        {{-- GENERAL ERRORS --}}
        @if($errors->has('email'))
            <div class="alert alert-error" role="alert">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.login.submit') }}"
        >
            @csrf

            {{-- EMAIL --}}
            <label for="email" class="form-label">
                Email Address
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-input"
                value="{{ old('email') }}"
                placeholder="Enter admin email"
                autocomplete="username"
                maxlength="255"
                @if($errors->has('email'))
                    aria-invalid="true"
                    aria-describedby="email-error"
                @endif
                required
                autofocus
            >

            @error('email')
                <div class="error" id="email-error">
                    {{ $message }}
                </div>
            @enderror

            {{-- PASSWORD --}}
            <label for="password" class="form-label">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-input"
                placeholder="Enter password"
                autocomplete="current-password"
                @if($errors->has('password'))
                    aria-invalid="true"
                    aria-describedby="password-error"
                @endif
                required
            >

            @error('password')
                <div class="error" id="password-error">
                    {{ $message }}
                </div>
            @enderror

            {{-- SUBMIT --}}
            <button
                type="submit"
                class="submit-btn"
            >
                Sign In →
            </button>

        </form>

        <p class="login-footer">
            Authorized personnel only
            <br>
            Soft Allure Décor
        </p>

    </main>

</body>
</html>
