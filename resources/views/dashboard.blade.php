<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task & Tinker - Dashboard</title>
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
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(120, 119, 198, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 107, 107, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(72, 187, 120, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 30% 80%, rgba(255, 159, 243, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .dashboard-container {
            position: relative;
            z-index: 1;
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 32px;
        }

        .logo-container {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.25);
        }

        .brand-text {
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }

        .welcome-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 50px;
            padding: 12px 24px;
            color: #667eea;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.1);
        }

        h1 {
            color: #1e293b;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .subtitle {
            color: #64748b;
            font-size: 18px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 1fr;
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .menu-card:hover::before {
            left: 100%;
        }

        .menu-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 25px 35px -5px rgba(0, 0, 0, 0.12),
                0 15px 15px -5px rgba(0, 0, 0, 0.06),
                0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        .menu-card:active {
            transform: translateY(-4px) scale(1.01);
        }

        .menu-link {
            text-decoration: none;
            display: block;
            padding: 32px 28px;
            height: 100%;
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .podomoro-icon {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
        }

        .todo-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .games-icon {
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
        }

        .calculator-icon {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
        }

        .card-title {
            color: #1e293b;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.25px;
        }

        .card-description {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .card-arrow {
            color: #94a3b8;
            font-size: 20px;
            transition: all 0.3s ease;
            transform: translateX(0);
        }

        .menu-card:hover .card-arrow {
            color: #667eea;
            transform: translateX(4px);
        }

        /* Floating decorative elements */
        .floating-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.06;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        .floating-decoration:nth-child(1) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            top: 20%;
            right: 8%;
            animation-delay: 2s;
        }

        .floating-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            bottom: 25%;
            left: 3%;
            animation-delay: 4s;
        }

        .floating-decoration:nth-child(4) {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            bottom: 15%;
            right: 5%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 40px 16px;
            }

            .brand-section {
                flex-direction: column;
                gap: 12px;
            }

            .logo-container {
                width: 56px;
                height: 56px;
                font-size: 28px;
            }

            .brand-text {
                font-size: 32px;
            }

            h1 {
                font-size: 36px;
            }

            .subtitle {
                font-size: 16px;
            }

            .menu-container {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(4, 1fr);
                gap: 16px;
            }

            .menu-link {
                padding: 24px 20px;
            }

            .card-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
                margin-bottom: 16px;
            }

            .card-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .brand-text {
                font-size: 28px;
            }

            h1 {
                font-size: 28px;
            }

            .welcome-badge {
                font-size: 12px;
                padding: 8px 16px;
            }
        }

        /* Animation */
        .dashboard-container {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-card {
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .menu-card:nth-child(1) { animation-delay: 0.1s; }
        .menu-card:nth-child(2) { animation-delay: 0.2s; }
        .menu-card:nth-child(3) { animation-delay: 0.3s; }
        .menu-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="brand-section">
                <div class="logo-container">⚡</div>
                <div class="brand-text">Welcome to Task & Tinker</div>
            </div>
            <div class="welcome-badge">✨ Dashboard</div>
            <p class="subtitle">Choose from our collection of productivity tools and entertainment options</p>
        </div>

        <div class="menu-container">
            <div class="menu-card">
                <a href="/podomoro" class="menu-link">
                    <div class="card-icon podomoro-icon">🍅</div>
                    <h3 class="card-title">Pomodoro Timer</h3>
                    <p class="card-description">Boost your productivity with focused work sessions and breaks</p>
                    <div class="card-arrow">→</div>
                </a>
            </div>

            <div class="menu-card">
                <a href="/todo" class="menu-link">
                    <div class="card-icon todo-icon">✓</div>
                    <h3 class="card-title">To Do!</h3>
                    <p class="card-description">Organize your tasks and stay on top of your goals</p>
                    <div class="card-arrow">→</div>
                </a>
            </div>

            <div class="menu-card">
                <a href="/mini-games" class="menu-link" id="miniGamesLink">
                    <div class="card-icon games-icon">🎮</div>
                    <h3 class="card-title">Mini Games</h3>
                    <p class="card-description">Take a break with fun and engaging mini games</p>
                    <div class="card-arrow">→</div>
                </a>
            </div>

            <div class="menu-card">
                <a href="/calculator" class="menu-link">
                    <div class="card-icon calculator-icon">🧮</div>
                    <h3 class="card-title">Scientific Calculator</h3>
                    <p class="card-description">Perform complex calculations with advanced functions</p>
                    <div class="card-arrow">→</div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>