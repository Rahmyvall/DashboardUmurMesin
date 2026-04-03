<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tracking Umur Mesin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            overflow-x: hidden;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(120deg, #eef2ff, #f8fafc);
        }

        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            flex-wrap: nowrap;
        }

        /* LEFT - IMAGE */
        .left {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            padding: 20px;
            position: relative;
        }

        .glow {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent);
            top: 10%;
            left: 20%;
            filter: blur(60px);
        }

        .left-content {
            text-align: center;
            color: #fff;
            z-index: 2;
        }

        .left-content h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .left-content p {
            margin-bottom: 20px;
        }

        .left img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        /* RIGHT - LOGIN FORM */
        .right {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 40px 30px;
        }

        .login-box {
            width: 100%;
            max-width: 360px;
        }

        .login-box h2 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .login-box p {
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #6366f1;
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
        }

        .footer {
            margin-top: 18px;
            font-size: 14px;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 768px) {
            .container {
                flex-direction: row;
                flex-wrap: nowrap;
            }

            .left,
            .right {
                width: 50%;
                padding: 20px;
            }

            .left img {
                max-width: 200px;
            }

            .left-content h1 {
                font-size: clamp(20px, 4vw, 40px);
            }
        }

        @media (max-width: 480px) {
            .login-box h2 {
                font-size: 24px;
            }

            .login-box p {
                font-size: 14px;
            }

            .btn {
                padding: 12px;
                font-size: 14px;
            }

            .left img {
                max-width: 150px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- LEFT: IMAGE -->
        <div class="left">
            <div class="glow"></div>
            <div class="left-content">
                <h1>Bengkel Lebih Profesional</h1>
                <p>Kelola servis dengan mudah</p>
                <img src="{{ asset('admin/images/login-illustration.png') }}">
            </div>
        </div>

        <!-- RIGHT: LOGIN FORM -->
        <div class="right">
            <div class="login-box">
                <h2>Selamat Datang 👋</h2>
                <p>Masuk untuk mengelola bengkel kamu</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        @error('email')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        @error('password')
                            <small style="color:red">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn">Masuk Sekarang</button>
                </form>
                <div class="footer">
                    Belum punya akun? <a href="#">Daftar Gratis</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('error'))
                Swal.fire({
                    title: "Login Gagal!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: "#6366f1"
                });
            @endif
            @if (session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#6366f1"
                });
            @endif
        });
    </script>

</body>

</html>
