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

        .quiz-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 40px 32px;
            max-width: 700px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .quiz-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.8s;
        }

        .quiz-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .quiz-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        h1 {
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

        .quiz-icon {
            font-size: 32px;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .level-indicator {
            color: #6b7280;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .question {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
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
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            position: relative;
            overflow: hidden;
            text-align: left;
        }

        .options button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.6s;
        }

        .options button:hover {
            background: rgba(59, 130, 246, 0.05);
            border-color: rgba(59, 130, 246, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
        }

        .options button:hover::before {
            left: 100%;
        }

        .options button:active {
            transform: translateY(0);
        }

        .result {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
            padding: 16px;
            border-radius: 12px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .result.success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .result.error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .next-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
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
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(16, 185, 129, 0.4);
        }

        .next-btn:hover::before {
            left: 100%;
        }

        .back-btn {
            background: rgba(107, 114, 128, 0.1);
            backdrop-filter: blur(10px);
            color: #374151;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .back-btn:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
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
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .completion-subtitle {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 32px;
        }

        .progress-bar {
            background: rgba(229, 231, 235, 0.8);
            border-radius: 8px;
            height: 8px;
            margin: 16px 0;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            height: 100%;
            border-radius: 8px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
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
                font-size: 28px;
                flex-direction: column;
                gap: 8px;
            }

            .question {
                font-size: 18px;
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
                max-width: 200px;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .quiz-container {
                padding: 24px 16px;
            }

            h1 {
                font-size: 24px;
            }

            .question {
                font-size: 16px;
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
    <div class="quiz-container">
        <div class="quiz-header">
            <div class="quiz-badge">🧠 Brain Challenge</div>
            <h1>
                <span class="quiz-icon">🧠</span>
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
                <a href="/mini-games" class="back-btn">
                    ⬅️ <span>Kembali</span>
                </a>
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
                buttonEl.style.background = "rgba(16, 185, 129, 0.2)";
                buttonEl.style.borderColor = "#10b981";
                document.getElementById("nextBtn").style.display = "flex";
            } else {
                resultEl.textContent = "❌ Salah, coba lagi dengan hati-hati!";
                resultEl.className = "result error";
                buttonEl.style.background = "rgba(239, 68, 68, 0.2)";
                buttonEl.style.borderColor = "#ef4444";
                
                // Show correct answer
                optionButtons.forEach(btn => {
                    if (btn.textContent === q.correct) {
                        btn.style.background = "rgba(16, 185, 129, 0.2)";
                        btn.style.borderColor = "#10b981";
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
                            <a href="/mini-games" class="back-btn">
                                🏠 <span>Kembali ke Menu</span>
                            </a>
                        </div>
                    </div>
                `;
            }
        }

        // Start the quiz
        loadQuestion();
    </script>
</body>
</html>