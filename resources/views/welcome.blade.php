<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Asetik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
        }

        .logo {
            font-size: 80px;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        h1 {
            font-size: 48px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .features {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .feature {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .feature-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .feature-text {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🔐</div>
        <h1>Asetik</h1>
        <p>IT Asset Management System</p>
        <a href="{{ url('/login') }}" class="btn">Get Started</a>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">👥</div>
                <div class="feature-text">User Management</div>
            </div>
            <div class="feature">
                <div class="feature-icon">💻</div>
                <div class="feature-text">Product Catalog</div>
            </div>
            <div class="feature">
                <div class="feature-icon">📋</div>
                <div class="feature-text">Asset Tracking</div>
            </div>
            <div class="feature">
                <div class="feature-icon">🔧</div>
                <div class="feature-text">Repair Management</div>
            </div>
        </div>
    </div>
</body>
</html>
