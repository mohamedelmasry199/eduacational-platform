<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Administrateur</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md d-flex m-0 justify-content-between">
      <div class="container-fluid header">
        <a class="navbar-brand logo" href="{{ route('home') }}">
            <img src="{{ asset('IMG-20240314-WA0217-removebg-preview.png') }}"
            style="width: 130px; height: 130px; margin:-37px 0 -50px 0" alt="MCQ Lab Logo">
          </a>        
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-lg-5">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('home') }}">accueil</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="info_dev col-lg-6 col-md-9 col-11">
    <h2>la une année :<span>{{ $year->year }}</span></h2>
    <h2>Le Module :<span>{{ $subject->subject_name }}</span></h2>
    <h2 style="display: inline">Le Cours :<span>@if (!$chapters)
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
    @foreach($questions as $index => $item)
    <p class="answer_type">Type d'examen: {{ $item->type }}</p>

    <div class="devs">
      <h2 class="question d-inline-block mb-4">{{ $item->question }}?</h2>
      <form method="POST" action="{{ route('delete.question', ['questionId' => $item->id]) }}" class="d-inline-flex" id="delete_question_form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $item->id }}">
        <button type="submit" class="delete_button mb-0 ms-3 me-2 my-2">Delete</button>
      </form>
      <button type="button" class="update_button quiz_update_button1 my-2">Update</button>

      <!-- Update Question Form -->
      <form method="POST" action="{{ route('update.question', ['questionId' => $item->id]) }}" class="Update_dev1 col-lg-6 col-md-8 col-10 questionUpdateDev" style="display:none;">
        @csrf <!-- CSRF token -->
        @method('PUT') <!-- Use PUT method for update -->
        <h2 class="update_h2">Update Question</h2>
        <div class="text-center">
            <textarea placeholder="Question de mise à jour" name="question" class="textarea question-textarea col-10 mb-2">{{ isset($item->question) ? $item->question : old("questions.$loop->index.question") }}</textarea>
            <textarea placeholder="Mettre à jour le commentaire" name="comment" class="textarea comment-textarea col-10 mb-2">{{ isset($item->comment) ? $item->comment : old("comments.$loop->index.comment") }}</textarea>
            <button type="submit" class="add_button col-5 mb-5">Soumettre</button>

        </div>
    </form>
      <?php $i=['a','b','c','d','e','F','G']; ?>

       @foreach($item->answers as $answer)
        <div class="answer d-flex"id="answerdiv" data-correct="{{ $answer->is_correct }}" data-index="{{ $loop->index }}">

            <span>{{ $i[$loop->index] }}-{{ $answer->answer }}</span>
            <span class="is-correct {{ $answer->is_correct ? 'Correct' : 'NotCorrect' }}">{{ $answer->is_correct ? 'Correct' : 'Not Correct' }}</span>
            <form method="POST" action="{{ route('delete.answer',['answerId' => $answer->id]) }}" id="delete_answer_form">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $answer->id }}">
            <button type="submit" class="delete_button mb-0 ms-3 me-2 my-2">Supprimer</button>
          </form>
          <button type="button" class="update_button quiz_update_button2 my-2">Mise à jour</button>

          <!-- Update Answer Form -->
          <form method="POST" action="{{ route('update.answer', ['answerId' => $answer->id]) }}" class="Update_dev2 col-lg-6 col-md-8 col-10 answerUpdateDev" style="display:none;">
            @csrf <!-- CSRF token -->
            @method('POST') <!-- Use POST method for update -->
            <h2 class="update_h2">Update Answer</h2>
            <div class="text-center col-11 m-auto">
                <textarea placeholder="Update Answer" name="answer" class="textarea question-textarea col-10 mb-2" style="border-radius: 10px">{{ old("answers.$loop->index.answer") ?? $answer->answer }}</textarea>
                <select name="is_correct" class="form-select question-select col-10 mb-4">
                    <option value="1" {{ old("answers.$loop->index.is_correct") == 1 ? 'selected' : '' }}>Correct</option>
                    <option value="0" {{ old("answers.$loop->index.is_correct") == 0 ? 'selected' : '' }}>Faux</option>
                </select>

                <button type="submit" class="add_button col-5 mb-5">Soumettre</button>
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
            </div>

          </form>
        </div>
        @endforeach
        <h2 class="question d-inline-block mb-4">Commentaire : {{ $item->comment }}</h2>

      <br />
    </div>
    @endforeach
  </div>

  <!-- Include Bootstrap JS -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/all.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Function to toggle update form display
      function toggleUpdateForm(updateForm) {
        if (updateForm.style.display === "none") {
          // Hide all other update forms
          document.querySelectorAll(".update_dev1, .update_dev2").forEach(function(form) {
            form.style.display = "none";
          });
          updateForm.style.display = "block"; // Show the clicked update form
        } else {
          updateForm.style.display = "none"; // Hide the clicked update form
        }
      }

      // Event listeners for updating questions
      var updateButtons = document.querySelectorAll(".quiz_update_button1");
      updateButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
          event.stopPropagation();
          var updateForm = button.nextElementSibling; // Assuming the form is next sibling
          toggleUpdateForm(updateForm);
        });
      });

      // Event listeners for updating answers
      var updateButtonsAnswers = document.querySelectorAll(".quiz_update_button2");
      updateButtonsAnswers.forEach(function (button) {
        button.addEventListener("click", function (event) {
          event.stopPropagation();
          var updateForm = button.nextElementSibling; // Assuming the form is next sibling
          toggleUpdateForm(updateForm);
        });
      });

      // Event listener to close update forms when clicking outside
      document.body.addEventListener("click", function (event) {
    // Get all elements with class "update_dev1" or "update_dev2"
    var updateForms = document.querySelectorAll(".questionUpdateDev");
    // Check if the clicked element is not one of the update forms
    if (!event.target.matches('.questionUpdateDev') && !event.target.closest('.questionUpdateDev')) {
        // If it's not, hide all update forms
        updateForms.forEach(function (updateForm) {
            updateForm.style.display = "none";
        });
    }
});
 // Event listener to close update forms when clicking outside
 document.body.addEventListener("click", function (event) {
    // Get all elements with class "update_dev1" or "update_dev2"
    var updateForms = document.querySelectorAll(".answerUpdateDev");
    // Check if the clicked element is not one of the update forms
    if (!event.target.matches('.answerUpdateDev') && !event.target.closest('.answerUpdateDev')) {
        // If it's not, hide all update forms
        updateForms.forEach(function (updateForm) {
            updateForm.style.display = "none";
        });
    }
});
    });

  </script>
</body>
</html>
