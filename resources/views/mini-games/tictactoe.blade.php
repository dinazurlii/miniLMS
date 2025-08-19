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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            padding: 10px;
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
            opacity: 0.04;
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

        .game-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 24px 20px;
            max-width: 450px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240, 0.6);
            position: relative;
            z-index: 1;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .game-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .game-container:hover::before {
            left: 100%;
        }

        .game-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .game-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(239, 68, 68, 0.2);
            border-radius: 50px;
            padding: 8px 16px;
            color: #ef4444;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 15px rgba(239, 68, 68, 0.1);
        }

        h1 {
            color: #1e293b;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .game-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .game-subtitle {
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 12px;
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
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
            backdrop-filter: blur(5px);
        }

        .game-mode-selector {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            animation: fadeInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
        }

        .mode-btn {
            padding: 8px 16px;
            border: 2px solid rgba(59, 130, 246, 0.2);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            color: #64748b;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-family: inherit;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .mode-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .mode-btn:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
            color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(59, 130, 246, 0.2);
        }

        .mode-btn:hover::before {
            left: 100%;
        }

        .mode-btn.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-color: rgba(59, 130, 246, 0.5);
            color: white;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .score-board {
            display: flex;
            justify-content: space-between;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 12px;
            padding: 12px 8px;
            margin-bottom: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            animation: fadeInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.3s backwards;
        }

        .score-item {
            text-align: center;
            position: relative;
        }

        .score-value {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .score-label {
            font-size: 10px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 6px;
            background: linear-gradient(135deg, #1e293b, #334155);
            border-radius: 16px;
            padding: 8px;
            margin: 16px auto;
            max-width: 280px;
            aspect-ratio: 1;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.15),
                0 10px 10px -5px rgba(0, 0, 0, 0.08);
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.4s backwards;
            position: relative;
        }

        .board::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
            border-radius: 16px;
        }

        .board:hover::before {
            left: 100%;
        }

        .cell {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 12px;
            font-size: 36px;
            font-weight: 700;
            color: #1e293b;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-family: inherit;
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
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(59, 130, 246, 0.15);
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
            animation: scaleIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.2);
        }

        .cell.o {
            color: #3b82f6;
            animation: scaleIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.2);
        }

        .cell.winner {
            background: rgba(72, 187, 120, 0.2);
            border-color: rgba(72, 187, 120, 0.5);
            animation: pulse 1s infinite, celebration 0.6s ease-in-out;
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
        }

        .game-status {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 8px;
            border-radius: 12px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin-bottom: 16px;
            backdrop-filter: blur(5px);
        }

        .game-status.winner {
            background: rgba(72, 187, 120, 0.1);
            color: #059669;
            border: 1px solid rgba(72, 187, 120, 0.2);
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.1);
        }

        .game-status.draw {
            background: rgba(255, 159, 243, 0.1);
            color: #d946ef;
            border: 1px solid rgba(255, 159, 243, 0.2);
            box-shadow: 0 4px 12px rgba(255, 159, 243, 0.1);
        }

        .controls {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.6s backwards;
        }

        .control-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            font-family: inherit;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
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
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            color: white;
            box-shadow: 0 8px 20px rgba(72, 187, 120, 0.3);
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #1dd1a1, #48cab2);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(72, 187, 120, 0.4);
        }

        .back-btn {
            background: rgba(107, 114, 128, 0.1);
            backdrop-filter: blur(10px);
            color: #4b5563;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            color: #374151;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 8px;
            }

            .game-container {
                padding: 20px 16px;
            }

            h1 {
                font-size: 28px;
                flex-direction: column;
                gap: 8px;
            }

            .game-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .board {
                max-width: 240px;
            }

            .cell {
                font-size: 28px;
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
                padding: 16px 12px;
            }

            h1 {
                font-size: 24px;
            }

            .board {
                max-width: 220px;
            }

            .cell {
                font-size: 24px;
            }

            .control-btn {
                padding: 10px 16px;
                font-size: 12px;
            }
        }

        /* Animations */
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

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .celebration {
            animation: bounce 0.6s ease-in-out 3;
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
    <!-- Floating decorations -->
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>

    <div class="game-container">
        <div class="game-header">
            <div class="game-badge">⚡ Strategy Game</div>
            <h1>
                <div class="game-icon">⭕</div>
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