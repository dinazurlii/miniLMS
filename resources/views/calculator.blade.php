<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator - Task & Tinker</title>
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
            padding: 10px;
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
            opacity: 0.06;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        .floating-decoration:nth-child(1) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            top: 25%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            bottom: 30%;
            left: 8%;
            animation-delay: 4s;
        }

        .floating-decoration:nth-child(4) {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            bottom: 20%;
            right: 12%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        .calculator-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 20px;
            max-width: 380px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240, 0.6);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
        }

        .calculator-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .calculator-container:hover::before {
            left: 100%;
        }

        .calculator-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .logo-container {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 8px 16px rgba(72, 202, 178, 0.25);
        }

        .brand-text {
            font-size: 18px;
            font-weight: 700;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .calc-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(72, 202, 178, 0.2);
            border-radius: 50px;
            padding: 4px 12px;
            color: #48cab2;
            font-size: 10px;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 12px rgba(72, 202, 178, 0.1);
        }

        .display {
            width: 100%;
            height: 60px;
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            text-align: right;
            padding: 16px;
            margin-bottom: 16px;
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.06),
                0 0 0 1px rgba(226, 232, 240, 0.5);
            outline: none;
            font-family: 'Monaco', 'Menlo', monospace;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .display:focus {
            box-shadow: 
                inset 0 2px 4px rgba(0, 0, 0, 0.06),
                0 0 0 2px rgba(72, 202, 178, 0.3);
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
        }

        .calc-btn {
            height: 42px;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .calc-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .calc-btn:hover::before {
            left: 100%;
        }

        .calc-btn:hover {
            transform: translateY(-2px) scale(1.02);
        }

        .calc-btn:active {
            transform: translateY(0) scale(0.98);
        }

        /* Number buttons - Task & Tinker style */
        .num-btn {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.6);
            color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);
        }

        .num-btn:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(120, 119, 198, 0.3);
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.12);
        }

        /* Operator buttons - Orange gradient like dashboard */
        .op-btn {
            background: linear-gradient(135deg, #ff6b6b, #ff8787);
            color: white;
            border: 1px solid rgba(255, 107, 107, 0.3);
            box-shadow: 0 8px 15px rgba(255, 107, 107, 0.25);
        }

        .op-btn:hover {
            background: linear-gradient(135deg, #ff5252, #ff6b6b);
            box-shadow: 0 12px 20px rgba(255, 107, 107, 0.35);
        }

        /* Function buttons - Purple gradient like dashboard */
        .func-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 11px;
            border: 1px solid rgba(102, 126, 234, 0.3);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.25);
        }

        .func-btn:hover {
            background: linear-gradient(135deg, #5a67d8, #667eea);
            box-shadow: 0 12px 20px rgba(102, 126, 234, 0.35);
        }

        /* Clear/Delete buttons - Pink gradient */
        .clear-btn {
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            color: white;
            border: 1px solid rgba(255, 159, 243, 0.3);
            box-shadow: 0 8px 15px rgba(255, 159, 243, 0.25);
        }

        .clear-btn:hover {
            background: linear-gradient(135deg, #f368e0, #e056fd);
            box-shadow: 0 12px 20px rgba(255, 159, 243, 0.35);
        }

        /* Equal button - Green gradient like dashboard */
        .equal-btn {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            color: white;
            border: 1px solid rgba(72, 202, 178, 0.3);
            box-shadow: 0 8px 15px rgba(72, 202, 178, 0.25);
        }

        .equal-btn:hover {
            background: linear-gradient(135deg, #38b2ac, #48cab2);
            box-shadow: 0 12px 20px rgba(72, 202, 178, 0.35);
        }

        /* Mode button */
        .mode-btn {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(100, 116, 139, 0.3);
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);
        }

        .mode-btn:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #475569;
        }

        .mode-btn.active {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            border-color: rgba(72, 202, 178, 0.3);
            color: white;
            box-shadow: 0 8px 15px rgba(72, 202, 178, 0.25);
        }

        .back-section {
            text-align: center;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid rgba(226, 232, 240, 0.3);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: #64748b;
            text-decoration: none;
            border-radius: 10px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            font-weight: 600;
            font-size: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            color: #475569;
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.12);
        }

        .history-section {
            margin-top: 12px;
            max-height: 80px;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 8px;
            border: 1px solid rgba(226, 232, 240, 0.4);
        }

        .history-item {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 10px;
            color: #64748b;
            padding: 4px 0;
            border-bottom: 1px solid rgba(226, 232, 240, 0.3);
            text-align: right;
        }

        .history-item:last-child {
            border-bottom: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 8px;
            }

            .calculator-container {
                padding: 16px;
                max-width: 320px;
            }

            .display {
                font-size: 18px;
                height: 55px;
                padding: 12px;
            }

            .calc-btn {
                height: 38px;
                font-size: 12px;
            }

            .func-btn {
                font-size: 10px;
            }

            .brand-text {
                font-size: 16px;
            }

            .logo-container {
                width: 28px;
                height: 28px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .calculator-container {
                padding: 14px;
                max-width: 300px;
            }

            .display {
                font-size: 16px;
                height: 50px;
                padding: 10px;
            }

            .calc-btn {
                height: 36px;
                font-size: 11px;
            }

            .func-btn {
                font-size: 9px;
            }

            .brand-text {
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
            background: rgba(255, 255, 255, 0.6);
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
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    <div class="floating-decoration"></div>
    
    <div class="calculator-container">
        <div class="calculator-header">
            <div class="brand-section">
                <div class="logo-container">🧮</div>
                <div class="brand-text">Calculator</div>
            </div>
            <div class="calc-badge">✨ Scientific Calculator</div>
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
            <a href="javascript:history.back()" class="back-btn" onclick="goBackToDashboard()">
                ← <span>Back to Dashboard</span>
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

        // Back to dashboard function
        function goBackToDashboard() {
            // Try to go back to the previous page (dashboard)
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // If no history, redirect to dashboard
                window.location.href = '/dashboard' || '../dashboard' || 'index.html';
            }
        }
    </script>
</body>
</html>