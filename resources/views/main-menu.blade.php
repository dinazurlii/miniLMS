<!-- resources/views/main-menu.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu - Task & Tinker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
            background-color: #f8f8f8;
        }
        h1 {
            margin-bottom: 40px;
        }
        .menu-btn {
            display: block;
            margin: 15px auto;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 12px;
            border: none;
            background-color: #d9d9d9;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            width: 250px;
        }
        .menu-btn:hover {
            background-color: #c0c0c0;
        }
    </style>
</head>
<body>

    <h1>Welcome in Task & Tinker!</h1>

    <form action="/podomoro" method="GET">
        <button class="menu-btn">Podomoro Timer</button>
    </form>

    <form action="/todo" method="GET">
        <button class="menu-btn">To Do!</button>
    </form>

    <form action="/minigames" method="GET">
        <button class="menu-btn">Mini Games</button>
    </form>

    <form action="/calculator" method="GET">
        <button class="menu-btn">Scientific Calculator</button>
    </form>

</body>
</html>
