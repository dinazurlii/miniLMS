<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
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

        .sudoku-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 40px 32px;
            max-width: 600px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sudoku-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .sudoku-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .sudoku-badge {
            display: inline-block;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
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

        .sudoku-icon {
            font-size: 32px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .game-subtitle {
            color: #6b7280;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .sudoku-board {
            display: grid;
            grid-template-columns: repeat(9, 32px);
            grid-template-rows: repeat(9, 32px);
            gap: 1px;
            background: #1f2937;
            border-radius: 12px;
            padding: 6px;
            margin: 0 auto 32px;
            width: fit-content;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
        }

        .cell {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            border-radius: 4px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cell:focus {
            background: rgba(59, 130, 246, 0.1);
            box-shadow: 
                0 0 0 2px rgba(59, 130, 246, 0.5),
                0 4px 12px rgba(59, 130, 246, 0.2);
            transform: scale(1.05);
        }

        .cell:hover:not(:disabled) {
            background: rgba(59, 130, 246, 0.05);
            transform: scale(1.02);
        }

        .cell:disabled {
            background: rgba(229, 231, 235, 0.8);
            color: #4b5563;
            font-weight: 700;
        }

        /* 3x3 Grid separators - Updated for precise positioning */
        .cell:nth-child(3), .cell:nth-child(6),
        .cell:nth-child(12), .cell:nth-child(15),
        .cell:nth-child(21), .cell:nth-child(24),
        .cell:nth-child(30), .cell:nth-child(33),
        .cell:nth-child(39), .cell:nth-child(42),
        .cell:nth-child(48), .cell:nth-child(51),
        .cell:nth-child(57), .cell:nth-child(60),
        .cell:nth-child(66), .cell:nth-child(69),
        .cell:nth-child(75), .cell:nth-child(78) {
            margin-right: 4px;
        }

        .cell:nth-child(19), .cell:nth-child(20), .cell:nth-child(21),
        .cell:nth-child(22), .cell:nth-child(23), .cell:nth-child(24),
        .cell:nth-child(25), .cell:nth-child(26), .cell:nth-child(27),
        .cell:nth-child(46), .cell:nth-child(47), .cell:nth-child(48),
        .cell:nth-child(49), .cell:nth-child(50), .cell:nth-child(51),
        .cell:nth-child(52), .cell:nth-child(53), .cell:nth-child(54) {
            margin-bottom: 4px;
        }

        .controls {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 24px;
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

        .check-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .check-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
        }

        .reset-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(239, 68, 68, 0.4);
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

        .message {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            padding: 16px;
            border-radius: 12px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .message.success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .message.error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .message.warning {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .difficulty-selector {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .difficulty-btn {
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

        .difficulty-btn:hover,
        .difficulty-btn.active {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
            color: #1d4ed8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .sudoku-container {
                padding: 32px 24px;
            }

            h1 {
                font-size: 28px;
                flex-direction: column;
                gap: 8px;
            }

            .sudoku-board {
                grid-template-columns: repeat(9, 28px);
                grid-template-rows: repeat(9, 28px);
            }

            .cell {
                width: 28px;
                height: 28px;
                font-size: 14px;
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
            .sudoku-container {
                padding: 24px 16px;
            }

            h1 {
                font-size: 24px;
            }

            .sudoku-board {
                grid-template-columns: repeat(9, 24px);
                grid-template-rows: repeat(9, 24px);
            }

            .cell {
                width: 24px;
                height: 24px;
                font-size: 12px;
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .cell.highlight {
            animation: pulse 0.6s ease-in-out;
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
    <div class="sudoku-container">
        <div class="sudoku-header">
            <div class="sudoku-badge">🔢 Logic Puzzle</div>
            <h1>
                <span class="sudoku-icon">🔢</span>
                Sudoku
            </h1>
            <p class="game-subtitle">Fill the 9×9 grid with numbers 1-9</p>
        </div>

        <div class="difficulty-selector">
            <button class="difficulty-btn active" onclick="changeDifficulty('easy')">Easy</button>
            <button class="difficulty-btn" onclick="changeDifficulty('medium')">Medium</button>
            <button class="difficulty-btn" onclick="changeDifficulty('hard')">Hard</button>
        </div>

        <div class="sudoku-board" id="sudokuBoard"></div>

        <div class="controls">
            <button class="control-btn check-btn" onclick="checkSudoku()">
                ✅ <span>Check Solution</span>
            </button>
            <button class="control-btn reset-btn" onclick="resetSudoku()">
                🔄 <span>New Game</span>
            </button>
            <a href="/mini-games" class="control-btn back-btn">
                ⬅️ <span>Back to Menu</span>
            </a>
        </div>

        <div class="message" id="message"></div>
    </div>

    <script>
        const boardElement = document.getElementById("sudokuBoard");
        const messageElement = document.getElementById("message");
        let currentDifficulty = 'easy';

        const puzzles = {
            easy: [
                [5,3,0, 0,7,0, 0,0,0],
                [6,0,0, 1,9,5, 0,0,0],
                [0,9,8, 0,0,0, 0,6,0],
                [8,0,0, 0,6,0, 0,0,3],
                [4,0,0, 8,0,3, 0,0,1],
                [7,0,0, 0,2,0, 0,0,6],
                [0,6,0, 0,0,0, 2,8,0],
                [0,0,0, 4,1,9, 0,0,5],
                [0,0,0, 0,8,0, 0,7,9]
            ],
            medium: [
                [0,0,0, 6,0,0, 4,0,0],
                [7,0,0, 0,0,3, 6,0,0],
                [0,0,0, 0,9,1, 0,8,0],
                [0,0,0, 0,0,0, 0,0,0],
                [0,5,0, 1,8,0, 0,0,3],
                [0,0,0, 3,0,6, 0,4,5],
                [0,4,0, 2,0,0, 0,6,0],
                [9,0,3, 0,0,0, 0,0,0],
                [0,2,0, 0,0,0, 1,0,0]
            ],
            hard: [
                [0,0,0, 0,0,0, 6,8,0],
                [0,0,0, 0,4,6, 0,0,0],
                [7,0,0, 0,0,0, 0,0,9],
                [0,5,0, 0,0,0, 0,0,0],
                [0,0,0, 1,0,6, 0,0,0],
                [3,0,0, 0,0,0, 0,0,0],
                [0,4,0, 0,0,0, 0,0,0],
                [0,0,0, 0,0,0, 0,0,0],
                [0,0,5, 2,0,0, 3,0,0]
            ]
        };

        function changeDifficulty(difficulty) {
            currentDifficulty = difficulty;
            document.querySelectorAll('.difficulty-btn').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            createBoard();
            messageElement.textContent = `Switched to ${difficulty.charAt(0).toUpperCase() + difficulty.slice(1)} mode`;
            messageElement.className = 'message';
            messageElement.style.color = '#6b7280';
            setTimeout(() => {
                messageElement.textContent = '';
            }, 2000);
        }

        function createBoard() {
            boardElement.innerHTML = "";
            const puzzle = puzzles[currentDifficulty];
            
            for (let row = 0; row < 9; row++) {
                for (let col = 0; col < 9; col++) {
                    let input = document.createElement("input");
                    input.type = "text";
                    input.maxLength = 1;
                    input.classList.add("cell");
                    
                    // Add number validation
                    input.addEventListener('input', function(e) {
                        let val = e.target.value;
                        if (!/^[1-9]$/.test(val)) {
                            e.target.value = '';
                        }
                    });

                    // Add highlight effect on focus
                    input.addEventListener('focus', function(e) {
                        e.target.classList.add('highlight');
                        setTimeout(() => {
                            e.target.classList.remove('highlight');
                        }, 600);
                    });

                    if (puzzle[row][col] !== 0) {
                        input.value = puzzle[row][col];
                        input.disabled = true;
                    }

                    boardElement.appendChild(input);
                }
            }
        }

        function checkSudoku() {
            const cells = document.querySelectorAll(".cell");
            let values = [];
            let valid = true;

            // Clear previous message
            messageElement.className = 'message';
            
            for (let i = 0; i < 81; i++) {
                let val = cells[i].value;
                if (val === "" || isNaN(val) || val < 1 || val > 9) {
                    messageElement.textContent = "⚠️ Please fill all cells with numbers 1-9!";
                    messageElement.className = 'message warning';
                    return;
                }
                values.push(parseInt(val));
            }

            // Check rows
            for (let row = 0; row < 9; row++) {
                let rowVals = values.slice(row*9, row*9+9);
                if (new Set(rowVals).size !== 9) {
                    valid = false;
                    break;
                }
            }

            // Check columns
            if (valid) {
                for (let col = 0; col < 9; col++) {
                    let colVals = [];
                    for (let row = 0; row < 9; row++) {
                        colVals.push(values[row*9 + col]);
                    }
                    if (new Set(colVals).size !== 9) {
                        valid = false;
                        break;
                    }
                }
            }

            // Check 3x3 boxes
            if (valid) {
                for (let gridRow = 0; gridRow < 3; gridRow++) {
                    for (let gridCol = 0; gridCol < 3; gridCol++) {
                        let boxVals = [];
                        for (let row = 0; row < 3; row++) {
                            for (let col = 0; col < 3; col++) {
                                boxVals.push(values[(gridRow*3+row)*9 + (gridCol*3+col)]);
                            }
                        }
                        if (new Set(boxVals).size !== 9) {
                            valid = false;
                            break;
                        }
                    }
                    if (!valid) break;
                }
            }

            if (valid) {
                messageElement.textContent = "🎉 Congratulations! You solved the Sudoku!";
                messageElement.className = 'message success';
                
                // Add celebration animation
                cells.forEach((cell, index) => {
                    setTimeout(() => {
                        cell.classList.add('highlight');
                        setTimeout(() => {
                            cell.classList.remove('highlight');
                        }, 600);
                    }, index * 20);
                });
            } else {
                messageElement.textContent = "❌ Solution is incorrect. Keep trying!";
                messageElement.className = 'message error';
            }
        }

        function resetSudoku() {
            createBoard();
            messageElement.textContent = `New ${currentDifficulty} puzzle generated!`;
            messageElement.className = 'message';
            messageElement.style.color = '#6b7280';
            setTimeout(() => {
                messageElement.textContent = '';
            }, 2000);
        }

        // Initialize the game
        createBoard();
    </script>
</body>
</html>