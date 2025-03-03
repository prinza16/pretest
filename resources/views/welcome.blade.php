<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background: rgb(199, 199, 199);
        }
        .question-container {
            display: none;
        }
        .question-container.active {
            display: block;
        }
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
        .timer-container {
            font-size: 1.2rem;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 15px;
        }
        .timer-bar {
            height: 5px;
            background-color: #198754;
            transition: width 1s linear;
            margin-bottom: 20px;
        }
        #startScreen {
            text-align: center;
        }
        #quizContainer {
            display: none;
        }
    </style>
</head>
<body class="antialiased">
<div class="container d-flex flex-column justify-content-center align-items-center" style="height: 100%">
    <div class="card shadow rounded-4 w-100" style="max-width: 800px;">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">แบบทดสอบ</h4>
        </div>
        <div class="card-body p-4">
            <div id="startScreen" class="py-4">
                <h2 class="mb-4">ยินดีต้อนรับสู่แบบทดสอบ</h2>
                <p class="mb-4">เมื่อคุณเริ่มทำแบบทดสอบ:</p>
                <ul class="text-start mb-4 mx-auto" style="max-width: 500px;">
                    <li>แบบทดสอบประกอบด้วยคำถาม 10 ข้อ</li>
                    <li>คุณมีเวลา 60 วินาทีในการตอบแต่ละข้อ</li>
                    <li>เมื่อหมดเวลา ระบบจะเลื่อนไปข้อถัดไปโดยอัตโนมัติ</li>
                    <li>คุณไม่สามารถย้อนกลับไปข้อก่อนหน้าได้</li>
                </ul>
                <button id="startButton" class="btn btn-success btn-lg">เริ่มทำแบบทดสอบ</button>
            </div>
            
            <div id="quizContainer">
                <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <form id="quizForm" action="{{ route('submitAnswers') }}" method="POST">
                    @csrf
                    <input type="hidden" name="number" value="ฟอร์มที่ {{ session('submit_count') }}">
                    
                    <div id="questionsContainer">
                        @foreach ($questions as $index => $question)
                            <div class="question-container" data-question-id="{{ $question->id_questions }}">
                                <div class="text-center mb-4">
                                    <h5 class="fw-bold">คำถามที่ <span class="current-question-number">0</span> จาก 10</h5>
                                </div>
                                
                                <div class="timer-container text-center">
                                    เวลาที่เหลือ: <span class="countdown">60</span> วินาที
                                </div>
                                <div class="timer-bar" style="width: 100%"></div>
                                
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-body p-4">
                                        <h4>{{ $question->question_text }}</h4>
                                    </div>
                                </div>
                                
                                <div class="row g-3">
                                    @foreach ($question->answers as $answer)
                                        <div class="col-md-6">
                                            <div class="card h-100 answer-option" data-answer-id="{{ $answer->id_answers }}">
                                                <div class="card-body d-flex align-items-center">
                                                    <div class="form-check w-100">
                                                        <input class="form-check-input" type="radio" 
                                                               id="answer_{{ $question->id_questions }}_{{ $answer->id_answers }}"
                                                               name="answer[{{ $question->id_questions }}]" 
                                                               value="{{ $answer->id_answers }}">
                                                        <label class="form-check-label w-100" for="answer_{{ $question->id_questions }}_{{ $answer->id_answers }}">
                                                            {{ $answer->answer_text }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary next-btn">ถัดไป</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-4 d-none" id="submitContainer">
                        <p>คุณได้ตอบคำถามครบทั้ง 10 ข้อแล้ว</p>
                        <button type="submit" class="btn btn-success btn-lg">ส่งคำตอบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startButton = document.getElementById('startButton');
    const startScreen = document.getElementById('startScreen');
    const quizContainer = document.getElementById('quizContainer');
    
    startButton.addEventListener('click', function() {
        startScreen.style.display = 'none';
        quizContainer.style.display = 'block';
        initializeQuiz();
    });
    
    function initializeQuiz() {
        const questionContainers = Array.from(document.querySelectorAll('.question-container'));
        const shuffledQuestions = shuffleArray(questionContainers).slice(0, 10); // Take only 10 random questions
        
        let currentQuestionIndex = 0;
        const totalQuestions = shuffledQuestions.length;
        const answeredQuestions = new Set();
        let currentTimer = null;
        
        function setCookie(name, value, seconds) {
            const expirationDate = new Date();
            expirationDate.setTime(expirationDate.getTime() + (seconds * 1000));
            document.cookie = `${name}=${value};expires=${expirationDate.toUTCString()};path=/`;
        }
        
        function getCookie(name) {
            const cookieName = `${name}=`;
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim();
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }
            return null;
        }
        
        if (shuffledQuestions.length > 0) {
            shuffledQuestions[0].classList.add('active');
            updateProgressBar();
            updateQuestionNumber();
            startQuestionTimer();
        }
        
        function startQuestionTimer() {
            const questionId = shuffledQuestions[currentQuestionIndex].getAttribute('data-question-id');
            const cookieName = `question_${questionId}_time`;
            
            let timeLeft = 60;
            const existingTime = getCookie(cookieName);
            
            if (existingTime) {
                timeLeft = parseInt(existingTime);
            } else {
                setCookie(cookieName, timeLeft, 60);
            }
            
            const countdownEl = shuffledQuestions[currentQuestionIndex].querySelector('.countdown');
            const timerBar = shuffledQuestions[currentQuestionIndex].querySelector('.timer-bar');
            
            if (currentTimer) {
                clearInterval(currentTimer);
            }
            
            countdownEl.textContent = timeLeft;
            timerBar.style.width = (timeLeft / 60 * 100) + '%';
            
            currentTimer = setInterval(function() {
                timeLeft--;
                
                setCookie(cookieName, timeLeft, timeLeft);
                
                countdownEl.textContent = timeLeft;
                timerBar.style.width = (timeLeft / 60 * 100) + '%';
                
                if (timeLeft <= 0) {
                    clearInterval(currentTimer);
                    
                    markQuestionAsExpired(questionId);
                    moveToNextQuestion();
                }
            }, 1000);
        }
        
        function markQuestionAsExpired(questionId) {

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `answer[${questionId}]`;
            hiddenInput.value = 'null';  
            document.getElementById('quizForm').appendChild(hiddenInput);
            
            answeredQuestions.add(questionId);
            
            const selectedRadio = document.querySelector(`input[name="answer[${questionId}]"]:checked`);
            if (selectedRadio) {
                selectedRadio.checked = false;
            }
            
            console.log(`Question ${questionId} marked as expired (null answer)`);
        }

        function moveToNextQuestion() {
            if (currentQuestionIndex < totalQuestions - 1) {
                shuffledQuestions[currentQuestionIndex].classList.remove('active');
                currentQuestionIndex++;
                shuffledQuestions[currentQuestionIndex].classList.add('active');
                updateProgressBar();
                updateQuestionNumber();
                startQuestionTimer();
            } else {
                document.getElementById('submitContainer').classList.remove('d-none');
            }
        }
        
        document.querySelectorAll('.next-btn').forEach(button => {
            button.addEventListener('click', function() {
                const currentQuestion = shuffledQuestions[currentQuestionIndex];
                const questionId = currentQuestion.getAttribute('data-question-id');
                
                const selectedAnswer = currentQuestion.querySelector('input[type="radio"]:checked');
                if (!selectedAnswer) {
                    alert('กรุณาเลือกคำตอบก่อนไปข้อถัดไป');
                    return;
                }
                
                answeredQuestions.add(questionId);
                if (currentTimer) {
                    clearInterval(currentTimer);
                }
                
                if (currentQuestionIndex < totalQuestions - 1) {
                    currentQuestion.classList.remove('active');
                    currentQuestionIndex++;
                    shuffledQuestions[currentQuestionIndex].classList.add('active');
                    updateProgressBar();
                    updateQuestionNumber();
                    startQuestionTimer();
                }
                
                if (answeredQuestions.size === totalQuestions) {
                    document.getElementById('submitContainer').classList.remove('d-none');
                    this.disabled = true;
                }
            });
        });
        
        document.querySelectorAll('.prev-btn').forEach(button => {
            button.disabled = true;
        });
        
        document.querySelectorAll('.answer-option').forEach(card => {
            card.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });
        
        function updateProgressBar() {
            const progress = (answeredQuestions.size / totalQuestions) * 100;
            document.querySelector('.progress-bar').style.width = progress + '%';
            document.querySelector('.progress-bar').setAttribute('aria-valuenow', progress);
        }
        
        function updateQuestionNumber() {
            document.querySelectorAll('.current-question-number').forEach(el => {
                el.textContent = (currentQuestionIndex + 1);
            });
        }
        
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            if (answeredQuestions.size < totalQuestions) {
                e.preventDefault();
                alert('กรุณาตอบคำถามให้ครบทุกข้อก่อนส่ง');
            }
        });
    }
    
    function shuffleArray(array) {
        const newArray = [...array];
        for (let i = newArray.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
        }
        return newArray;
    }
});
</script>
</body>
</html>