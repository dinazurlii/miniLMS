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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #f1f5f9 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
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

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            min-height: calc(100vh - 40px);
        }

        /* Left Panel - Form and Stats */
        .left-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(226, 232, 240, 0.6);
            padding: 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Right Panel - Todo List */
        .right-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(226, 232, 240, 0.6);
            padding: 32px;
            display: flex;
            flex-direction: column;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            color: #1e293b;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .header p {
            color: #64748b;
            font-size: 16px;
            font-weight: 400;
        }

        /* Stats Cards Style */
        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.6);
            padding: 20px 16px;
            border-radius: 16px;
            text-align: center;
            backdrop-filter: blur(5px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Add Task Form Style */
        .add-task-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 32px;
            background: rgba(248, 250, 252, 0.8);
            padding: 24px;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .add-task-form:focus-within {
            border-color: rgba(102, 126, 234, 0.5);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }

        .task-input {
            padding: 20px;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 400;
            background: rgba(255, 255, 255, 0.9);
            color: #1e293b;
            outline: none;
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: all 0.3s ease;
        }

        .task-input:focus {
            border-color: rgba(102, 126, 234, 0.5);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .task-input::placeholder {
            color: #94a3b8;
        }

        .add-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 20px 24px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .add-btn:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.4);
        }

        .add-btn:active {
            transform: translateY(0);
        }

        /* Todo List Header */
        .todo-list-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }

        .todo-list-header h2 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .task-count {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Todo List Items Style */
        .todo-list {
            list-style: none;
            flex: 1;
            overflow-y: auto;
            max-height: calc(100vh - 200px);
            padding-right: 8px;
        }

        .todo-list::-webkit-scrollbar {
            width: 6px;
        }

        .todo-list::-webkit-scrollbar-track {
            background: rgba(226, 232, 240, 0.3);
            border-radius: 3px;
        }

        .todo-list::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.3);
            border-radius: 3px;
        }

        .todo-list::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.5);
        }

        .todo-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            margin-bottom: 12px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            backdrop-filter: blur(5px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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
            background: linear-gradient(to bottom, #667eea, #764ba2);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .todo-item:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .todo-item:hover::before {
            transform: scaleY(1);
        }

        .todo-item.completed {
            background: rgba(72, 187, 120, 0.05);
            border-color: rgba(72, 187, 120, 0.2);
        }

        .todo-item.completed::before {
            background: linear-gradient(to bottom, #48bb78, #38a169);
            transform: scaleY(1);
        }

        .todo-checkbox {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            border: 2px solid #d1d5db;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            flex-shrink: 0;
            appearance: none;
        }

        .todo-checkbox:checked {
            background: linear-gradient(135deg, #48bb78, #38a169);
            border-color: #48bb78;
        }

        .todo-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .todo-text {
            flex: 1;
            font-size: 16px;
            font-weight: 500;
            color: #1e293b;
            line-height: 1.5;
            transition: all 0.3s ease;
        }

        .todo-text.done {
            text-decoration: line-through;
            color: #94a3b8;
            opacity: 0.7;
        }

        .todo-status {
            font-size: 12px;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgba(255, 107, 107, 0.15);
            color: #dc2626;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .status-completed {
            background: rgba(72, 187, 120, 0.15);
            color: #059669;
            border: 1px solid rgba(72, 187, 120, 0.3);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 24px;
            background: rgba(107, 114, 128, 0.1);
            color: #4b5563;
            text-decoration: none;
            border-radius: 16px;
            border: 1px solid rgba(107, 114, 128, 0.2);
            font-weight: 600;
            font-size: 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            margin-top: 16px;
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            color: #374151;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
            color: #64748b;
        }

        .empty-state p {
            font-size: 16px;
            line-height: 1.5;
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: 5%;
            left: 3%;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #48bb78, #38a169);
            top: 15%;
            right: 5%;
            animation-delay: 2s;
        }

        .floating-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            bottom: 20%;
            left: 2%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            .main-container {
                grid-template-columns: 1fr;
                gap: 16px;
                min-height: auto;
            }

            .left-panel, .right-panel {
                padding: 24px;
                border-radius: 16px;
            }

            .header h1 {
                font-size: 28px;
                flex-direction: column;
                gap: 12px;
            }

            .header-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
                margin-bottom: 24px;
            }

            .stat-number {
                font-size: 24px;
            }

            .add-task-form {
                padding: 20px;
            }

            .task-input, .add-btn {
                padding: 16px;
            }

            .todo-list {
                max-height: 60vh;
            }

            .todo-item {
                padding: 16px;
            }
        }

        /* Animation */
        .main-container {
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
    <!-- Floating decorations -->
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>

    <div class="main-container">
        <!-- Left Panel - Form and Stats -->
        <div class="left-panel">
            <div>
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
                        <div class="stat-number" id="totalTasks">5</div>
                        <div class="stat-label">Total</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="completedTasks">2</div>
                        <div class="stat-label">Done</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="pendingTasks">3</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>

                <!-- Add Task Form -->
                <div class="add-task-form">
                    <input type="text" 
                           name="task" 
                           class="task-input"
                           placeholder="What needs to be done?"
                           required
                           autocomplete="off">
                    <button type="submit" class="add-btn" onclick="addTask()">
                        ➕ Add Task
                    </button>
                </div>
            </div>

            <!-- Back Button -->
            <a href="dashboard" class="back-btn">
                ← Back to Dashboard
            </a>
        </div>

        <!-- Right Panel - Todo List -->
        <div class="right-panel">
            <div class="todo-list-header">
                <h2>Your Tasks</h2>
                <div class="task-count" id="taskCount">5 items</div>
            </div>

            <!-- Todo List -->
            <ul class="todo-list" id="todoList">
                <li class="todo-item completed">
                    <input type="checkbox" class="todo-checkbox" checked onchange="toggleTask(this)">
                    <span class="todo-text done">Complete project documentation</span>
                    <div class="todo-status status-completed">Done</div>
                </li>
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox" onchange="toggleTask(this)">
                    <span class="todo-text">Review team performance metrics</span>
                    <div class="todo-status status-pending">Pending</div>
                </li>
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox" onchange="toggleTask(this)">
                    <span class="todo-text">Prepare presentation for client meeting</span>
                    <div class="todo-status status-pending">Pending</div>
                </li>
                <li class="todo-item completed">
                    <input type="checkbox" class="todo-checkbox" checked onchange="toggleTask(this)">
                    <span class="todo-text done">Update website content</span>
                    <div class="todo-status status-completed">Done</div>
                </li>
                <li class="todo-item">
                    <input type="checkbox" class="todo-checkbox" onchange="toggleTask(this)">
                    <span class="todo-text">Schedule team building activity</span>
                    <div class="todo-status status-pending">Pending</div>
                </li>
            </ul>
        </div>
    </div>

    <script>
        let tasks = [
            { id: 1, text: "Complete project documentation", completed: true },
            { id: 2, text: "Review team performance metrics", completed: false },
            { id: 3, text: "Prepare presentation for client meeting", completed: false },
            { id: 4, text: "Update website content", completed: true },
            { id: 5, text: "Schedule team building activity", completed: false }
        ];

        function updateStats() {
            const total = tasks.length;
            const completed = tasks.filter(task => task.completed).length;
            const pending = total - completed;

            document.getElementById('totalTasks').textContent = total;
            document.getElementById('completedTasks').textContent = completed;
            document.getElementById('pendingTasks').textContent = pending;
            document.getElementById('taskCount').textContent = `${total} item${total !== 1 ? 's' : ''}`;
        }

        function addTask() {
            const input = document.querySelector('.task-input');
            const text = input.value.trim();
            
            if (text) {
                const newTask = {
                    id: Date.now(),
                    text: text,
                    completed: false
                };
                
                tasks.push(newTask);
                
                const todoList = document.getElementById('todoList');
                const li = document.createElement('li');
                li.className = 'todo-item';
                li.innerHTML = `
                    <input type="checkbox" class="todo-checkbox" onchange="toggleTask(this)">
                    <span class="todo-text">${text}</span>
                    <div class="todo-status status-pending">Pending</div>
                `;
                
                todoList.appendChild(li);
                input.value = '';
                updateStats();
                
                // Add animation
                li.style.opacity = '0';
                li.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    li.style.transition = 'all 0.5s ease';
                    li.style.opacity = '1';
                    li.style.transform = 'translateX(0)';
                }, 10);
            }
        }

        function toggleTask(checkbox) {
            const todoItem = checkbox.closest('.todo-item');
            const todoText = todoItem.querySelector('.todo-text');
            const statusBadge = todoItem.querySelector('.todo-status');
            
            if (checkbox.checked) {
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
            
            // Update tasks array
            const taskText = todoText.textContent;
            const task = tasks.find(t => t.text === taskText);
            if (task) {
                task.completed = checkbox.checked;
            }
            
            updateStats();
        }

        // Handle Enter key in input
        document.querySelector('.task-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTask();
            }
        });

        // Auto-focus on input when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const taskInput = document.querySelector('.task-input');
            if (taskInput) {
                taskInput.focus();
            }
            updateStats();
        });
    </script>
</body>
</html>