<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Games</title>
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
            padding: 20px;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .games-container-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header-badge {
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

        .header h1 {
            color: #ffffff;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -1px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .header-icon {
            font-size: 48px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 4px 8px rgba(139, 92, 246, 0.3));
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .games-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 60px;
        }

        .game-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 32px 28px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .game-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .game-card:hover::before {
            left: 100%;
        }

        .game-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .game-card:active {
            transform: translateY(-8px) scale(1.01);
        }

        .game-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 24px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .quiz-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .sudoku-icon {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .tictactoe-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .game-title {
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .game-description {
            color: #6b7280;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.6;
            margin-bottom: 24px;
            min-height: 40px;
        }

        .game-stats {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            justify-content: center;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .game-link {
            text-decoration: none;
            display: block;
        }

        .play-btn {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .play-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .play-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.4);
        }

        .play-btn:hover::before {
            left: 100%;
        }

        .play-btn:active {
            transform: translateY(0);
        }

        .back-section {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            color: #ffffff;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .header h1 {
                font-size: 36px;
                flex-direction: column;
                gap: 12px;
            }

            .header-icon {
                font-size: 40px;
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
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 28px;
            }

            .header-badge {
                font-size: 12px;
                padding: 6px 16px;
            }

            .game-stats {
                gap: 12px;
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
    <div class="games-container-wrapper">
        <div class="header">
            <div class="header-badge">🎮 Entertainment Hub</div>
            <h1>
                <span class="header-icon">🎮</span>
                Mini Games
            </h1>
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
            <a href="/dashboard" class="back-btn">
                ⬅ Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>