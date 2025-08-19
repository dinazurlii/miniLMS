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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
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

        .sudoku-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 40px 32px;
            max-width: 600px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240, 0.6);
            position: relative;
            z-index: 1;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sudoku-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .sudoku-container:hover::before {
            left: 100%;
        }

        .sudoku-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .sudoku-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 50px;
            padding: 12px 24px;
            color: #8b5cf6;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 15px rgba(139, 92, 246, 0.1);
        }

        h1 {
            color: #1e293b;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .sudoku-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .game-subtitle {
            color: #64748b;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        .difficulty-selector {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            animation: fadeInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s backwards;
        }

        .difficulty-btn {
            padding: 12px 24px;
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            color: #64748b;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-family: inherit;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .difficulty-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .difficulty-btn:hover {
            background: rgba(139, 92, 246, 0.1);
            border-color: rgba(139, 92, 246, 0.5);
            color: #7c3aed;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(139, 92, 246, 0.2);
        }

        .difficulty-btn:hover::before {
            left: 100%;
        }

        .difficulty-btn.active {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            border-color: rgba(139, 92, 246, 0.5);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .sudoku-board {
            display: grid;
            grid-template-columns: repeat(9, 32px);
            grid-template-rows: repeat(9, 32px);
            gap: 1px;
            background: linear-gradient(135deg, #1e293b, #334155);
            border-radius: 16px;
            padding: 8px;
            margin: 0 auto 32px;
            width: fit-content;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.15),
                0 10px 10px -5px rgba(0, 0, 0, 0.08);
            animation: slideInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.4s backwards;
            position: relative;
        }

        .sudoku-board::before {
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

        .sudoku-board:hover::before {
            left: 100%;
        }

        .cell {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            border-radius: 8px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: inherit;
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
            background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
            transition: left 0.6s;
        }

        .cell:focus {
            background: rgba(139, 92, 246, 0.1);
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 
                0 0 0 2px rgba(139, 92, 246, 0.2),
                0 8px 20px rgba(139, 92, 246, 0.15);
            transform: scale(1.08);
        }

        .cell:focus::before {
            left: 100%;
        }

        .cell:hover:not(:disabled) {
            background: rgba(139, 92, 246, 0.05);
            border-color: rgba(139, 92, 246, 0.3);
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.1);
        }

        .cell:disabled {
            background: rgba(248, 250, 252, 0.9);
            color: #475569;
            font-weight: 700;
            border-color: rgba(226, 232, 240, 0.8);
        }

        /* 3x3 Grid separators - keeping original logic */
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
            animation: fadeInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.6s backwards;
        }

        .control-btn {
            padding: 16px 32px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 8px;
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

        .check-btn {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            color: white;
            box-shadow: 0 8px 20px rgba(72, 187, 120, 0.3);
        }

        .check-btn:hover {
            background: linear-gradient(135deg, #1dd1a1, #48cab2);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(72, 187, 120, 0.4);
        }

        .reset-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #ee5a52, #e74c3c);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255, 107, 107, 0.4);
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

        .message {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            padding: 16px;
            border-radius: 16px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .message.success {
            background: rgba(72, 187, 120, 0.1);
            color: #059669;
            border: 1px solid rgba(72, 187, 120, 0.2);
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.1);
        }

        .message.error {
            background: rgba(255, 107, 107, 0.1);
            color: #dc2626;
            border: 1px solid rgba(255, 107, 107, 0.2);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.1);
        }

        .message.warning {
            background: rgba(255, 159, 243, 0.1);
            color: #d946ef;
            border: 1px solid rgba(255, 159, 243, 0.2);
            box-shadow: 0 4px 12px rgba(255, 159, 243, 0.1);
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
                font-size: 36px;
                flex-direction: column;
                gap: 12px;
            }

            .sudoku-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
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
                max-width: 240px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .sudoku-container {
                padding: 24px 16px;
            }

            h1 {
                font-size: 28px;
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.08);
                box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.3);
            }
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

        .cell.highlight {
            animation: pulse 0.6s ease-in-out;
            background: rgba(139, 92, 246, 0.2);
        }

        .celebration {
            animation: bounce 0.6s ease-in-out;
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

    <div class="sudoku-container">
        <div class="sudoku-header">
            <div class="sudoku-badge">🔢 Logic Puzzle</div>
            <h1>
                <div class="sudoku-icon">🔢</div>
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
                        cell.classList.add('highlight', 'celebration');
                        setTimeout(() => {
                            cell.classList.remove('highlight', 'celebration');
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