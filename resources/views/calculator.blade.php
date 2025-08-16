<!DOCTYPE html>
<html>
<head>
    <title>Scientific Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .calculator { display: inline-block; padding: 20px; background: white; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2); }
        input { width: 100%; font-size: 24px; text-align: right; margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 65px; height: 45px; margin: 3px; font-size: 16px; border-radius: 5px; border: none; background-color: #f0f0f0; cursor: pointer; }
        button:hover { background-color: #ddd; }
        .top-row button { background-color: #ff9800; color: white; }
        .equal { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h2>Scientific Calculator</h2>
    <div class="calculator">
        <input type="text" id="display" readonly>
        <div class="top-row">
            <button onclick="clearDisplay()">AC</button>
            <button onclick="deleteChar()">⌫</button>
            <button onclick="appendValue('%')">%</button>
            <button onclick="toggleDegRad()" id="modeBtn">DEG</button>
        </div>
        <div>
            <button onclick="appendValue('Math.PI')">π</button>
            <button onclick="appendValue('Math.E')">e</button>
            <button onclick="appendValue('^')">xʸ</button>
            <button onclick="appendValue('Math.sqrt(')">√</button>
        </div>
        <div>
            <button onclick="appendTrig('sin')">sin</button>
            <button onclick="appendTrig('cos')">cos</button>
            <button onclick="appendTrig('tan')">tan</button>
            <button onclick="appendValue('/')">÷</button>
        </div>
        <div>
            <button onclick="appendTrig('asin')">asin</button>
            <button onclick="appendTrig('acos')">acos</button>
            <button onclick="appendTrig('atan')">atan</button>
            <button onclick="appendValue('*')">×</button>
        </div>
        <div>
            <button onclick="appendValue('7')">7</button>
            <button onclick="appendValue('8')">8</button>
            <button onclick="appendValue('9')">9</button>
            <button onclick="appendValue('-')">−</button>
        </div>
        <div>
            <button onclick="appendValue('4')">4</button>
            <button onclick="appendValue('5')">5</button>
            <button onclick="appendValue('6')">6</button>
            <button onclick="appendValue('+')">+</button>
        </div>
        <div>
            <button onclick="appendValue('1')">1</button>
            <button onclick="appendValue('2')">2</button>
            <button onclick="appendValue('3')">3</button>
            <button onclick="appendValue('(')">(</button>
        </div>
        <div>
            <button onclick="appendValue('0')">0</button>
            <button onclick="appendValue('.')">.</button>
            <button onclick="calculateResult()" class="equal">=</button>
            <button onclick="appendValue(')')">)</button>
        </div>
    </div>

    <br><br>
    <a href="{{ route('dashboard') }}">← Back to Dashboard</a>

    <script>
        let isDeg = true;

        function appendValue(val) {
            document.getElementById('display').value += val;
        }

        function clearDisplay() {
            document.getElementById('display').value = '';
        }

        function deleteChar() {
            let display = document.getElementById('display');
            display.value = display.value.slice(0, -1);
        }

        function toggleDegRad() {
            isDeg = !isDeg;
            document.getElementById('modeBtn').innerText = isDeg ? 'DEG' : 'RAD';
        }

        function appendTrig(func) {
            let display = document.getElementById('display');
            display.value += func + '(';
        }

        function calculateResult() {
            let display = document.getElementById('display');
            let expr = display.value.replace(/\^/g, '**');

            // Konversi DEG ke RAD untuk trig
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
                display.value = result;
            } catch {
                display.value = 'Error';
            }
        }
    </script>
</body>
</html>
