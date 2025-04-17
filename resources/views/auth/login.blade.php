<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login & Register</title>
    <link rel="icon" type="image/png" href="/assets/img/logo_pondok.png">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-header">
                    <h1>Create Account</h1>
                    <p>Register with your personal details</p>
                </div>
                <span>or use your email for registration</span>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-header">
                    <h1>Welcome Back</h1>
                    <p>Please login to your account</p>
                </div>
                <span>or use your email account</span>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword(this)"></i>
                </div>
                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #6c5ce7;
            --primary-dark: #5649c0;
            --secondary-color: #a29bfe;
            --text-color: #2d3436;
            --light-text: #636e72;
            --bg-color: #f5f6fa;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 550px;
            transition: var(--transition);
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: var(--transition);
            padding: 40px 0;
        }

        .form-container form {
            background-color: var(--white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 0 50px;
            text-align: center;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 14px;
            color: var(--light-text);
        }

        .form-container span {
            display: block;
            font-size: 12px;
            color: var(--light-text);
            margin: 15px 0;
            position: relative;
        }

        .form-container span::before,
        .form-container span::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 80px;
            height: 1px;
            background-color: #ddd;
        }

        .form-container span::before {
            left: -90px;
        }

        .form-container span::after {
            right: -90px;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--light-text);
            font-size: 14px;
        }

        .input-group .toggle-password {
            left: auto;
            right: 15px;
            cursor: pointer;
        }

        .input-group input {
            width: 100%;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(108, 92, 231, 0.2);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 15px 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: var(--light-text);
            cursor: pointer;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password {
            font-size: 13px;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.active .sign-in {
            transform: translateX(100%);
        }

        .container.active .sign-up {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move 0.6s;
        }

        @keyframes move {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: var(--transition);
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 150px 100px 0;
        }

        .toggle {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            height: 100%;
            color: var(--white);
            position: relative;
            left: -100%;
            width: 200%;
            transform: translateX(0);
            transition: var(--transition);
        }

        .container.active .toggle {
            transform: translateX(50%);
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: var(--transition);
        }

        .toggle-panel h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .toggle-panel p {
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .toggle-left {
            transform: translateX(-200%);
        }

        .container.active .toggle-left {
            transform: translateX(0);
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .container.active .toggle-right {
            transform: translateX(200%);
        }

        .hidden {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
            padding: 10px 30px;
        }

        .hidden:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                min-height: auto;
                max-width: 100%;
            }

            .form-container {
                padding: 30px 0;
            }

            .form-container form {
                padding: 0 30px;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .toggle-container {
                display: none;
            }

            .sign-in,
            .sign-up {
                width: 100%;
                opacity: 1;
                z-index: 5;
            }

            .container.active .sign-in {
                transform: translateX(100%);
                opacity: 0;
            }

            .container.active .sign-up {
                transform: translateX(0);
            }
        }

        @media (max-width: 480px) {
            .form-container form {
                padding: 0 20px;
            }

            .form-header h1 {
                font-size: 22px;
            }

            .input-group input {
                padding: 10px 15px 10px 35px;
            }

            .options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .form-container span::before,
            .form-container span::after {
                width: 50px;
            }

            .form-container span::before {
                left: -60px;
            }

            .form-container span::after {
                right: -60px;
            }
        }
    </style>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        function togglePassword(icon) {
            const input = icon.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        // Auto switch back to login after 5 seconds if not on mobile
        if (window.innerWidth > 768) {
            setTimeout(() => {
                if (container.classList.contains("active")) {
                    container.classList.remove("active");
                }
            }, 5000);
        }
    </script>
</body>

</html>
