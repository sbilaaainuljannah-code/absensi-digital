<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Absensi Digital</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(circle at 80% 20%, rgba(67, 145, 205, 0.18), transparent 30%),
                radial-gradient(circle at 20% 80%, rgba(45, 100, 160, 0.12), transparent 30%),
                #07111f;
            color: #eaf6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Background grid */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(105, 183, 242, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(105, 183, 242, 0.035) 1px, transparent 1px);
            background-size: 45px 45px;
            mask-image: linear-gradient(to bottom, transparent, black, transparent);
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 25px;
            position: relative;
            z-index: 2;
        }

        .brand {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 18px;

            background: linear-gradient(
                145deg,
                #17395a,
                #0c2036
            );

            border: 1px solid #2d5c80;

            box-shadow:
                0 0 30px rgba(105, 183, 242, 0.16),
                inset 0 0 20px rgba(105, 183, 242, 0.05);

            font-size: 25px;
        }

        .brand h1 {
            font-size: 25px;
            font-weight: 650;
            letter-spacing: 0.5px;
        }

        .brand p {
            margin-top: 6px;
            font-size: 12px;
            color: #8faac0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .login-card {
            background: rgba(13, 27, 45, 0.92);
            border: 1px solid #183452;
            border-radius: 24px;
            padding: 34px;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.45),
                0 0 45px rgba(67, 145, 205, 0.07);

            backdrop-filter: blur(15px);
        }

        .login-title {
            margin-bottom: 25px;
        }

        .login-title h2 {
            font-size: 21px;
            margin-bottom: 7px;
        }

        .login-title p {
            font-size: 13px;
            color: #8faac0;
            line-height: 1.6;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            background: rgba(190, 83, 108, 0.12);
            border: 1px solid rgba(190, 83, 108, 0.25);
            color: #e8a8b7;
        }

        .success {
            background: rgba(92, 170, 135, 0.10);
            border-color: rgba(92, 170, 135, 0.25);
            color: #9bd8bd;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #b9d2e5;
            letter-spacing: 0.3px;
        }

        .input-box {
            position: relative;
        }

        .input-box span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6e94b1;
            font-size: 15px;
        }

        .input-box input {
            width: 100%;
            height: 48px;

            padding: 0 15px 0 43px;

            background: #091a2c;
            border: 1px solid #1a3a58;
            border-radius: 12px;

            color: #eaf6ff;
            outline: none;

            font-size: 13px;

            transition: 0.25s;
        }

        .input-box input::placeholder {
            color: #587188;
        }

        .input-box input:focus {
            border-color: #69b7f2;

            box-shadow:
                0 0 0 3px rgba(105, 183, 242, 0.08),
                0 0 20px rgba(105, 183, 242, 0.08);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin: 3px 0 23px;

            font-size: 12px;
            color: #8faac0;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .remember input {
            accent-color: #69b7f2;
        }

        .login-button {
            width: 100%;
            height: 49px;

            border: none;
            border-radius: 13px;

            background: linear-gradient(
                135deg,
                #69b7f2,
                #438fca
            );

            color: #06101c;

            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.4px;

            cursor: pointer;

            box-shadow:
                0 8px 25px rgba(67, 143, 202, 0.18);

            transition: 0.25s;
        }

        .login-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(67, 143, 202, 0.28);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .footer {
            text-align: center;
            margin-top: 22px;
            font-size: 11px;
            color: #557087;
            letter-spacing: 0.5px;
        }

        .system-status {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;

            margin-top: 12px;

            font-size: 10px;
            color: #6f8da5;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #83c7aa;
            box-shadow: 0 0 8px rgba(131, 199, 170, 0.6);
        }

        @media (max-width: 500px) {
            .login-wrapper {
                padding: 18px;
            }

            .login-card {
                padding: 27px 22px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="brand">

        <div class="brand-icon">
            ◈
        </div>

        <h1>Absensi Digital</h1>

        <p>Admin Management System</p>

    </div>


    <div class="login-card">

        <div class="login-title">

            <h2>Welcome back.</h2>

            <p>
                Masuk ke dashboard administrator
                untuk mengelola sistem absensi.
            </p>

        </div>


        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif


        @if($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif


        <form action="{{ route('admin.login.submit') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>Email Administrator</label>

                <div class="input-box">

                    <span>✉</span>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@absensi.test"
                        required
                    >

                </div>

            </div>


            <div class="form-group">

                <label>Password</label>

                <div class="input-box">

                    <span>●</span>

                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>

            </div>


            <div class="form-options">

                <label class="remember">

                    <input
                        type="checkbox"
                        name="remember"
                    >

                    Ingat saya

                </label>

                <span>ADMIN ONLY</span>

            </div>


            <button
                type="submit"
                class="login-button"
            >
                MASUK KE DASHBOARD
            </button>

        </form>

    </div>


    <div class="system-status">

        <span class="status-dot"></span>

        System Online

    </div>


    <div class="footer">
        © 2026 Absensi Digital · XII RPL
    </div>

</div>

</body>
</html>