<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f5f5f5;
        }
        .container {
            display: flex;
            width: 800px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .login-section {
            flex: 1;
            padding: 40px;
            background: white;
        }
        .login-section h2 {
            margin-bottom: 20px;
        }
        .login-section input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-section button {
            width: 100%;
            padding: 10px;
            background: teal;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://source.unsplash.com/400x400/?water,boat') no-repeat center/cover;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .register-section button {
            padding: 10px 20px;
            border: 2px solid white;
            background: transparent;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-section">
            <h2>Login hire.</h2>
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Password">
            <div style="display: flex; justify-content: space-between; margin: 10px 0;">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button>Login</button>
        </div>
        <div class="register-section">
            <div>
                <h2>Start your journey now</h2>
                <p>If you don't have an account yet, join us and start your journey.</p>
                <button>Register</button>
            </div>
        </div>
    </div>
</body>
</html>
