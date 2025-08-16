<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            padding-top: 50px;
        }
        h1 {
            margin-bottom: 30px;
        }
        .menu-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 600px;
            margin: auto;
        }
        .menu-button {
            background-color: #4CAF50;
            color: white;
            padding: 20px 30px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 220px;
            transition: background-color 0.3s ease;
        }
        .menu-button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>Welcome to the Dashboard</h1>

    <div class="menu-container">
        <a href="/podomoro"><button class="menu-button">Podomoro Timer</button></a>
        <a href="/todo"><button class="menu-button">To Do!</button></a>
        <a id="miniGamesLink" href="/mini-games">
    <button class="menu-button" id="miniGamesBtn">Mini Games</button>
</a>
        <a href="/calculator"><button class="menu-button">Scientific Calculator</button></a>
    </div>   

</body>
</html>
