<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudoku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            margin: 0;
            padding: 30px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .sudoku-board {
            display: grid;
            grid-template-columns: repeat(9, 40px);
            grid-template-rows: repeat(9, 40px);
            justify-content: center;
            margin: 20px auto;
            border: 3px solid #333;
        }
        .cell {
            width: 40px;
            height: 40px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 18px;
        }
        .cell:focus {
            background: #e6f7ff;
            outline: none;
        }
        .bold-border-right {
            border-right: 3px solid #333 !important;
        }
        .bold-border-bottom {
            border-bottom: 3px solid #333 !important;
        }
        .controls {
            margin-top: 20px;
        }
        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .check-btn {
            background-color: #4CAF50;
            color: white;
        }
        .check-btn:hover {
            background-color: #45a049;
        }
        .reset-btn {
            background-color: #f44336;
            color: white;
        }
        .reset-btn:hover {
            background-color: #d32f2f;
        }
        .back-btn {
            background-color: #555;
            color: white;
        }
        .back-btn:hover {
            background-color: #333;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <h1>Sudoku</h1>
    <div class="sudoku-board" id="sudokuBoard"></div>

    <div class="controls">
        <button class="check-btn" onclick="checkSudoku()">Check</button>
        <button class="reset-btn" onclick="resetSudoku()">Restart</button>
        <a href="/mini-games"><button class="back-btn">⬅ Back</button></a>
    </div>

    <div class="message" id="message"></div>

    <script>
        const boardElement = document.getElementById("sudokuBoard");
        const messageElement = document.getElementById("message");

        // Contoh puzzle Sudoku sederhana (0 = kosong)
        const puzzle = [
            [5,3,0, 0,7,0, 0,0,0],
            [6,0,0, 1,9,5, 0,0,0],
            [0,9,8, 0,0,0, 0,6,0],

            [8,0,0, 0,6,0, 0,0,3],
            [4,0,0, 8,0,3, 0,0,1],
            [7,0,0, 0,2,0, 0,0,6],

            [0,6,0, 0,0,0, 2,8,0],
            [0,0,0, 4,1,9, 0,0,5],
            [0,0,0, 0,8,0, 0,7,9]
        ];

        function createBoard() {
            boardElement.innerHTML = "";
            for (let row = 0; row < 9; row++) {
                for (let col = 0; col < 9; col++) {
                    let input = document.createElement("input");
                    input.type = "text";
                    input.maxLength = 1;
                    input.classList.add("cell");

                    // Bold border untuk grid 3x3
                    if ((col + 1) % 3 === 0 && col !== 8) {
                        input.classList.add("bold-border-right");
                    }
                    if ((row + 1) % 3 === 0 && row !== 8) {
                        input.classList.add("bold-border-bottom");
                    }

                    if (puzzle[row][col] !== 0) {
                        input.value = puzzle[row][col];
                        input.disabled = true;
                        input.style.background = "#eee";
                    }

                    boardElement.appendChild(input);
                }
            }
        }

        function checkSudoku() {
            const cells = document.querySelectorAll(".cell");
            let values = [];
            let valid = true;

            for (let i = 0; i < 81; i++) {
                let val = cells[i].value;
                if (val === "" || isNaN(val) || val < 1 || val > 9) {
                    valid = false;
                    break;
                }
                values.push(parseInt(val));
            }

            if (!valid) {
                messageElement.textContent = "⚠️ Fill all cells with numbers 1-9!";
                messageElement.style.color = "red";
                return;
            }

            // cek baris
            for (let row = 0; row < 9; row++) {
                let rowVals = values.slice(row*9, row*9+9);
                if (new Set(rowVals).size !== 9) {
                    valid = false;
                }
            }

            // cek kolom
            for (let col = 0; col < 9; col++) {
                let colVals = [];
                for (let row = 0; row < 9; row++) {
                    colVals.push(values[row*9 + col]);
                }
                if (new Set(colVals).size !== 9) {
                    valid = false;
                }
            }

            // cek grid 3x3
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
                    }
                }
            }

            if (valid) {
                messageElement.textContent = "🎉 Congratulations! You solved it!";
                messageElement.style.color = "green";
            } else {
                messageElement.textContent = "❌ Wrong solution, try again!";
                messageElement.style.color = "red";
            }
        }

        function resetSudoku() {
            createBoard();
            messageElement.textContent = "";
        }

        // Generate pertama kali
        createBoard();
    </script>
</body>
</html>
