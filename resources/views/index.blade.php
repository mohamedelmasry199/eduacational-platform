<?php
session_start();
if (!isset($_SESSION['code'])) {
    $signInButtonStyle = '';
    $signUpButtonStyle = '';
    $logoutButtonStyle = 'display:none';
} else {
    $signInButtonStyle = 'display:none';
    $signUpButtonStyle = 'display:none';
    $logoutButtonStyle = '';
}
?>
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
        <nav class="navbar navbar-expand-lg px-md-5 d-flex m-0 justify-content-between">
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
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-lg-5">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">accueil</a>
                        </li>
                        @auth
                            @if (auth()->user()->status == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}">Tableau de bord</a>
                                </li>
                            @endif
                        @endauth
                        {{-- @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn logout btn-outline-primary" >Déconnecté</button>
                        </form>
                        @endauth --}}

                    </ul>
                    <div class="d-flex login-parent ml-lg-auto">
                        @guest
                            <a href="{{ route('login') }}" class="btn login mx-3 btn-outline-primary"
                                style="{{ $signInButtonStyle }}">Connexion</a>
                            <form method="POST" action="{{ route('generate_code') }}">
                                @csrf
                                <button class="btn logout btn-outline-primary">générez votre code 24h</button>
                            </form>

                        @endguest
                        @auth
                            @if (auth()->user()->status == 'admin')
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
    <form id="filterForm" action="{{ route('suitable.quiz1') }}" method="POST">
        @csrf
        <div class="row m-0 d-flex justify-content-center align-item-center">
            <div class="select-parent col-lg-7 col-md-8 col-10">
                <label value="year" for="select" class="col-12 mb-4 text-center Filter">Filter</label>
                <select name="year" id="yearsSelect" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3"
                    onchange="loadSubjects()">
                    <option selected style="display:none">Liste des Années scolaires</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                    @endforeach
                </select>

                <select name="subject_name" id="subjectsSelect"
                    class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                    <option selected style="display:none">Liste des Modules</option>
                </select>

                <select name="chapter_name" id="chaptersSelect"
                    class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3" style="display: none;">
                    <option selected style="display:none">Liste des Cours</option>
                    <option value="1">Tout sélectionner</option>
                </select>

                <select name="type" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3"
                    onclick="redirectIfNotLoggedIn()" aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Type d'examen</option>
                    <option value="all">Tout sélectionner</option>
                    <option value="QCM">QCM</option>
                    <option value="Cas Cliniques">Cas Cliniques</option>
                </select>
                <select name="source" class="form-select form-select-lg col-lg-5 col-md-8 col-10 mb-3"
                    onclick="redirectIfNotLoggedIn()" aria-label=".form-select-lg multiple select example">
                    <option selected style="display:none">Source</option>
                    <option value="all">Tout sélectionner</option>
                    <option value="Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat">Toutes ces questions là sont des questions tombables et prennent comme source les sujets d'externat</option>
                    <option value="Residanat de la faculté Médecine en Algerie">Residanat de la faculté Médecine en Algerie</option>
                    <!-- <option value="Réponse multiple">Réponse multiple</option> -->
                </select>
                <button id="submitBtn">Soumettre</button>
    </form>
    <div id="quizQuestions"></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('error'))
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
                        chaptersSelect.innerHTML += "<option value='all'>Tout sélectionner</option>"; // Add Select All option
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
        < /body>

        <
        /html>
