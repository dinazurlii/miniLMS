<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task & Tinker - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 107, 107, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(72, 187, 120, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            position: relative;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .logo-container {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        }

        .brand-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header p {
            color: #64748b;
            font-size: 15px;
            font-weight: 400;
            margin-top: 8px;
        }

        .error-container {
            background: linear-gradient(135deg, #fef2f2, #fde8e8);
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            position: relative;
        }

        .error-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, #ef4444, #dc2626);
            border-radius: 2px 0 0 2px;
        }

        .error-container ul {
            list-style: none;
            margin-left: 8px;
        }

        .error-container li {
            color: #dc2626;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
        }

        .error-container li::before {
            content: "⚠️";
            margin-right: 8px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            z-index: 2;
            opacity: 0.6;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 400;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #1e293b;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.25);
            margin-bottom: 16px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.35);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            margin: 24px 0;
            position: relative;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
        }

        .divider span {
            background: rgba(255, 255, 255, 0.95);
            color: #64748b;
            padding: 0 12px;
            font-size: 13px;
            font-weight: 500;
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .register-link p {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .register-link a:hover {
            color: #5a67d8;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Floating elements for visual interest */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Animation for container */
        .login-container {
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
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
            
            .login-container {
                padding: 32px 24px;
                border-radius: 16px;
            }
            
            .brand-text {
                font-size: 24px;
            }

            .form-input {
                padding: 12px 14px 12px 40px;
                font-size: 16px;
            }

            .login-btn {
                padding: 14px 20px;
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
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    
    <div class="login-container">
        <div class="login-header">
            <div class="brand-section">
                <div class="logo-container">⚡</div>
                <div class="brand-text">Task & Tinker</div>
            </div>
            <p>Manage your tasks with style and efficiency</p>
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

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="form-group">
                <label class="input-label" for="email">Email Address</label>
                <div class="input-wrapper">
                    <div class="input-icon">📧</div>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input" 
                           placeholder="Enter your email address" 
                           value="{{ old('email') }}"
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
                           placeholder="Enter your password" 
                           required>
                </div>
            </div>

            <button type="submit" class="login-btn">Sign In to Task & Tinker</button>
        </form>

        <div class="register-link">
            <p>Don't have an account yet? <a href="{{ route('register') }}">Create a new account</a></p>
        </div>
    </div>
</body>
</html>