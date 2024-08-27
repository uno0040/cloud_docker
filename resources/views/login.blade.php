<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="sign-in">
                <h2>Sign In</h2>
                <form action="{{ route('cadastro') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <button type="submit" class="btn" onclick= >Sign In</button>
                    <div class="extra-options">
                        <label>
                            <input type="checkbox" name="remember" /> Remember Me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                </form>
            </div>
            <div class="line-divider">
            </div>
            <div class="welcome">
                <h2>Welcome to login</h2>
                <p>Don't have an account?</p>
                <a href="/cadastro" class="astext">Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>
