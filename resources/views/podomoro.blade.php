<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
                radial-gradient(circle at 30% 40%, rgba(239, 68, 68, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .pomodoro-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            padding: 48px;
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .header {
            margin-bottom: 40px;
        }

        .header h1 {
            color: #1f2937;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #6b7280;
            font-size: 16px;
            font-weight: 400;
        }

        .timer-circle {
            width: 280px;
            height: 280px;
            margin: 0 auto 40px;
            position: relative;
            border-radius: 50%;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            box-shadow: 
                inset 0 8px 16px rgba(148, 163, 184, 0.2),
                inset 0 -8px 16px rgba(255, 255, 255, 0.8),
                0 16px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .timer-progress {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                from 270deg,
                #ef4444 0deg,
                #ef4444 var(--progress, 0deg),
                transparent var(--progress, 0deg)
            );
            transition: --progress 1s ease;
        }

        .timer-progress.rest-mode {
            background: conic-gradient(
                from 270deg,
                #10b981 0deg,
                #10b981 var(--progress, 0deg),
                transparent var(--progress, 0deg)
            );
        }

        .timer-inner {
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 2px 4px rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 2;
            position: relative;
        }

        .mode-indicator {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 8px;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .mode-indicator.rest-mode {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-color: rgba(16, 185, 129, 0.2);
        }

        #timer-display {
            font-size: 48px;
            font-weight: 700;
            color: #1f2937;
            letter-spacing: -1px;
            margin-bottom: 4px;
        }

        .controls {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 16px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            min-width: 100px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(239, 68, 68, 0.4);
        }

        .btn-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: #4b5563;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(107, 114, 128, 0.15);
            transform: translateY(-1px);
        }

        .btn-back {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(59, 130, 246, 0.4);
        }

        .btn-pip {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .btn-pip:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(139, 92, 246, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn:hover::before {
            left: 100%;
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .pomodoro-container {
                padding: 32px 24px;
                border-radius: 24px;
            }

            .timer-circle {
                width: 240px;
                height: 240px;
            }

            .timer-inner {
                width: 200px;
                height: 200px;
            }

            #timer-display {
                font-size: 36px;
            }

            .controls {
                gap: 12px;
            }

            .btn {
                padding: 10px 16px;
                font-size: 14px;
                min-width: 80px;
            }

            .header h1 {
                font-size: 28px;
            }
        }

        /* Animation */
        .pomodoro-container {
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

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

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .timer-circle.active {
            animation: pulse 2s infinite;
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
    <div class="pomodoro-container">
        <div class="header">
            <h1>Pomodoro Timer</h1>
            <p>Focus and productivity made simple</p>
        </div>

        <div class="timer-circle" id="timerCircle">
            <div class="timer-progress" id="timerProgress"></div>
            <div class="timer-inner">
                <div class="mode-indicator" id="modeIndicator">STUDY</div>
                <div id="timer-display">25:00</div>
            </div>
        </div>

        <div class="controls">
            <button class="btn btn-back" id="backBtn">⬅ Back</button>
            <button class="btn btn-secondary" id="pauseBtn">Pause</button>
            <button class="btn btn-secondary" id="resetBtn">Reset</button>
            <button class="btn btn-primary" id="startBtn">Start</button>
            <button class="btn btn-pip" id="pipBtn">📺 PiP</button>
        </div>
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
        const modeIndicator = document.getElementById("modeIndicator");
        const timerProgress = document.getElementById("timerProgress");
        const timerCircle = document.getElementById("timerCircle");

        // === Simpan state ke localStorage ===
        function saveState() {
            localStorage.setItem("pomodoro_timeLeft", timeLeft);
            localStorage.setItem("pomodoro_paused", isPaused);
            localStorage.setItem("pomodoro_isRestMode", isRestMode);
        }

        function updateProgress() {
            const totalTime = isRestMode ? 5 * 60 : 25 * 60;
            const progress = ((totalTime - timeLeft) / totalTime) * 360;
            timerProgress.style.setProperty('--progress', progress + 'deg');
        }

        document.getElementById("startBtn").onclick = () => {
            if (isPaused) {
                isPaused = false;
                saveState();
                timerCircle.classList.add('active');
                if (!timer) timer = setInterval(updateTimer, 1000);
            }
        };

        document.getElementById("pauseBtn").onclick = () => {
            isPaused = !isPaused;
            if (isPaused) {
                timerCircle.classList.remove('active');
            } else {
                timerCircle.classList.add('active');
            }
            saveState();
        };

        document.getElementById("resetBtn").onclick = () => {
            clearInterval(timer);
            timer = null;
            isRestMode = false;
            timeLeft = 25 * 60;
            isPaused = true;
            timerCircle.classList.remove('active');
            saveState();
            updateDisplay();
            updateProgress();
        };

        document.getElementById("backBtn").onclick = () => {
            window.location.href = "/dashboard"; 
        };

        function updateTimer() {
            if (!isPaused) {
                timeLeft--;
                saveState();
                updateProgress();
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timer = null;
                    timerCircle.classList.remove('active');

                    // === Switch mode ===
                    if (isRestMode) {
                        timeLeft = 25 * 60;
                        isRestMode = false;
                    } else {
                        timeLeft = 5 * 60;
                        isRestMode = true;
                    }

                    saveState();
                    sound.play();
                    updateDisplay();
                    updateProgress();
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
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            modeIndicator.textContent = label;
            
            // Update mode styling
            if (isRestMode) {
                modeIndicator.classList.add('rest-mode');
                timerProgress.classList.add('rest-mode');
            } else {
                modeIndicator.classList.remove('rest-mode');
                timerProgress.classList.remove('rest-mode');
            }
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
            let label = isRestMode ? "REST" : "STUDY";
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            let timeText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            ctx.fillText(`${label} - ${timeText}`, pipCanvas.width / 2, pipCanvas.height / 2 + 10);
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
        if (!timer && !isPaused) {
            timer = setInterval(updateTimer, 1000);
            timerCircle.classList.add('active');
        }
        updateDisplay();
        updateProgress();
    </script>
</body>
</html>