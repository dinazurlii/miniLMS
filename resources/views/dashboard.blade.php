<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
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
                radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(147, 51, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
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

        .welcome-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 8px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
        }

        h1 {
            color: #ffffff;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -1px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            max-width: 900px;
            margin: 0 auto;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .menu-card:hover::before {
            left: 100%;
        }

        .menu-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.2);
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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .podomoro-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .todo-icon {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .games-icon {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .calculator-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .card-title {
            color: #1f2937;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.25px;
        }

        .card-description {
            color: #6b7280;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .card-arrow {
            color: #9ca3af;
            font-size: 20px;
            transition: all 0.3s ease;
            transform: translateX(0);
        }

        .menu-card:hover .card-arrow {
            color: #3b82f6;
            transform: translateX(4px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 40px 16px;
            }

            h1 {
                font-size: 36px;
            }

            .subtitle {
                font-size: 16px;
            }

            .menu-container {
                grid-template-columns: 1fr;
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
            h1 {
                font-size: 28px;
            }

            .welcome-badge {
                font-size: 12px;
                padding: 6px 16px;
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
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="welcome-badge">✨ Dashboard</div>
            <h1>Welcome to the Dashboard</h1>
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