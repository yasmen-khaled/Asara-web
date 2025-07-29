<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - لوحة الإدارة</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            direction: rtl;
        }

        .login-container {
            background: white;
            padding: 3rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            margin-bottom: 2rem;
        }

        .logo i {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .logo h1 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .logo p {
            color: #666;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: right;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .form-control {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #333;
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            text-align: right;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #333;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn:hover {
            background: #555;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .remember-me label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #666;
        }

        .remember-me input[type="checkbox"] {
            margin-left: 0.5rem;
            width: 16px;
            height: 16px;
        }

        .back-link {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #333;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 1rem;
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <i class="fas fa-user-shield"></i>
            <h1>تسجيل الدخول</h1>
            <p>لوحة إدارة</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control @error('email') error @enderror" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus>
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control @error('password') error @enderror" 
                           required 
                           autocomplete="current-password">
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-me">
                <label>
                    <input type="checkbox" name="remember" id="remember">
                    تذكرني
                </label>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i>
                تسجيل الدخول
            </button>
        </form>

        <a href="{{ route('cottage.index') }}" class="back-link">
            <i class="fas fa-arrow-right"></i>
            العودة للموقع الرئيسي
        </a>
    </div>
</body>
</html> 