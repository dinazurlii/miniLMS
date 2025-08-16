<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
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
                radial-gradient(circle at 20% 30%, rgba(139, 92, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .game-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 40px 32px;
            max-width: 500px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .game-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .game-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .game-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        h1 {
            color: #1f2937;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .game-icon {
            font-size: 32px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .game-subtitle {
            color: #6b7280;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .current-player {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #1d4ed8;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
        }

        .board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 8px;
            background: #1f2937;
            border-radius: 16px;
            padding: 8px;
            margin: 32px auto;
            max-width: 320px;
            aspect-ratio: 1;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
        }

        .cell {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 12px;
            font-size: 48px;
            font-weight: 700;
            color: #1f2937;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .cell::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.6s;
        }

        .cell:hover:not(.filled) {
            background: rgba(59, 130, 246, 0.05);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
        }

        .cell:hover:not(.filled)::before {
            left: 100%;
        }

        .cell:active:not(.filled) {
            transform: scale(0.98);
        }

        .cell.filled {
            cursor: not-allowed;
        }

        .cell.x {
            color: #ef4444;
            animation: scaleIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .cell.o {
            color: #3b82f6;
            animation: scaleIn 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .cell.winner {
            background: rgba(16, 185, 129, 0.2);
            animation: pulse 1s infinite;
        }

        .game-status {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            padding: 16px;
            border-radius: 12px;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin-bottom: 24px;
        }

        .game-status.winner {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .game-status.draw {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .controls {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .control-btn {
            padding: 16px 32px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .control-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .control-btn:hover::before {
            left: 100%;
        }

        .reset-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
        }

        .back-btn {
            background: rgba(107, 114, 128, 0.1);
            backdrop-filter: blur(10px);
            color: #374151;
            border: 1px solid rgba(107, 114, 128, 0.2);
            text-decoration: none;
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .game-mode-selector {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .mode-btn {
            padding: 8px 20px;
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.8);
            color: #374151;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .mode-btn:hover,
        .mode-btn.active {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
            color: #1d4ed8;
        }

        .score-board {
            display: flex;
            justify-content: space-between;
            background: rgba(229, 231, 235, 0.5);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .score-item {
            text-align: center;
        }

        .score-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .score-label {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .game-container {
                padding: 32px 24px;
            }

            h1 {
                font-size: 28px;
                flex-direction: column;
                gap: 8px;
            }

            .board {
                max-width: 280px;
            }

            .cell {
                font-size: 36px;
            }

            .controls {
                flex-direction: column;
                align-items: center;
            }

            .control-btn {
                width: 100%;
                max-width: 200px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .game-container {
                padding: 24px 16px;
            }

            h1 {
                font-size: 24px;
            }

            .board {
                max-width: 240px;
            }

            .cell {
                font-size: 32px;
            }

            .control-btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }

        /* Animations */
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

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        @keyframes celebrate {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
        }

        .celebration {
            animation: celebrate 0.5s ease-in-out 3;
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
    <div class="game-container">
        <div class="game-header">
            <div class="game-badge">⚡ Strategy Game</div>
            <h1>
                <span class="game-icon">⭕</span>
                Tic Tac Toe
            </h1>
            <p class="game-subtitle">Get three in a row to win!</p>
            <div class="current-player" id="currentPlayer">Player X's Turn</div>
        </div>

        <div class="game-mode-selector">
            <button class="mode-btn active" onclick="changeMode('pvp')">Player vs Player</button>
            <button class="mode-btn" onclick="changeMode('ai')">Player vs AI</button>
        </div>

        <div class="score-board">
            <div class="score-item">
                <div class="score-value" id="scoreX">0</div>
                <div class="score-label">Player X</div>
            </div>
            <div class="score-item">
                <div class="score-value" id="scoreDraw">0</div>
                <div class="score-label">Draws</div>
            </div>
            <div class="score-item">
                <div class="score-value" id="scoreO">0</div>
                <div class="score-label">Player O</div>
            </div>
        </div>

        <div class="board" id="board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>

        <div class="game-status" id="gameStatus"></div>

        <div class="controls">
            <button class="control-btn reset-btn" onclick="resetGame()">
                🔄 <span>New Round</span>
            </button>
            <a href="/mini-games" class="control-btn back-btn">
                ⬅️ <span>Back to Menu</span>
            </a>
        </div>
    </div>

    <script>
        const cells = document.querySelectorAll(".cell");
        const gameStatus = document.getElementById("gameStatus");
        const currentPlayerEl = document.getElementById("currentPlayer");
        const gameContainer = document.querySelector(".game-container");
        
        let currentPlayer = "X";
        let gameActive = true;
        let gameMode = "pvp"; // pvp or ai
        let board = ["", "", "", "", "", "", "", "", ""];
        let scores = { X: 0, O: 0, draw: 0 };

        const winningCombinations = [
            [0,1,2], [3,4,5], [6,7,8], // rows
            [0,3,6], [1,4,7], [2,5,8], // cols
            [0,4,8], [2,4,6]           // diagonals
        ];

        function updateCurrentPlayer() {
            if (gameActive) {
                if (gameMode === "ai" && currentPlayer === "O") {
                    currentPlayerEl.textContent = "AI's Turn";
                } else {
                    currentPlayerEl.textContent = `Player ${currentPlayer}'s Turn`;
                }
            }
        }

        function changeMode(mode) {
            gameMode = mode;
            document.querySelectorAll('.mode-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            resetGame();
            
            if (mode === "ai") {
                document.querySelector('.score-item:last-child .score-label').textContent = "AI";
            } else {
                document.querySelector('.score-item:last-child .score-label').textContent = "Player O";
            }
        }

        function updateScoreboard() {
            document.getElementById("scoreX").textContent = scores.X;
            document.getElementById("scoreO").textContent = scores.O;
            document.getElementById("scoreDraw").textContent = scores.draw;
        }

        function makeAIMove() {
            if (!gameActive || gameMode !== "ai" || currentPlayer !== "O") return;
            
            setTimeout(() => {
                // Simple AI: Try to win, then block, then random
                let move = findBestMove();
                if (move !== -1) {
                    const cell = document.querySelector(`[data-index="${move}"]`);
                    makeMove(cell, move);
                }
            }, 500);
        }

        function findBestMove() {
            // Try to win
            for (let combo of winningCombinations) {
                const [a, b, c] = combo;
                if (board[a] === "O" && board[b] === "O" && board[c] === "") return c;
                if (board[a] === "O" && board[c] === "O" && board[b] === "") return b;
                if (board[b] === "O" && board[c] === "O" && board[a] === "") return a;
            }
            
            // Try to block
            for (let combo of winningCombinations) {
                const [a, b, c] = combo;
                if (board[a] === "X" && board[b] === "X" && board[c] === "") return c;
                if (board[a] === "X" && board[c] === "X" && board[b] === "") return b;
                if (board[b] === "X" && board[c] === "X" && board[a] === "") return a;
            }
            
            // Take center
            if (board[4] === "") return 4;
            
            // Take corners
            const corners = [0, 2, 6, 8];
            const availableCorners = corners.filter(i => board[i] === "");
            if (availableCorners.length > 0) {
                return availableCorners[Math.floor(Math.random() * availableCorners.length)];
            }
            
            // Take any available
            const available = board.map((cell, index) => cell === "" ? index : -1).filter(i => i !== -1);
            return available.length > 0 ? available[Math.floor(Math.random() * available.length)] : -1;
        }

        function makeMove(cell, index) {
            if (board[index] !== "" || !gameActive) return;

            board[index] = currentPlayer;
            cell.textContent = currentPlayer;
            cell.classList.add("filled", currentPlayer.toLowerCase());

            if (checkWinner()) {
                const winnerCombination = getWinnerCombination();
                highlightWinnerCells(winnerCombination);
                
                gameStatus.textContent = gameMode === "ai" && currentPlayer === "O" ? 
                    "🤖 AI Wins!" : `🎉 Player ${currentPlayer} Wins!`;
                gameStatus.className = "game-status winner";
                gameActive = false;
                scores[currentPlayer]++;
                updateScoreboard();
                gameContainer.classList.add('celebration');
                setTimeout(() => gameContainer.classList.remove('celebration'), 1500);
                return;
            }

            if (!board.includes("")) {
                gameStatus.textContent = "🤝 It's a Draw!";
                gameStatus.className = "game-status draw";
                gameActive = false;
                scores.draw++;
                updateScoreboard();
                return;
            }

            currentPlayer = currentPlayer === "X" ? "O" : "X";
            updateCurrentPlayer();
            
            // Make AI move if it's AI mode
            if (gameMode === "ai" && currentPlayer === "O") {
                makeAIMove();
            }
        }

        function getWinnerCombination() {
            return winningCombinations.find(combination => {
                return combination.every(index => board[index] === currentPlayer);
            });
        }

        function highlightWinnerCells(combination) {
            combination.forEach(index => {
                cells[index].classList.add('winner');
            });
        }

        function checkWinner() {
            return winningCombinations.some(combination => {
                return combination.every(index => board[index] === currentPlayer);
            });
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            cells.forEach(cell => {
                cell.textContent = "";
                cell.className = "cell";
            });
            currentPlayer = "X";
            gameActive = true;
            gameStatus.textContent = "";
            gameStatus.className = "game-status";
            updateCurrentPlayer();
        }

        // Add click listeners
        cells.forEach(cell => {
            cell.addEventListener("click", () => {
                const index = parseInt(cell.getAttribute("data-index"));
                
                // Only allow human moves in AI mode when it's X turn
                if (gameMode === "ai" && currentPlayer === "O") return;
                
                makeMove(cell, index);
            });
        });

        // Initialize
        updateCurrentPlayer();
        updateScoreboard();
    </script>
</body>
</html>