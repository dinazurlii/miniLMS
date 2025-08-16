<!-- resources/views/quiz.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Game</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background: #f9f9f9;
      padding: 30px;
    }
    .quiz-container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    h1 {
      margin-bottom: 20px;
    }
    .question {
      font-size: 18px;
      margin-bottom: 15px;
    }
    .options {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .options button {
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: #eee;
      cursor: pointer;
      transition: 0.2s;
      font-size: 16px;
    }
    .options button:hover {
      background: #ddd;
    }
    .result {
      margin-top: 20px;
      font-weight: bold;
    }
    .next-btn, .back-btn {
      margin-top: 20px;
      padding: 10px 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }
    .next-btn {
      background: #4CAF50;
      color: white;
    }
    .next-btn:hover {
      background: #45a049;
    }
    .back-btn {
      background: #555;
      color: white;
    }
    .back-btn:hover {
      background: #333;
    }
  </style>
</head>
<body>
  <div class="quiz-container">
    <h1>Quiz Game</h1>
    <div id="quizContent">
      <p class="question" id="question"></p>
      <div class="options" id="options"></div>
      <p class="result" id="result"></p>
      <button class="next-btn" id="nextBtn" style="display:none;" onclick="nextQuestion()">Next</button>
      <a href="/mini-games"><button class="back-btn">⬅ Back</button></a>
    </div>
  </div>

  <script>
    const quizData = [
      { // Level 1
        question: "Apa ibukota Indonesia?",
        options: ["Bandung", "Jakarta", "Surabaya", "Medan"],
        correct: "Jakarta"
      },
      { // Level 2
        question: "Siapakah penemu lampu pijar?",
        options: ["Isaac Newton", "Albert Einstein", "Thomas Alva Edison", "Nikola Tesla"],
        correct: "Thomas Alva Edison"
      },
      { // Level 3
        question: "Planet manakah yang dijuluki 'Planet Merah'?",
        options: ["Venus", "Mars", "Jupiter", "Saturnus"],
        correct: "Mars"
      },
      { // Level 4
        question: "Di manakah letak Candi Borobudur?",
        options: ["Jawa Timur", "Jawa Tengah", "Bali", "Sumatra Barat"],
        correct: "Jawa Tengah"
      },
      { // Level 5 (sulit)
        question: "Siapakah presiden pertama PBB (United Nations)?",
        options: ["Trygve Lie", "Paul-Henri Spaak", "Dag Hammarskjöld", "Ban Ki-moon"],
        correct: "Paul-Henri Spaak"
      }
    ];

    let currentLevel = 0;

    function loadQuestion() {
      const q = quizData[currentLevel];
      document.getElementById("question").textContent = `Level ${currentLevel+1}: ${q.question}`;
      const optionsDiv = document.getElementById("options");
      optionsDiv.innerHTML = "";
      q.options.forEach(opt => {
        let btn = document.createElement("button");
        btn.textContent = opt;
        btn.onclick = () => checkAnswer(opt);
        optionsDiv.appendChild(btn);
      });
      document.getElementById("result").textContent = "";
      document.getElementById("nextBtn").style.display = "none";
    }

    function checkAnswer(answer) {
      const q = quizData[currentLevel];
      const resultEl = document.getElementById("result");
      if (answer === q.correct) {
        resultEl.textContent = "✅ Benar! Lanjut ke level berikutnya.";
        resultEl.style.color = "green";
        document.getElementById("nextBtn").style.display = "inline-block";
      } else {
        resultEl.textContent = "❌ Salah, coba lagi!";
        resultEl.style.color = "red";
      }
    }

    function nextQuestion() {
      currentLevel++;
      if (currentLevel < quizData.length) {
        loadQuestion();
      } else {
        document.getElementById("quizContent").innerHTML = `
          <h2>🎉 Selamat! Kamu sudah menyelesaikan semua level.</h2>
          <a href='/mini-games'><button class='back-btn'>⬅ Back to Menu</button></a>
        `;
      }
    }

    // Mulai dari level 1
    loadQuestion();
  </script>
</body>
</html>
