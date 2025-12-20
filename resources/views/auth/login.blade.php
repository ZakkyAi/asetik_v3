<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Asetik</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #fff; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-container { background: #fff; border: 1px solid #000; max-width: 400px; width: 100%; }
        .login-header { background: #fff; padding: 30px; text-align: center; border-bottom: 1px solid #000; }
        .login-header h1 { font-size: 28px; font-weight: bold; margin-bottom: 5px; color: #000; }
        .login-header p { font-size: 14px; color: #000; }
        .login-body { padding: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; color: #000; font-weight: bold; font-size: 14px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #000; font-size: 14px; background: #fff; }
        .form-control:focus { outline: none; }
        .error-message { color: #000; font-size: 12px; margin-top: 5px; display: block; }
        .btn-login { width: 100%; padding: 12px; background: #fff; color: #000; border: 1px solid #000; font-size: 14px; font-weight: bold; cursor: pointer; }
        .alert { padding: 10px; border: 1px solid #000; margin-bottom: 15px; font-size: 13px; background: #fff; color: #000; }
        .login-footer { text-align: center; padding: 15px; background: #fff; border-top: 1px solid #000; color: #000; font-size: 12px; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Asetik</h1>
            <p>IT Asset Management System</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert">
                    <strong>Error:</strong> {{ $errors->first('login') ?? 'Please check your credentials.' }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="login">Username or Email</label>
                    <input 
                        type="text" 
                        id="login" 
                        name="login" 
                        class="form-control" 
                        value="{{ old('login') }}"
                        placeholder="Enter username or email"
                        required
                        autofocus
                    >
                    @error('login')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn-login">Sign In</button>
            </form>
        </div>

        <div class="login-footer">
            <p>&copy; 2025 Asetik. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
