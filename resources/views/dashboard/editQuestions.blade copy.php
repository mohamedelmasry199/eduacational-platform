<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Administrateur</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap"
          rel="stylesheet"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-md d-flex m-0 justify-content-between">
        <div class="container-fluid header">
            <a class="navbar-brand logo" href="index.html">MCQ Lab</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-lg-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="info_dev col-lg-6 col-md-9 col-11">
    <h2>Le module :<span>{{ $year->year }}</span></h2>
    <h2>Le Cours :<span>{{ $subject->subject_name }}</span></h2>
    <h2>La chapitre :<span>@if (!$chapters)
        {{$chapter->chapter_name}}
    @else
    @foreach($chapters as $chapter)
        {{ $chapter->chapter_name }}, @endforeach
        @endif
    </span></h2>
    <h2>source :<span>@if ($questionSource) {{ $questionSource }}@else{{ $questions[0]->source }} @endif</span></h2>
    <h2>Type d'examen :<span>@if($questionType){{ $questionType }}@else{{ $questions[0]->type }}@endif</span></h2>
</div>

<div class="question_dev col-md-10 col-11">
    <div class="devs d-flex justify-content-center row m-0">
        <h2 class="Add_question text-center pt-3 col-12">Add New Question</h2>
        <form action="{{ route('store_question') }}" method="POST">
            @csrf
            <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
            <!-- Other input fields for the question data -->
            <div class="question-container col-12 my-3 mb-4 d-flex justify-content-center">
                <textarea name="question" placeholder="Enter New Question" class="textarea question-textarea col-10 me-3"></textarea>
                <i class="fas fa-plus-circle plus mt-3" onclick="addNewTextarea()"></i>
            </div>
            <!-- Additional inputs for answers, correct answer ID, etc. -->
            <button type="submit" class="add_new_question">Add</button>
        </form>


        <div class="question_dev col-md-10 col-11">
            <div class="devs">
              <div class="question_buttons d-flex justify-content-end pt-3 pe-3">
                <button type="submit" class="delete_button mb-0 me-4">Delete</button>
                <button
                  type="submit"
                  class="update_button update_button4"
                  id="update_answer"
                >
                  Update
                </button>
              </div>
              @foreach($questions as $index => $item)

                  <h2 class="question">{{ $item->question }} ?</h2> <!-- Access 'question' directly -->

                      <p>Type: {{ $item->type }}</p>
              <div class="answer">
                  <?php $i=['a','b','c','d','e','F','G']; ?>
                  @foreach($item->answers as $answer)
                  <div class="answer" data-correct="{{ $answer->is_correct }}" data-index="{{ $loop->index }}">
                      <span>{{ $i[$loop->index] }}-{{ $answer->answer }}</span>
                  </div>
                  @endforeach
              </div>
            </div>
            @endforeach
        </div>


    </div>
</div>

<div id="update_dev" class="Update_dev1 col-lg-6 col-md-8 col-10" style="display: none;">
    <h2 class="update_h2">Update Data</h2>
    <div class="text-center">
        <textarea placeholder="Update Question" class="textarea question-textarea col-10 mb-2"></textarea>
        <textarea placeholder="Update Answer" class="textarea question-textarea col-10 mb-2"></textarea>
        <textarea placeholder="Update Answer" class="textarea question-textarea col-10 mb-2"></textarea>
        <textarea placeholder="Update Answer" class="textarea question-textarea col-10 mb-2"></textarea>
        <textarea placeholder="Update Answer" class="textarea question-textarea col-10 mb-2"></textarea>
        <button type="submit" class="add_button col-5 mb-5">
            Submit
        </button>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>
<script>
    function addNewTextarea() {
        // Create a new container for question-answer pair
        var container = document.createElement("div");
        container.classList.add("question-answer-container", "col-12", "d-flex", "justify-content-center");

        // Create a new answer textarea element
        var newTextarea = document.createElement("textarea");
        newTextarea.setAttribute("placeholder", "Enter New Answer");
        newTextarea.classList.add("col-md-8", "col-9", "mb-3", "textarea");

        // Append the new answer textarea to the container
        container.appendChild(newTextarea);

        // Append the container below the existing question-answer containers
        var questionContainers = document.querySelectorAll(".question-container");
        var lastContainer = questionContainers[questionContainers.length - 1];
        lastContainer.parentNode.insertBefore(container, lastContainer.nextSibling);
    }

    document.addEventListener("DOMContentLoaded", function () {
        var update_answer = document.querySelector("#update_answer")
        var update_dev = document.querySelector("#update_dev")
        update_dev.style.display = "none";

        update_answer.addEventListener("click", function (event) {
            event.stopPropagation();
            update_dev.style.display =
                update_dev.style.display === "none" ? "block" : "none";
        });

        document.body.addEventListener("click", function (event) {
            if (!update_dev.contains(event.target)) {
                update_dev.style.display = "none";
            }
        });
    });
</script>
</body>
</html>
