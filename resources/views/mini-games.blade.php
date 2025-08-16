<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Games</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding: 50px;
        }
        h1 {
            margin-bottom: 30px;
            color: #333;
        }
        .games-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 800px;
            margin: auto;
        }
        .game-card {
            background: white;
            padding: 20px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            text-align: center;
        }
        .game-card:hover {
            transform: translateY(-5px);
        }
        .game-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 18px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }
        .game-button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>Mini Games</h1>

    <div class="games-container">
        <div class="game-card">
            <h3>Quiz</h3>
            <a href="/mini-games/quiz"><button class="game-button">Play</button></a>
        </div>

        <div class="game-card">
            <h3>Sudoku</h3>
            <a href="/mini-games/sudoku"><button class="game-button">Play</button></a>
        </div>

        <div class="game-card">
            <h3>Tic Tac Toe</h3>
            <a href="/mini-games/tictactoe"><button class="game-button">Play</button></a>
        </div>
    </div>

    <br><br>
    <a href="/dashboard"><button class="game-button" style="background:#555;">⬅ Back to Dashboard</button></a>

</body>
</html>
