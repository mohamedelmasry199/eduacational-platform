<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Administrateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css.map') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .user_input,
        .add_button {
            border: 1px solid #ccc;
            /* Border color */
            border-radius: 5px;
            /* Rounded corners */
            padding: 10px;
            /* Padding */
            font-size: 16px;
            /* Font size */
            outline: none;
            /* Remove outline */
            margin-bottom: 10px;
            /* Margin bottom */
            box-sizing: border-box;
            /* Include padding in width/height */
        }

        /* Select styling */
        select.user_input {
            appearance: none;
            /* Remove default appearance */
            background: transparent;
            /* Transparent background */
            background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            /* Custom arrow */
            background-repeat: no-repeat;
            /* No repeat */
            background-position: right 10px center;
            /* Position arrow */
            padding-right: 30px;
            /* Padding right for arrow */
        }

        /* Textarea styling */
        textarea.user_input {
            resize: none;
            /* Disable resize */
        }

        /* Button styling */
        .add_button {
            background-color: #007bff;
            /* Button background color */
            color: #fff;
            /* Button text color */
            cursor: pointer;
            /* Cursor style */
            transition: background-color 0.3s;
            /* Transition effect for background color */
        }

        .add_button:hover {
            background-color: #0056b3;
            /* Button background color on hover */
        }

        .answer_fields {
            display: flex;
            /* Use flexbox to align items */
            align-items: center;
            /* Align items vertically */
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            /* Add a border to separate answers */
            padding-bottom: 10px;
            /* Add padding for better spacing */
        }

        /* Adjust width of answer textarea and true/false dropdown */
        .answer_fields textarea {
            flex: 1;
            /* Take up available space */
            margin-right: 10px;
            /* Margin between answer and true/false dropdown */
        }

        .answer_fields select {
            margin-left: 10px;
            /* Adjust this value to move the true/false dropdown to the right */
        }
    </style>
</head>

<body>

    <div class="admin_parent row m-0 d-flex justify-content-between">
        <div class="admin_child1 d-flex bg-dark col-lg-3 col-12">
            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-users add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('addUser') }}">
                    <h2 class="add_users">Les données membre</h2>
                </a>
            </div>

            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('filteration') }}">
                    <h2 class="add_data">QCM données</h2>
                </a>
            </div>

            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-chalkboard-teacher add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('addYear') }}">
                    <h2 class="add_year">ajouter une année</h2>
                </a>
            </div>

            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('addSubject') }}">
                    <h2 class="add_subject">ajouter un Module</h2>
                </a>
            </div>

            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('addChapter') }}">
                    <h2 class="add_chapter">ajouter un Cours</h2>
                </a>
            </div>
            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('createQuestion') }}">
                    <h2 class="add_chapter" style="color: rgb(11, 108, 255); border-color:rgb(11, 108, 255);">Créer Question</h2>
                </a>
            </div>
            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('home') }}"><h2 class="add_data">accueil page</h2></a>
            </div>
        </div>

        <form action="{{ route('store_question') }}" method="POST" class="admin_child2 col-lg-9 col-12">
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="create_chapter">
                <div class="add_user_input col-11" id="add_user">
                    <select name="chapter_name" class="user_input col-11 col-md-5 col-lg-5 mt-2 mb-md-0 mb-3 mx-3">
                        <option value="">Sélectionnez le Cours</option>
                        @foreach ($chapters as $chapter)
                            <option value="{{ $chapter->chapter_name }}">{{ $chapter->chapter_name }}</option>
                        @endforeach
                    </select>
                    <textarea type="text" name="question" class="user_input textarea col-11 col-md-5 col-lg-5 mt-2 mb-md-0 mb-3 "
                        placeholder="Entrez la question"></textarea>
                        <div class="add_user_input col-11" id="add_user">
                            <textarea type="text" name="comment" class="user_input textarea col-11 col-md-10 col-lg-10 mt-2 mb-3"
                                placeholder="Entrez un commentaire"></textarea>
                        </div>
                    <select name="type" class="user_input col-11 col-md-5 col-lg-5  mt-2 mt-md-5 mb-md-0 mb-3 mx-3"
                        id="select">
                        <option value="QCM">QCM</option>
                        <option value="Cas Cliniques">Cas Cliniques</option>
                    </select>
                    <select name="source" class="user_input col-11 col-md-5 col-lg-5 mt-2 mt-md-5">
                        <!-- <option value="">Sélectionner la source</option>
                        <option value="Residanat">Residanat</option>
                        <option value="Reponse unique">Reponse unique</option>
                        <option value="Réponse multiple">Réponse multiple</option> -->
                        <option selected style="display:none">Source</option>
                        {{-- <option value="all">Tout sélectionner</option> --}}
                        <option value="Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat">Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat</option>
                        <option value="Residanat de la faculté Médecine en Algerie">Residanat de la faculté Médecine en Algerie</option>
                    </select>

                    <!-- Input fields for answers -->
                    <div class="row d-flex ms-md-5 ms-1">

                        <div class="answers">
                            <div class="answer_fields col-12 ms-0 ms-md-3 row">
                                <textarea type="text" name="answers[0][answer]" class="user_input textarea col-md-5 col-12 mb-4 mt-2 mt-md-5 me-md-5"
                                    placeholder="Entrez la réponse"></textarea>
                                <select name="answers[0][is_correct]"
                                    class="user_input col-12 col-md-5 mb-4 mt-2 mt-md-5">
                                    <option value="1">Vrai</option>
                                    <option value="0">FAUX</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-10 col-11 me-md-3 me-5 row mt-3 ms-md-1 d-flex justify-content-between">
                            <button type="button" class="add_button chapter_btn col-md-5 col-lg-4 col-12 mb-4"
                                id="add_answer">Ajouter une réponse</button>
                            <button type="submit"
                                class="add_button chapter_btn col-md-5 col-lg-4 col-12 mb-4 ">Créer</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addAnswerButton = document.getElementById('add_answer');
                const answersContainer = document.querySelector('.answers');

                addAnswerButton.addEventListener('click', function() {
                    const answerFields = document.createElement('div');
                    answerFields.classList.add('answer_fields');
                    answerFields.innerHTML = `
                <textarea type="text" name="answers[${answersContainer.children.length}][answer]" class="user_input textarea col-md-5 col-12 mb-4 mt-2 mt-md-5 me-md-5" placeholder="Entrez la réponse"></textarea>
                <select name="answers[${answersContainer.children.length}][is_correct]" class="user_input col-md-5 col-12 mb-4 mt-2 mt-md-5">
                    <option value="1">Vrai</option>
                    <option value="0">FAUX</option>
                </select>
            `;
                    answersContainer.appendChild(answerFields);
                });
            });
        </script>
















        {{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Filteration Bage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css.map') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="admin_parent row m-0 d-flex justify-content-between">
      <!-- ///////////// Dashboard  /////////////// -->
      <div class="admin_child1 d-flex bg-dark col-lg-3 col-12">
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-users add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addUser') }}"><h2 class="add_users">Users Data</h2></a>
          </div>

        <div class="arrow_parent mt-3 mb-4 d-flex">
          <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
          <a href="{{ route('filteration') }}"><h2 class="add_data" style="color: rgb(11, 108, 255); border-color: rgb(11, 108, 255);">QCM Data</h2></a>
        </div>

        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-chalkboard-teacher add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addYear') }}"><h2 class="add_year">Add Year</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addSubject') }}"><h2 class="add_subject">Add Subject</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addChapter') }}"><h2 class="add_chapter">Add Chapter</h2></a>
          </div>
      </div>

      <!-- //////////////// Show Filteration //////////// -->
      <div class="admin_child2 col-lg-9 col-12">
        <div class="filter_data">
            <form id="filterForm" action="{{ route('editQuestions') }}" method="POST">
                @csrf

                <div
              class="row m-0 mb-5 d-flex justify-content-center align-item-center"
            >
              <div class="select-parent col-lg-7 col-md-8 col-10">
                <label value="year" for="select" class="col-12 mb-4 text-center Filter">Filter</label>
                <select name="year" id="yearsSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" onchange="loadSubjects()">
                  <option selected style="display:none">Liste des modules</option>
                  @foreach ($years as $year)
                      <option value="{{ $year->id }}">{{ $year->year }}</option>
                  @endforeach
              </select>

              <select name="subject_name" id="subjectsSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                  <option selected style="display:none">Liste des Cours</option>
              </select>

              <select name="chapter_name" id="chaptersSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                  <option selected style="display:none">Liste des Chapitres</option>
                  <option value="1">Select All</option>
              </select>

                  <select name="type" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" onclick="redirectIfNotLoggedIn()"
                    aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Type</option>
                    <option value="all">Select All</option>
                    <option value="QCM">QCM</option>
                    <option value="Cas Cliniques">Cas Cliniques</option>
                  </select>
                  <select name="source" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" onclick="redirectIfNotLoggedIn()"
                    aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Source</option>
                    <option value="all">Select All</option>
                    <option value="M">M</option>
                    <option value="C">C</option>
                  </select>
                  <button id="submitBtn">Submit</button>
              </form>
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
      </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script>
          function redirectIfNotLoggedIn() {
          // Check if user is authenticated
          @guest
              // Redirect to login page
              window.location.href = "{{ route('login') }}";
          @endguest
      }
      function loadSubjects() {
          redirectIfNotLoggedIn();

          var yearId = document.getElementById("yearsSelect").value;
          var subjectsSelect = document.getElementById("subjectsSelect");
          var chaptersSelect = document.getElementById("chaptersSelect");

          // Hide the chapters select initially
          chaptersSelect.style.display = "none";

          // If a year is selected
          if (yearId !== "") {
              // Show the subjects select
              subjectsSelect.style.display = "block";

              // Send a request to the server to fetch subjects related to the selected year
              fetch("{{ route('subjects.by.year', ':year') }}".replace(':year', yearId))
                  .then(response => response.json())
                  .then(data => {
                      // Display the received subjects in the subjects select
                      subjectsSelect.innerHTML = "<option selected style='display:none'>Liste des Cours</option>";
                      for (const [id, subject_name] of Object.entries(data)) {
                          subjectsSelect.innerHTML += "<option value='" + id + "'>" + subject_name + "</option>";
                      }
                  })
                  .catch(error => {
                      console.error('Error:', error);
                  });
          } else {
              // Hide the subjects select if no year is selected
              subjectsSelect.style.display = "none";
          }
      }

      function loadChapters() {
          redirectIfNotLoggedIn();

      var subjectId = document.getElementById("subjectsSelect").value;
      var chaptersSelect = document.getElementById("chaptersSelect");

      // If a subject is selected
      if (subjectId !== "") {
          // Show the chapters select
          chaptersSelect.style.display = "block";

          // Send a request to the server to fetch chapters related to the selected subject
          fetch("{{ route('chapters.by.subject', ':subject') }}".replace(':subject', subjectId))
              .then(response => response.json())
              .then(data => {
                  // Display the received chapters in the chapters select
                  chaptersSelect.innerHTML = "<option selected style='display:none'>Liste des Chapitres</option>";
                  chaptersSelect.innerHTML += "<option value='all'>Select All</option>"; // Add Select All option
                  for (const [id, chapter_name] of Object.entries(data)) {
                      chaptersSelect.innerHTML += "<option value='" + id + "'>" + chapter_name + "</option>";
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
              });
      } else {
          // Hide the chapters select if no subject is selected
          chaptersSelect.style.display = "none";
      }

      }

      // Call loadChapters function when subject is changed
      document.getElementById("subjectsSelect").addEventListener("change", loadChapters);
  </script>
  <script>





  </body>

  </html> --}}
