<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Games - Task & Tinker</title>
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
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: 20%;
            right: 8%;
            animation-delay: 2s;
        }

        .floating-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            bottom: 25%;
            left: 3%;
            animation-delay: 4s;
        }

        .floating-decoration:nth-child(4) {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            bottom: 15%;
            right: 5%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        .games-container-wrapper {
            max-width: 1000px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 36px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo-container {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 16px rgba(255, 159, 243, 0.25);
        }

        .brand-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .header-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 159, 243, 0.2);
            border-radius: 50px;
            padding: 8px 16px;
            color: #ff9ff3;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 12px rgba(255, 159, 243, 0.1);
        }

        .header h1 {
            color: #1e293b;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.5;
        }

        .games-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 16px;
            box-shadow: 
                0 12px 16px -4px rgba(0, 0, 0, 0.08),
                0 4px 6px -2px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 24px 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.6);
            text-align: center;
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .game-card:hover::before {
            left: 100%;
        }

        .game-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 25px 35px -5px rgba(0, 0, 0, 0.12),
                0 15px 15px -5px rgba(0, 0, 0, 0.06),
                0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        .game-card:active {
            transform: translateY(-4px) scale(1.01);
        }

        .game-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .quiz-icon {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
        }

        .sudoku-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .tictactoe-icon {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
        }

        .game-title {
            color: #1e293b;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.25px;
        }

        .game-description {
            color: #64748b;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.4;
            margin-bottom: 16px;
            min-height: 32px;
        }

        .game-stats {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            justify-content: center;
        }

        .stat-item {
            text-align: center;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.4);
        }

        .stat-number {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 10px;
            font-weight: 500;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .game-link {
            text-decoration: none;
            display: block;
        }

        .play-btn {
            width: 100%;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(255, 159, 243, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: 1px solid rgba(255, 159, 243, 0.3);
        }

        .play-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .play-btn:hover {
            background: linear-gradient(135deg, #f368e0, #e056fd);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255, 159, 243, 0.4);
        }

        .play-btn:hover::before {
            left: 100%;
        }

        .play-btn:active {
            transform: translateY(0);
        }

        /* Different button colors for each game */
        .game-card:nth-child(1) .play-btn {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .game-card:nth-child(1) .play-btn:hover {
            background: linear-gradient(135deg, #ff5252, #ff6b6b);
            box-shadow: 0 12px 28px rgba(255, 107, 107, 0.4);
        }

        .game-card:nth-child(2) .play-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            border: 1px solid rgba(102, 126, 234, 0.3);
        }

        .game-card:nth-child(2) .play-btn:hover {
            background: linear-gradient(135deg, #5a67d8, #667eea);
            box-shadow: 0 12px 28px rgba(102, 126, 234, 0.4);
        }

        .game-card:nth-child(3) .play-btn {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            box-shadow: 0 8px 20px rgba(72, 202, 178, 0.3);
            border: 1px solid rgba(72, 202, 178, 0.3);
        }

        .game-card:nth-child(3) .play-btn:hover {
            background: linear-gradient(135deg, #38b2ac, #48cab2);
            box-shadow: 0 12px 28px rgba(72, 202, 178, 0.4);
        }

        .back-section {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(226, 232, 240, 0.3);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: #64748b;
            text-decoration: none;
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            color: #475569;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
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

            .header h1 {
                font-size: 36px;
            }

            .subtitle {
                font-size: 16px;
            }

            .games-container {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-bottom: 40px;
            }

            .game-card {
                padding: 24px 20px;
            }

            .game-icon {
                width: 64px;
                height: 64px;
                font-size: 28px;
                margin-bottom: 20px;
            }

            .game-title {
                font-size: 20px;
            }

            .back-btn {
                padding: 14px 24px;
                font-size: 14px;
            }

            .game-stats {
                gap: 12px;
            }

            .stat-item {
                padding: 8px 12px;
            }
        }

        @media (max-width: 480px) {
            .brand-text {
                font-size: 28px;
            }

            .header h1 {
                font-size: 28px;
            }

            .header-badge {
                font-size: 12px;
                padding: 8px 16px;
            }

            .game-stats {
                gap: 8px;
            }

            .stat-item {
                padding: 6px 10px;
            }
        }

        /* Animation */
        .games-container-wrapper {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .game-card {
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .game-card:nth-child(1) { animation-delay: 0.1s; }
        .game-card:nth-child(2) { animation-delay: 0.2s; }
        .game-card:nth-child(3) { animation-delay: 0.3s; }

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
    
    <div class="games-container-wrapper">
        <div class="header">
            <div class="brand-section">
                <div class="logo-container">🎮</div>
                <div class="brand-text">Mini Games</div>
            </div>
            <div class="header-badge">✨ Entertainment Hub</div>
            <h1>Choose Your Game</h1>
            <p class="subtitle">Take a break and enjoy some fun games to refresh your mind</p>
        </div>

        <div class="games-container">
            <div class="game-card">
                <div class="game-icon quiz-icon">🧠</div>
                <h3 class="game-title">Quiz</h3>
                <p class="game-description">Test your knowledge with challenging questions across various topics</p>
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Questions</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Categories</div>
                    </div>
                </div>
                <a href="/mini-games/quiz" class="game-link">
                    <button class="play-btn">
                        🚀 Start Quiz
                    </button>
                </a>
            </div>

            <div class="game-card">
                <div class="game-icon sudoku-icon">🔢</div>
                <h3 class="game-title">Sudoku</h3>
                <p class="game-description">Challenge your logic with the classic number puzzle game</p>
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Difficulty</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">9x9</div>
                        <div class="stat-label">Grid</div>
                    </div>
                </div>
                <a href="/mini-games/sudoku" class="game-link">
                    <button class="play-btn">
                        🧮 Play Sudoku
                    </button>
                </a>
            </div>

            <div class="game-card">
                <div class="game-icon tictactoe-icon">⭕</div>
                <h3 class="game-title">Tic Tac Toe</h3>
                <p class="game-description">Classic strategy game for quick fun with friends or AI</p>
                <div class="game-stats">
                    <div class="stat-item">
                        <div class="stat-number">2</div>
                        <div class="stat-label">Players</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">3x3</div>
                        <div class="stat-label">Board</div>
                    </div>
                </div>
                <a href="/mini-games/tictactoe" class="game-link">
                    <button class="play-btn">
                        ⚡ Quick Game
                    </button>
                </a>
            </div>
        </div>

        <div class="back-section">
            <a href="dashboard" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>
        </div>
    </div>

    <script>
        // Back to dashboard function
        function goBackToDashboard() {
            // Try to go back to the previous page (dashboard)
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // If no history, redirect to dashboard
                window.location.href = '/dashboard' || '../dashboard' || 'index.html';
            }
        }
    </script>
</body>
</html>