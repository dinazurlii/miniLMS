<!-- resources/views/tictactoe.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            margin: 0;
            padding: 40px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 5px;
            justify-content: center;
            margin: 20px auto;
        }
        .cell {
            width: 100px;
            height: 100px;
            background: white;
            border: 2px solid #333;
            font-size: 36px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .cell:hover {
            background: #f0f0f0;
        }
        .winner {
            color: green;
            font-size: 22px;
            margin-top: 20px;
        }
        .reset-btn, .back-btn {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .reset-btn {
            background-color: #4CAF50;
            color: white;
        }
        .reset-btn:hover {
            background-color: #45a049;
        }
        .back-btn {
            background-color: #555;
            color: white;
            margin-left: 10px;
        }
        .back-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <h1>Tic Tac Toe</h1>
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

    <div class="winner" id="winner"></div>

    <button class="reset-btn" onclick="resetGame()">Restart</button>
    <a href="/mini-games"><button class="back-btn">⬅ Back</button></a>

    <script>
        const cells = document.querySelectorAll(".cell");
        const winnerText = document.getElementById("winner");
        let currentPlayer = "X";
        let gameActive = true;
        let board = ["", "", "", "", "", "", "", "", ""];

        const winningCombinations = [
            [0,1,2], [3,4,5], [6,7,8], // rows
            [0,3,6], [1,4,7], [2,5,8], // cols
            [0,4,8], [2,4,6]           // diagonals
        ];

        cells.forEach(cell => {
            cell.addEventListener("click", () => {
                const index = cell.getAttribute("data-index");

                if (board[index] !== "" || !gameActive) return;

                board[index] = currentPlayer;
                cell.textContent = currentPlayer;

                if (checkWinner()) {
                    winnerText.textContent = `🎉 Player ${currentPlayer} Wins!`;
                    gameActive = false;
                    return;
                }

                if (!board.includes("")) {
                    winnerText.textContent = "😮 It's a Draw!";
                    gameActive = false;
                    return;
                }

                currentPlayer = currentPlayer === "X" ? "O" : "X";
            });
        });

        function checkWinner() {
            return winningCombinations.some(combination => {
                return combination.every(index => board[index] === currentPlayer);
            });
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            cells.forEach(cell => cell.textContent = "");
            currentPlayer = "X";
            gameActive = true;
            winnerText.textContent = "";
        }
    </script>
</body>
</html>
