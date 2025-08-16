<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
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
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 25% 35%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 75% 65%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
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

        .header-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .header p {
            color: #6b7280;
            font-size: 16px;
            font-weight: 400;
        }

        .add-task-form {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            background: #f8fafc;
            padding: 8px;
            border-radius: 20px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .add-task-form:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .task-input {
            flex: 1;
            padding: 16px 20px;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 400;
            background: transparent;
            color: #1f2937;
            outline: none;
        }

        .task-input::placeholder {
            color: #9ca3af;
        }

        .add-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            white-space: nowrap;
        }

        .add-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .add-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.4);
        }

        .add-btn:hover::before {
            left: 100%;
        }

        .add-btn:active {
            transform: translateY(0);
        }

        .todo-list {
            list-style: none;
            margin-bottom: 32px;
        }

        .todo-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            margin-bottom: 12px;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .todo-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, #3b82f6, #1d4ed8);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .todo-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .todo-item:hover::before {
            transform: scaleY(1);
        }

        .todo-item.completed {
            background: #f0f9ff;
            border-color: #bae6fd;
        }

        .todo-item.completed::before {
            background: linear-gradient(to bottom, #10b981, #059669);
            transform: scaleY(1);
        }

        .todo-checkbox {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 2px solid #d1d5db;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            flex-shrink: 0;
        }

        .todo-checkbox:checked {
            background: linear-gradient(135deg, #10b981, #059669);
            border-color: #10b981;
        }

        .todo-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .todo-text {
            flex: 1;
            font-size: 16px;
            font-weight: 500;
            color: #1f2937;
            line-height: 1.5;
            transition: all 0.3s ease;
        }

        .todo-text.done {
            text-decoration: line-through;
            color: #9ca3af;
            opacity: 0.7;
        }

        .todo-status {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: rgba(107, 114, 128, 0.1);
            color: #4b5563;
            text-decoration: none;
            border-radius: 16px;
            border: 1px solid rgba(107, 114, 128, 0.2);
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-1px);
            color: #374151;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #6b7280;
        }

        .empty-state p {
            font-size: 16px;
            line-height: 1.5;
        }

        .stats {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            justify-content: center;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 16px 20px;
            border-radius: 16px;
            text-align: center;
            border: 1px solid #e2e8f0;
            min-width: 100px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .container {
                padding: 24px 20px;
                border-radius: 20px;
                margin: 10px;
            }

            .header h1 {
                font-size: 28px;
            }

            .add-task-form {
                flex-direction: column;
                gap: 12px;
            }

            .add-btn {
                padding: 14px 20px;
            }

            .todo-item {
                padding: 16px;
            }

            .stats {
                flex-direction: column;
                gap: 12px;
            }

            .stat-card {
                padding: 12px 16px;
            }
        }

        /* Animation */
        .container {
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .todo-item {
            animation: slideInLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .todo-item:nth-child(1) { animation-delay: 0.1s; }
        .todo-item:nth-child(2) { animation-delay: 0.2s; }
        .todo-item:nth-child(3) { animation-delay: 0.3s; }
        .todo-item:nth-child(4) { animation-delay: 0.4s; }
        .todo-item:nth-child(n+5) { animation-delay: 0.5s; }

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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
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
    <div class="container">
        <div class="header">
            <h1>
                <div class="header-icon">✓</div>
                To Do!
            </h1>
            <p>Organize your tasks and boost productivity</p>
        </div>

        <!-- Stats Section -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number" id="totalTasks">{{ count($todos) }}</div>
                <div class="stat-label">Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="completedTasks">{{ $todos->where('is_done', true)->count() }}</div>
                <div class="stat-label">Done</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="pendingTasks">{{ $todos->where('is_done', false)->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>

        <!-- Add Task Form -->
        <form action="{{ route('todo.store') }}" method="POST" class="add-task-form">
            @csrf
            <input type="text" 
                   name="task" 
                   class="task-input"
                   placeholder="What needs to be done?"
                   required
                   autocomplete="off">
            <button type="submit" class="add-btn">
                ➕ Add Task
            </button>
        </form>

        <!-- Todo List -->
        <ul class="todo-list">
            @forelse($todos as $todo)
                <li class="todo-item {{ $todo->is_done ? 'completed' : '' }}">
                    <form action="{{ route('todo.toggle', $todo->id) }}" method="POST" style="display: flex; align-items: center;">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" 
                               name="is_done" 
                               class="todo-checkbox"
                               onchange="this.form.submit()" 
                               {{ $todo->is_done ? 'checked' : '' }}>
                    </form>
                    <span class="todo-text {{ $todo->is_done ? 'done' : '' }}">
                        {{ $todo->task }}
                    </span>
                    <div class="todo-status {{ $todo->is_done ? 'status-completed' : 'status-pending' }}">
                        {{ $todo->is_done ? 'Done' : 'Pending' }}
                    </div>
                </li>
            @empty
                <li class="empty-state">
                    <div class="empty-state-icon">📝</div>
                    <h3>No tasks yet</h3>
                    <p>Add your first task above to get started with your productivity journey!</p>
                </li>
            @endforelse
        </ul>

        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="back-btn">
            ⬅ Back to Dashboard
        </a>
    </div>

    <script>
        // Add subtle interactions
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.todo-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const todoItem = this.closest('.todo-item');
                    const todoText = todoItem.querySelector('.todo-text');
                    const statusBadge = todoItem.querySelector('.todo-status');
                    
                    if (this.checked) {
                        todoItem.classList.add('completed');
                        todoText.classList.add('done');
                        statusBadge.textContent = 'Done';
                        statusBadge.className = 'todo-status status-completed';
                    } else {
                        todoItem.classList.remove('completed');
                        todoText.classList.remove('done');
                        statusBadge.textContent = 'Pending';
                        statusBadge.className = 'todo-status status-pending';
                    }
                });
            });

            // Auto-focus on input when page loads
            const taskInput = document.querySelector('.task-input');
            if (taskInput) {
                taskInput.focus();
            }
        });
    </script>
</body>
</html>