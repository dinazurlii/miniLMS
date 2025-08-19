<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task & Tinker - Register</title>
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

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            position: relative;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .register-header {
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
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 15px rgba(72, 202, 178, 0.3);
        }

        .brand-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .register-header p {
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
            border-color: #48cab2;
            box-shadow: 0 0 0 3px rgba(72, 202, 178, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .register-btn {
            width: 100%;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
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
            box-shadow: 0 8px 20px rgba(72, 202, 178, 0.25);
            margin-bottom: 16px;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #38a169, #20c997);
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(72, 202, 178, 0.35);
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-link p {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
        }

        .login-link a {
            color: #48cab2;
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
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            transition: width 0.3s ease;
        }

        .login-link a:hover {
            color: #38a169;
        }

        .login-link a:hover::after {
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
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            top: 25%;
            right: 12%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            bottom: 20%;
            left: 12%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            bottom: 10%;
            right: 8%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Animation for container */
        .register-container {
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
            
            .register-container {
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

            .register-btn {
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
    <div class="floating-element"></div>
    
    <div class="register-container">
        <div class="register-header">
            <div class="brand-section">
                <div class="logo-container">⚡</div>
                <div class="brand-text">Task & Tinker</div>
            </div>
            <p>Create your account to get started</p>
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
                           value="{{ old('name') }}"
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
                           placeholder="Create a strong password" 
                           required>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label" for="password_confirmation">Confirm Password</label>
                <div class="input-wrapper">
                    <div class="input-icon">🔐</div>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-input" 
                           placeholder="Confirm your password" 
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