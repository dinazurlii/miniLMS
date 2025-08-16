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
            font-size: 42px;
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
    <div id="timer-display">STUDY - 25:00</div>

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
        let isRestMode = localStorage.getItem("pomodoro_isRestMode") === "true" ? true : false;

        const display = document.getElementById("timer-display");
        const sound = document.getElementById("timerSound");

        // === Simpan state ke localStorage ===
        function saveState() {
            localStorage.setItem("pomodoro_timeLeft", timeLeft);
            localStorage.setItem("pomodoro_paused", isPaused);
            localStorage.setItem("pomodoro_isRestMode", isRestMode);
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
            isRestMode = false; // reset ke mode belajar
            timeLeft = 25 * 60;
            isPaused = true;
            saveState();
            updateDisplay();
        };

        document.getElementById("backBtn").onclick = () => {
            window.location.href = "/dashboard"; 
        };

        function updateTimer() {
            if (!isPaused) {
                timeLeft--;
                saveState();
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timer = null;

                    // === Switch mode ===
                    if (isRestMode) {
                        // selesai istirahat → kembali ke belajar
                        timeLeft = 25 * 60;
                        isRestMode = false;
                    } else {
                        // selesai belajar → masuk istirahat
                        timeLeft = 5 * 60;
                        isRestMode = true;
                    }

                    saveState();
                    sound.play();
                    updateDisplay();
                } else {
                    updateDisplay();
                }
            }
        }

        function updateDisplay() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            let label = isRestMode ? "REST" : "STUDY";
            display.textContent = 
                `${label} - ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // === Picture in Picture ===
        const pipVideo = document.getElementById('pip-video');
        let pipCanvas = document.createElement('canvas');
        pipCanvas.width = 300;
        pipCanvas.height = 150;
        let ctx = pipCanvas.getContext('2d');

        setInterval(() => {
            ctx.fillStyle = "#222";
            ctx.fillRect(0, 0, pipCanvas.width, pipCanvas.height);
            ctx.fillStyle = "#fff";
            ctx.font = "36px Arial";
            ctx.textAlign = "center";
            ctx.fillText(display.textContent, pipCanvas.width / 2, pipCanvas.height / 2 + 10);
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

        // === Auto start interval ===
        if (!timer) {
            timer = setInterval(updateTimer, 1000);
        }
        updateDisplay();
    </script>

</body>
</html>
