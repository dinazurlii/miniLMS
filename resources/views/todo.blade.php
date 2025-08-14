<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        h1 { font-size: 24px; }
        form {
            display: flex;
            margin-bottom: 15px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #d3d3d3;
            font-size: 16px;
        }
        button {
            margin-left: 10px;
            padding: 10px 20px;
            background: #d3d3d3;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }
        ul {
            padding: 0;
            list-style: none;
        }
        li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 0;
        }
        a {
            text-decoration: none;
            font-size: 18px;
        }
        .done {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>
<body>
<div class="container">
    
    <h1>To Do!</h1>
    <p>Manage your to do list</p>

    <form action="{{ route('todo.store') }}" method="POST">
        @csrf
        <input type="text" name="task" placeholder="Add new task">
        <button type="submit">ADD</button>
    </form>

    <ul>
         @foreach($todos as $todo)
        <li>
            <form action="{{ route('todo.toggle', $todo->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input type="checkbox" 
                       name="is_done" 
                       onchange="this.form.submit()" 
                       {{ $todo->is_done ? 'checked' : '' }}>
            </form>
            <span class="{{ $todo->is_done ? 'done' : '' }}">{{ $todo->task }}</span>
        </li>
    @endforeach
    </ul>
    <a href="{{ route('dashboard') }}" style="
    display: inline-block;
    padding: 8px 16px;
    background-color: #d3d3d3;
    border-radius: 8px;
    text-decoration: none;
    color: black;
    font-weight: bold;
    margin-bottom: 15px;
">
    ← Back to Dashboard
</a>

</div>
</body>
</html>
