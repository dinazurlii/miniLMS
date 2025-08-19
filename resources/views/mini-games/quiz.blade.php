<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Game</title>
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
            opacity: 0.04;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }

        .floating-decoration:nth-child(1) {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-decoration:nth-child(2) {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            top: 20%;
            right: 8%;
            animation-delay: 2s;
        }

        .floating-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            bottom: 25%;
            left: 3%;
            animation-delay: 4s;
        }

        .floating-decoration:nth-child(4) {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            bottom: 15%;
            right: 5%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }

        .quiz-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.08),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            padding: 40px 32px;
            max-width: 700px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240, 0.6);
            position: relative;
            z-index: 1;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .quiz-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s;
        }

        .quiz-container:hover::before {
            left: 100%;
        }

        .quiz-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .quiz-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 159, 243, 0.2);
            border-radius: 50px;
            padding: 12px 24px;
            color: #ff9ff3;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 15px rgba(255, 159, 243, 0.1);
        }

        h1 {
            color: #1e293b;
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .quiz-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 8px 20px rgba(255, 159, 243, 0.3);
        }

        .level-indicator {
            color: #64748b;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 16px;
        }

        .question {
            font-size: 22px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 32px;
            line-height: 1.4;
            text-align: center;
            padding: 0 16px;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 32px;
        }

        .options button {
            padding: 20px 24px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 16px;
            font-weight: 500;
            color: #1e293b;
            position: relative;
            overflow: hidden;
            text-align: left;
            font-family: inherit;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .options button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .options button:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(255, 159, 243, 0.3);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 25px rgba(255, 159, 243, 0.15);
        }

        .options button:hover::before {
            left: 100%;
        }

        .options button:active {
            transform: translateY(-2px) scale(1.01);
        }

        .options button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none !important;
        }

        .result {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
            padding: 16px;
            border-radius: 16px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .result.success {
            background: rgba(72, 187, 120, 0.1);
            color: #059669;
            border: 1px solid rgba(72, 187, 120, 0.2);
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.1);
        }

        .result.error {
            background: rgba(255, 107, 107, 0.1);
            color: #dc2626;
            border: 1px solid rgba(255, 107, 107, 0.2);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .next-btn, .back-btn {
            padding: 16px 32px;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-family: inherit;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .next-btn {
            background: linear-gradient(135deg, #48cab2, #1dd1a1);
            color: white;
            box-shadow: 0 8px 20px rgba(72, 187, 120, 0.3);
        }

        .next-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .next-btn:hover {
            background: linear-gradient(135deg, #1dd1a1, #48cab2);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(72, 187, 120, 0.4);
        }

        .next-btn:hover::before {
            left: 100%;
        }

        .back-btn {
            background: rgba(107, 114, 128, 0.1);
            backdrop-filter: blur(10px);
            color: #4b5563;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            color: #374151;
        }

        .completion-screen {
            text-align: center;
            padding: 40px 20px;
        }

        .completion-icon {
            font-size: 64px;
            margin-bottom: 24px;
            animation: bounce 2s infinite;
        }

        .completion-title {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .completion-subtitle {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .progress-bar {
            background: rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            height: 12px;
            margin: 16px 0;
            overflow: hidden;
            backdrop-filter: blur(5px);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .progress-fill {
            background: linear-gradient(135deg, #ff9ff3, #f368e0);
            height: 100%;
            border-radius: 12px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(255, 159, 243, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .quiz-container {
                padding: 32px 24px;
            }

            h1 {
                font-size: 36px;
                flex-direction: column;
                gap: 12px;
            }

            .quiz-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .question {
                font-size: 20px;
                padding: 0 8px;
            }

            .options button {
                padding: 16px 20px;
                font-size: 15px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .next-btn, .back-btn {
                width: 100%;
                max-width: 240px;
                justify-content: center;
            }

            .completion-title {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .quiz-container {
                padding: 24px 16px;
            }

            h1 {
                font-size: 28px;
            }

            .question {
                font-size: 18px;
            }

            .completion-title {
                font-size: 24px;
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

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .options button {
            animation: fadeInLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .options button:nth-child(1) { animation-delay: 0.1s; }
        .options button:nth-child(2) { animation-delay: 0.2s; }
        .options button:nth-child(3) { animation-delay: 0.3s; }
        .options button:nth-child(4) { animation-delay: 0.4s; }

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
    <div class="floating-decoration"></div>

    <div class="quiz-container">
        <div class="quiz-header">
            <div class="quiz-badge">✨ Brain Challenge</div>
            <h1>
                <div class="quiz-icon">🧠</div>
                Quiz Game
            </h1>
            <div class="level-indicator" id="levelIndicator">Level 1 of 5</div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 20%;"></div>
            </div>
        </div>

        <div id="quizContent">
            <p class="question" id="question"></p>
            <div class="options" id="options"></div>
            <div class="result" id="result"></div>
            <div class="action-buttons">
                <button class="next-btn" id="nextBtn" style="display:none;" onclick="nextQuestion()">
                    <span>Lanjut</span> ➡️
                </button>
                <button class="back-btn" onclick="goBack()">
                    <span>Back</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        const quizData = [
            {
                question: "Apa ibukota Indonesia?",
                options: ["Bandung", "Jakarta", "Surabaya", "Medan"],
                correct: "Jakarta"
            },
            {
                question: "Siapakah penemu lampu pijar?",
                options: ["Isaac Newton", "Albert Einstein", "Thomas Alva Edison", "Nikola Tesla"],
                correct: "Thomas Alva Edison"
            },
            {
                question: "Planet manakah yang dijuluki 'Planet Merah'?",
                options: ["Venus", "Mars", "Jupiter", "Saturnus"],
                correct: "Mars"
            },
            {
                question: "Di manakah letak Candi Borobudur?",
                options: ["Jawa Timur", "Jawa Tengah", "Bali", "Sumatra Barat"],
                correct: "Jawa Tengah"
            },
            {
                question: "Siapakah presiden pertama PBB (United Nations)?",
                options: ["Trygve Lie", "Paul-Henri Spaak", "Dag Hammarskjöld", "Ban Ki-moon"],
                correct: "Paul-Henri Spaak"
            }
        ];

        let currentLevel = 0;

        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/mini-games'; // Change this to your mini-games URL
            }
        }

        function updateProgress() {
            const progress = ((currentLevel + 1) / quizData.length) * 100;
            document.getElementById("progressFill").style.width = progress + "%";
            document.getElementById("levelIndicator").textContent = `Level ${currentLevel + 1} of ${quizData.length}`;
        }

        function loadQuestion() {
            const q = quizData[currentLevel];
            document.getElementById("question").textContent = q.question;
            const optionsDiv = document.getElementById("options");
            optionsDiv.innerHTML = "";
            
            q.options.forEach((opt, index) => {
                let btn = document.createElement("button");
                btn.textContent = opt;
                btn.onclick = () => checkAnswer(opt, btn);
                btn.style.animationDelay = (index * 0.1) + "s";
                optionsDiv.appendChild(btn);
            });
            
            const resultEl = document.getElementById("result");
            resultEl.textContent = "";
            resultEl.className = "result";
            document.getElementById("nextBtn").style.display = "none";
            updateProgress();
        }

        function checkAnswer(answer, buttonEl) {
            const q = quizData[currentLevel];
            const resultEl = document.getElementById("result");
            const optionButtons = document.querySelectorAll(".options button");
            
            // Disable all buttons
            optionButtons.forEach(btn => btn.disabled = true);
            
            if (answer === q.correct) {
                resultEl.textContent = "✅ Benar! Jawaban yang tepat.";
                resultEl.className = "result success";
                buttonEl.style.background = "rgba(72, 187, 120, 0.2)";
                buttonEl.style.borderColor = "#48bb78";
                document.getElementById("nextBtn").style.display = "flex";
            } else {
                resultEl.textContent = "❌ Salah, coba lagi dengan hati-hati!";
                resultEl.className = "result error";
                buttonEl.style.background = "rgba(255, 107, 107, 0.2)";
                buttonEl.style.borderColor = "#ff6b6b";
                
                // Show correct answer
                optionButtons.forEach(btn => {
                    if (btn.textContent === q.correct) {
                        btn.style.background = "rgba(72, 187, 120, 0.2)";
                        btn.style.borderColor = "#48bb78";
                    }
                });
                
                setTimeout(() => {
                    // Re-enable buttons after showing correct answer
                    optionButtons.forEach(btn => {
                        btn.disabled = false;
                        btn.style.background = "";
                        btn.style.borderColor = "";
                    });
                    resultEl.textContent = "";
                    resultEl.className = "result";
                }, 2000);
            }
        }

        function nextQuestion() {
            currentLevel++;
            if (currentLevel < quizData.length) {
                loadQuestion();
            } else {
                document.getElementById("quizContent").innerHTML = `
                    <div class="completion-screen">
                        <div class="completion-icon">🎉</div>
                        <h2 class="completion-title">Selamat!</h2>
                        <p class="completion-subtitle">Kamu sudah menyelesaikan semua level quiz dengan baik!</p>
                        <div class="action-buttons">
                            <button class="back-btn" onclick="goBack()">
                                🏠 <span>Kembali ke Menu</span>
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Start the quiz
        document.addEventListener('DOMContentLoaded', function() {
            loadQuestion();
        });
    </script>
</body>
</html>