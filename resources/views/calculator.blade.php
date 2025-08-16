<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
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

        .calculator-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 32px;
            max-width: 400px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .calculator-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .calculator-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .calc-badge {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }

        h1 {
            color: #1f2937;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .calc-icon {
            font-size: 24px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .display {
            width: 100%;
            height: 80px;
            font-size: 28px;
            font-weight: 600;
            color: #1f2937;
            text-align: right;
            padding: 20px;
            margin-bottom: 20px;
            border: none;
            border-radius: 16px;
            background: rgba(229, 231, 235, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
            outline: none;
            font-family: 'Monaco', 'Menlo', monospace;
            letter-spacing: 1px;
        }

        .display:focus {
            box-shadow: 
                inset 0 2px 8px rgba(0, 0, 0, 0.1),
                0 0 0 2px rgba(59, 130, 246, 0.3);
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        .calc-btn {
            height: 50px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calc-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .calc-btn:hover::before {
            left: 100%;
        }

        .calc-btn:active {
            transform: scale(0.95);
        }

        /* Number buttons */
        .num-btn {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(229, 231, 235, 0.5);
            color: #1f2937;
        }

        .num-btn:hover {
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* Operator buttons */
        .op-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .op-btn:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        }

        /* Function buttons */
        .func-btn {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .func-btn:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
        }

        /* Clear/Delete buttons */
        .clear-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .clear-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        }

        /* Equal button */
        .equal-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .equal-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        }

        /* Mode button */
        .mode-btn {
            background: rgba(107, 114, 128, 0.1);
            border: 1px solid rgba(107, 114, 128, 0.2);
            color: #374151;
            font-size: 12px;
            font-weight: 700;
        }

        .mode-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .mode-btn.active {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
            color: #1d4ed8;
        }

        .back-section {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid rgba(229, 231, 235, 0.3);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: rgba(107, 114, 128, 0.1);
            backdrop-filter: blur(10px);
            color: #374151;
            text-decoration: none;
            border-radius: 12px;
            border: 1px solid rgba(107, 114, 128, 0.2);
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            color: #1f2937;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .history-section {
            margin-top: 16px;
            max-height: 120px;
            overflow-y: auto;
            background: rgba(229, 231, 235, 0.3);
            border-radius: 12px;
            padding: 12px;
        }

        .history-item {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 12px;
            color: #6b7280;
            padding: 4px 0;
            border-bottom: 1px solid rgba(229, 231, 235, 0.3);
            text-align: right;
        }

        .history-item:last-child {
            border-bottom: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .calculator-container {
                padding: 24px;
                max-width: 350px;
            }

            .display {
                font-size: 24px;
                height: 70px;
                padding: 16px;
            }

            .calc-btn {
                height: 45px;
                font-size: 15px;
            }

            .func-btn {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .calculator-container {
                padding: 20px;
                max-width: 320px;
            }

            .display {
                font-size: 20px;
                height: 60px;
                padding: 12px;
            }

            .calc-btn {
                height: 40px;
                font-size: 14px;
            }

            .func-btn {
                font-size: 11px;
            }

            h1 {
                font-size: 20px;
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

        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }

        .ripple-effect {
            position: relative;
            overflow: hidden;
        }

        .ripple-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            transform-origin: center;
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
    <div class="calculator-container">
        <div class="calculator-header">
            <div class="calc-badge">🔢 Advanced Calculator</div>
            <h1>
                <span class="calc-icon">🧮</span>
                Scientific Calculator
            </h1>
        </div>

        <input type="text" id="display" class="display" readonly placeholder="0">

        <div class="button-grid">
            <!-- Row 1: Clear, Delete, Percentage, Mode -->
            <button class="calc-btn clear-btn" onclick="clearDisplay()">AC</button>
            <button class="calc-btn clear-btn" onclick="deleteChar()">⌫</button>
            <button class="calc-btn op-btn" onclick="appendValue('%')">%</button>
            <button class="calc-btn mode-btn active" onclick="toggleDegRad()" id="modeBtn">DEG</button>

            <!-- Row 2: Constants and Power -->
            <button class="calc-btn func-btn" onclick="appendValue('Math.PI')">π</button>
            <button class="calc-btn func-btn" onclick="appendValue('Math.E')">e</button>
            <button class="calc-btn func-btn" onclick="appendValue('^')">x^y</button>
            <button class="calc-btn func-btn" onclick="appendValue('Math.sqrt(')">√x</button>

            <!-- Row 3: Trigonometry -->
            <button class="calc-btn func-btn" onclick="appendTrig('sin')">sin</button>
            <button class="calc-btn func-btn" onclick="appendTrig('cos')">cos</button>
            <button class="calc-btn func-btn" onclick="appendTrig('tan')">tan</button>
            <button class="calc-btn op-btn" onclick="appendValue('/')">÷</button>

            <!-- Row 4: Inverse Trigonometry -->
            <button class="calc-btn func-btn" onclick="appendTrig('asin')">sin⁻¹</button>
            <button class="calc-btn func-btn" onclick="appendTrig('acos')">cos⁻¹</button>
            <button class="calc-btn func-btn" onclick="appendTrig('atan')">tan⁻¹</button>
            <button class="calc-btn op-btn" onclick="appendValue('*')">×</button>

            <!-- Row 5: Numbers 7,8,9 -->
            <button class="calc-btn num-btn" onclick="appendValue('7')">7</button>
            <button class="calc-btn num-btn" onclick="appendValue('8')">8</button>
            <button class="calc-btn num-btn" onclick="appendValue('9')">9</button>
            <button class="calc-btn op-btn" onclick="appendValue('-')">−</button>

            <!-- Row 6: Numbers 4,5,6 -->
            <button class="calc-btn num-btn" onclick="appendValue('4')">4</button>
            <button class="calc-btn num-btn" onclick="appendValue('5')">5</button>
            <button class="calc-btn num-btn" onclick="appendValue('6')">6</button>
            <button class="calc-btn op-btn" onclick="appendValue('+')">+</button>

            <!-- Row 7: Numbers 1,2,3 -->
            <button class="calc-btn num-btn" onclick="appendValue('1')">1</button>
            <button class="calc-btn num-btn" onclick="appendValue('2')">2</button>
            <button class="calc-btn num-btn" onclick="appendValue('3')">3</button>
            <button class="calc-btn num-btn" onclick="appendValue('(')">(</button>

            <!-- Row 8: 0, decimal, equals, closing parenthesis -->
            <button class="calc-btn num-btn" onclick="appendValue('0')">0</button>
            <button class="calc-btn num-btn" onclick="appendValue('.')">.</button>
            <button class="calc-btn equal-btn" onclick="calculateResult()">=</button>
            <button class="calc-btn num-btn" onclick="appendValue(')')">)</button>
        </div>

        <div class="history-section" id="history" style="display: none;">
            <div id="historyContent"></div>
        </div>

        <div class="back-section">
            <a href="/mini-games" class="back-btn">
                ⬅️ <span>Back to Menu</span>
            </a>
        </div>
    </div>

    <script>
        let isDeg = true;
        let history = [];
        let lastResult = 0;

        function appendValue(val) {
            const display = document.getElementById('display');
            if (display.value === '0' || display.value === 'Error') {
                display.value = val;
            } else {
                display.value += val;
            }
            
            // Add ripple effect
            addRippleEffect(event.target);
        }

        function clearDisplay() {
            document.getElementById('display').value = '0';
            addRippleEffect(event.target);
        }

        function deleteChar() {
            const display = document.getElementById('display');
            if (display.value.length > 1) {
                display.value = display.value.slice(0, -1);
            } else {
                display.value = '0';
            }
            addRippleEffect(event.target);
        }

        function toggleDegRad() {
            isDeg = !isDeg;
            const modeBtn = document.getElementById('modeBtn');
            modeBtn.textContent = isDeg ? 'DEG' : 'RAD';
            modeBtn.classList.toggle('active');
            addRippleEffect(modeBtn);
        }

        function appendTrig(func) {
            const display = document.getElementById('display');
            if (display.value === '0' || display.value === 'Error') {
                display.value = func + '(';
            } else {
                display.value += func + '(';
            }
            addRippleEffect(event.target);
        }

        function calculateResult() {
            const display = document.getElementById('display');
            let expr = display.value.replace(/\^/g, '**');
            const originalExpr = display.value;

            // Handle percentage
            expr = expr.replace(/(\d+)%/g, '($1/100)');

            // Convert DEG to RAD for trig functions
            expr = expr.replace(/(sin|cos|tan|asin|acos|atan)\(/g, (match, fn) => {
                if (isDeg && !fn.startsWith('a')) {
                    return `Math.${fn}((Math.PI/180)*`;
                } else if (isDeg && fn.startsWith('a')) {
                    return `(180/Math.PI)*Math.${fn}(`;
                }
                return `Math.${fn}(`;
            });

            try {
                let result = eval(expr);
                
                // Handle special cases
                if (isNaN(result)) {
                    display.value = 'Error';
                } else if (!isFinite(result)) {
                    display.value = 'Infinity';
                } else {
                    // Round to avoid floating point errors
                    result = Math.round(result * 1e12) / 1e12;
                    display.value = result;
                    lastResult = result;
                    
                    // Add to history
                    addToHistory(originalExpr, result);
                }
            } catch (error) {
                display.value = 'Error';
                console.error('Calculation error:', error);
            }
            
            addRippleEffect(event.target);
        }

        function addToHistory(expression, result) {
            history.unshift({ expression, result });
            
            // Keep only last 10 calculations
            if (history.length > 10) {
                history = history.slice(0, 10);
            }
            
            updateHistoryDisplay();
        }

        function updateHistoryDisplay() {
            const historySection = document.getElementById('history');
            const historyContent = document.getElementById('historyContent');
            
            if (history.length > 0) {
                historySection.style.display = 'block';
                historyContent.innerHTML = history.map(item => 
                    `<div class="history-item">${item.expression} = ${item.result}</div>`
                ).join('');
            }
        }

        function addRippleEffect(button) {
            button.classList.add('ripple-effect');
            setTimeout(() => {
                button.classList.remove('ripple-effect');
            }, 600);
        }

        // Keyboard support
        document.addEventListener('keydown', function(event) {
            const key = event.key;
            
            // Prevent default for calculator keys
            if ('0123456789+-*/().%'.includes(key) || key === 'Enter' || key === 'Escape' || key === 'Backspace') {
                event.preventDefault();
            }
            
            // Handle number and operator keys
            if ('0123456789'.includes(key)) {
                appendValue(key);
            } else if (key === '+') {
                appendValue('+');
            } else if (key === '-') {
                appendValue('-');
            } else if (key === '*') {
                appendValue('*');
            } else if (key === '/') {
                appendValue('/');
            } else if (key === '.') {
                appendValue('.');
            } else if (key === '(' || key === ')') {
                appendValue(key);
            } else if (key === '%') {
                appendValue('%');
            } else if (key === 'Enter' || key === '=') {
                calculateResult();
            } else if (key === 'Escape') {
                clearDisplay();
            } else if (key === 'Backspace') {
                deleteChar();
            }
        });

        // Initialize display
        document.getElementById('display').value = '0';
    </script>
</body>
</html>