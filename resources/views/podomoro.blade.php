<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #111;
            color: white;
            margin-top: 50px;
        }
        #timer-display {
            font-size: 48px;
            margin: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 18px;
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Pomodoro Timer</h1>
    <div id="timer-display">25:00</div>

    <div>
        <button id="backBtn">⬅ Back</button>
        <button id="pauseBtn">Pause</button>
        <button id="resetBtn">Reset</button>
        <button id="startBtn">Start</button>
        <button id="pipBtn">📺 PiP</button>
    </div>

    <audio id="timerSound" src="Sound/timer-end.mp3"></audio>
    <video id="pip-video" muted playsinline style="display:none;"></video>

    <script>
        let timer;
        let timeLeft = localStorage.getItem("pomodoro_timeLeft") 
            ? parseInt(localStorage.getItem("pomodoro_timeLeft")) 
            : 25 * 60;
        let isPaused = localStorage.getItem("pomodoro_paused") === "true" ? true : false;

        const display = document.getElementById("timer-display");
        const sound = document.getElementById("timerSound");

        // Simpan waktu tiap detik biar tetap jalan walau pindah halaman
        function saveState() {
            localStorage.setItem("pomodoro_timeLeft", timeLeft);
            localStorage.setItem("pomodoro_paused", isPaused);
        }

        document.getElementById("startBtn").onclick = () => {
            if (isPaused) {
                isPaused = false;
                saveState();
                if (!timer) timer = setInterval(updateTimer, 1000);
            }
        };

        document.getElementById("pauseBtn").onclick = () => {
            isPaused = !isPaused;
            saveState();
        };

        document.getElementById("resetBtn").onclick = () => {
            clearInterval(timer);
            timer = null;
            timeLeft = 25 * 60;
            isPaused = true;
            saveState();
            updateDisplay();
        };

        document.getElementById("backBtn").onclick = () => {
            // Simulasi kembali ke dashboard (ganti dengan route dashboard kamu)
            window.location.href = "/dashboard"; 
        };

        function updateTimer() {
            if (!isPaused) {
                timeLeft--;
                saveState();
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timer = null;
                    timeLeft = 0;
                    saveState();
                    sound.play();
                }
                updateDisplay();
            }
        }

        function updateDisplay() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            display.textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // ===== Picture in Picture =====
        const pipVideo = document.getElementById('pip-video');
        let pipCanvas = document.createElement('canvas');
        pipCanvas.width = 300;
        pipCanvas.height = 150;
        let ctx = pipCanvas.getContext('2d');

        setInterval(() => {
            ctx.fillStyle = "#222";
            ctx.fillRect(0, 0, pipCanvas.width, pipCanvas.height);
            ctx.fillStyle = "#fff";
            ctx.font = "48px Arial";
            ctx.textAlign = "center";
            ctx.fillText(display.textContent, pipCanvas.width / 2, pipCanvas.height / 2 + 15);
        }, 1000);

        let pipStream = pipCanvas.captureStream();
        pipVideo.srcObject = pipStream;

        document.getElementById('pipBtn').onclick = async () => {
            await pipVideo.play();
            if (document.pictureInPictureElement) {
                await document.exitPictureInPicture();
            } else {
                await pipVideo.requestPictureInPicture();
            }
        };

        // Auto start timer kalau sebelumnya belum selesai
        if (!timer) {
            timer = setInterval(updateTimer, 1000);
        }
        updateDisplay();
    </script>

</body>
</html>
