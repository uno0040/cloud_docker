<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
</head>
<body>
    <div class = "cadastro-container">
        <div class = "cadastro-form">
            <div class = "sign-up">
                <h2>Sign Up</h2>
                <form action="{{ route('signup') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <button type="submit" class="btn">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
