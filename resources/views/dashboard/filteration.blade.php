<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Bagage de filtration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css.map') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="admin_parent row m-0 d-flex justify-content-between">
      <!-- ///////////// Dashboard  /////////////// -->
      <div class="admin_child1 d-flex bg-dark col-lg-3 col-12">
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-users add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addUser') }}"><h2 class="add_users">Données des membre</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('filteration')}}"><h2 class="add_chapter">Données QCM</h2></a>
        </div>

        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-chalkboard-teacher add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addYear') }}"><h2 class="add_year">ajouter une année</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addSubject') }}"><h2 class="add_subject">ajouter un Module</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addChapter') }}"><h2 class="add_chapter">ajouter un Cours</h2></a>
          </div>
          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('createQuestion')}}"><h2 class="add_chapter">Créer Question</h2></a>
        </div>
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('home') }}"><h2 class="add_data">accueil page</h2></a>
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
                  <option selected style="display:none">Liste des Années scolaires</option>
                  @foreach ($years as $year)
                      <option value="{{ $year->id }}">{{ $year->year }}</option>
                  @endforeach
              </select>

              <select name="subject_name" id="subjectsSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                  <option selected style="display:none">Liste des Modules</option>
              </select>

              <select name="chapter_name" id="chaptersSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                  <option selected style="display:none">Liste des Cours</option>
                  <option value="1">Tout sélectionner</option>
              </select>

                  <select name="type" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" onclick="redirectIfNotLoggedIn()"
                    aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Type d'examen</option>
                    <option value="all">Tout sélectionner</option>
                    <option value="QCM">QCM</option>
                    <option value="Cas Cliniques">Cas Cliniques</option>
                  </select>
                  <select name="source" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" onclick="redirectIfNotLoggedIn()"
                    aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Source</option>
                    <option value="all">Tout sélectionner</option>
                    <!-- <option value="Residanat">Residanat</option>
                    <option value="Reponse unique">Reponse unique</option>
                    <option value="Réponse multiple">Réponse multiple</option> -->
                    <option value="Residanat">Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat</option>
                    <option value="Reponse unique">Residanat de la faculté Médecine en Algerie</option>
                  </select>

                  <button id="submitBtn">Soumettre</button>
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
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
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
                      subjectsSelect.innerHTML = "<option selected style='display:none'>Liste des Modules</option>";
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
                  chaptersSelect.innerHTML = "<option selected style='display:none'>Liste des Cours</option>";
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

  </html>
