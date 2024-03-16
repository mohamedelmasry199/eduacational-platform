<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Medical DZ</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap"
        rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md px-md-5 d-flex m-0 justify-content-between">
            <div class="container-fluid header">
                <a class="navbar-brand logo" href="{{ route('home') }}">
                    <img src="{{ asset('IMG-20240314-WA0217-removebg-preview.png') }}"
                    style="width: 130px; height: 130px; margin:-37px 0 -50px 0" alt="MCQ Lab Logo">
                  </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-lg-5">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">accueil</a>
                        </li>
                    </ul>
                    <div class="d-flex login-parent ml-lg-auto ">
                        @auth
                        @if(auth()->user()->status == 'admin')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn logout btn-outline-primary">Déconnecté</button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="info_dev col-lg-6 col-md-9 col-11">
        <h2>La Année scolaire :<span>{{ $year->year }}</span></h2>
        <h2>Le Module :<span>{{ $subject->subject_name }}</span></h2>
        <h2  style="display: inline">Le cours :<span>
                @if (!$chapters)
                    {{ $chapter->chapter_name }}
                @else
                    @foreach ($chapters as $key => $chapter)
                        {{ $chapter->chapter_name }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @endif
            </span></h2>

        <h2 >source:<span>
                @if ($questionSource)
                    {{ $questionSource }}@else{{ $questions[0]->source }}
                @endif
            </span></h2>
        <h2>Type d'examen:<span>
                @if ($questionType)
                    {{ $questionType }}@else{{ $questions[0]->type }}
                @endif
            </span></h2>
    </div>

    <div class="arrow_dev mt-5 col-9 m-auto d-flex justify-content-between">
        <i class="fas fa-arrow-circle-left arrow_left" onclick="showPreviousQuestion()"></i>
        <i class="fas fa-arrow-circle-right arrow_left" onclick="showNextQuestion()"></i>
    </div>

    <div class="question_dev col-md-10 col-11">
        <div class="devs">
            @foreach ($questions as $index => $item)
                <div id="question{{ $index + 1 }}" class="question @if ($index !== 0) d-none @endif">
                    <p class="type">Type d'examen: {{ $item->type }}</p>
                    <h2 class="question mb-3">{{ $item->question }} ?</h2>
                    <div class="answers">
                        <?php $i = ['a', 'b', 'c', 'd', 'e', 'F', 'G']; ?>
                        @foreach ($item->answers as $answer)
                            <div class="answer" data-correct="{{ $answer->is_correct }}"
                                data-index="{{ $loop->index }}">
                                <span>{{ $i[$loop->index] }}-{{ $answer->answer }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="correct-answer" style="display: none;">
                        <p>Commentaire: <span class="correct-answer-text comment">{{ $item->comment }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        var totalQuestions = {{ count($questions) }};
        var currentQuestion = 1;

        function showNextQuestion() {
            if (currentQuestion < totalQuestions) {
                var current = document.getElementById("question" + currentQuestion);
                current.classList.add("d-none");
                currentQuestion++;
                var next = document.getElementById("question" + currentQuestion);
                if (next) {
                    next.classList.remove("d-none");
                    resetAnswers();
                }
            }
        }

        function showPreviousQuestion() {
            if (currentQuestion > 1) {
                var current = document.getElementById("question" + currentQuestion);
                current.classList.add("d-none");
                currentQuestion--;
                var previous = document.getElementById("question" + currentQuestion);
                if (previous) {
                    previous.classList.remove("d-none");
                    resetAnswers();
                }
            }
        }

        function resetAnswers() {
            const answers = document.querySelectorAll(".answer");
            answers.forEach(answer => {
                answer.classList.remove("correct", "incorrect");
                answer.style.color = "";
                answer.style.backgroundColor = "";
            });
            answered = false; // Reset the answered flag
        }

        document.addEventListener("DOMContentLoaded", function() {
            const questions = document.querySelectorAll(".question");

            questions.forEach(question => {
                const answers = question.querySelectorAll(".answer");
                let answered = false;

                answers.forEach(answer => {
                    answer.addEventListener("click", function() {
                        if (!answered) {
                            const isCorrect = answer.getAttribute("data-correct") === "1";

                            // Remove previous selections
                            const selectedAnswers = question.querySelectorAll(
                                ".answer.selected");
                            selectedAnswers.forEach(selected => {
                                selected.classList.remove("selected");
                            });

                            // Highlight the clicked answer
                            answer.classList.add("selected");
                            if (isCorrect) {
                                answer.classList.add("correct");
                                answer.style.color = "white";
                                answer.style.backgroundColor =
                                    "green"; // Add light green border
                            } else {
                                answer.classList.add("incorrect");
                                answer.style.color = "white";
                                answer.style.backgroundColor =
                                    "red"; // Add light red border
                            }

                            // Show the correct answer and prevent further selection
                            const correctAnswer = question.querySelector(".correct-answer");
                            const correctAnswerText = correctAnswer.querySelector(
                                ".correct-answer-text");
                            correctAnswer.style.display =
                                "block"; // Move this line outside of the conditional block

                            // Highlight the correct answer
                            question.querySelector(".answer[data-correct='1']").classList
                                .add("correct");
                            question.querySelector(".answer[data-correct='1']").style
                                .color = "white";
                            question.querySelector(".answer[data-correct='1']").style
                                .backgroundColor = "green"; // Add light green border

                            answered = true; // Set answered flag to true

                            // Disable further selection
                            answers.forEach(ans => {
                                ans.removeEventListener("click");
                            });
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
