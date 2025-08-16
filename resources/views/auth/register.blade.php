<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(147, 51, 234, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.12),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            padding: 48px;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .register-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-container {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #10b981, #3b82f6);
            border-radius: 16px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .register-header h2 {
            color: #1f2937;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .register-header p {
            color: #6b7280;
            font-size: 16px;
            font-weight: 400;
        }

        .error-container {
            background: linear-gradient(135deg, #fef2f2, #fde8e8);
            border: 1px solid #fecaca;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .error-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #ef4444, #dc2626);
        }

        .error-container ul {
            list-style: none;
            margin-left: 12px;
        }

        .error-container li {
            color: #dc2626;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
        }

        .error-container li::before {
            content: "⚠️";
            margin-right: 10px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .input-label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.25px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 52px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            color: #1f2937;
        }

        .form-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .register-btn {
            width: 100%;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 18px 24px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            letter-spacing: 0.25px;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.4);
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(229, 231, 235, 0.8);
        }

        .login-link p {
            color: #6b7280;
            font-size: 15px;
            font-weight: 400;
        }

        .login-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(135deg, #10b981, #3b82f6);
            transition: width 0.3s ease;
        }

        .login-link a:hover {
            color: #059669;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        /* Animation */
        .register-container {
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            body {
                padding: 16px;
            }
            
            .register-container {
                padding: 32px 24px;
                border-radius: 20px;
            }
            
            .register-header h2 {
                font-size: 28px;
            }

            .form-input {
                padding: 14px 16px 14px 48px;
                font-size: 16px;
            }

            .register-btn {
                padding: 16px 20px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo-container">✨</div>
            <h2>Create Account</h2>
            <p>Sign up to get started with your account</p>
        </div>

        @if ($errors->any())
            <div class="error-container">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            
            <div class="form-group">
                <label class="input-label" for="name">Full Name</label>
                <div class="input-wrapper">
                    <div class="input-icon">👤</div>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input" 
                           placeholder="Enter your full name" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label" for="email">Email Address</label>
                <div class="input-wrapper">
                    <div class="input-icon">📧</div>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="Enter your email address" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label" for="password">Password</label>
                <div class="input-wrapper">
                    <div class="input-icon">🔒</div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-input" 
                           placeholder="Create a strong password" 
                           required>
                </div>
            </div>

            <button type="submit" class="register-btn">Create Your Account</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
        </div>
    </div>
</body>
</html>