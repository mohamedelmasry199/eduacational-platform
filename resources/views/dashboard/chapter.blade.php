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
</head>
<body>

<div class="admin_parent row m-0 d-flex justify-content-between">
    <div class="admin_child1 d-flex bg-dark col-lg-3 col-12">
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-users add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addUser') }}"><h2 class="add_users">Les données membre</h2></a>
          </div>

          <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('filteration')}}"><h2 class="add_chapter">QCM données</h2></a>
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
            <a href="{{ route('addChapter') }}"><h2 class="add_chapter" style="color: rgb(11, 108, 255); border-color:rgb(11, 108, 255);">ajouter un Cours</h2></a>
        </div>
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('createQuestion') }}"><h2 class="add_data">Créer Question</h2></a>
        </div>
        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('home') }}"><h2 class="add_data">accueil page</h2></a>
        </div>
    </div>

    <!-- Create New Chapter Form -->
    <div class="admin_child2 col-lg-9 col-12">
        <form action="{{ route('storeChapter') }}" method="POST" class="admin_child2">
            @csrf
            <div class="create_chapter">
                <div class="add_user_input col-11" id="add_user">
                    <input type="text" name="subject_name" class="user_input col-11 col-md-5 col-lg-5 mb-4 mt-2 mt-md-5 me-3" placeholder="Entrez le nom du Module" />
                    <input type="text" name="chapter_name" class="user_input col-11 col-md-5 col-lg-5 mb-4 mt-2 mt-md-5" placeholder="Entrez dans un nouveau Cours" />
                    <button type="submit" class="add_button chapter_btn col-md-3 col-6 mb-3">Créer</button>
                </div>
            </div>
        </form>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Chapter Table -->
        <div class="admin_child2 mt-5">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            {{-- <td><input type="checkbox" id="checkbox_parent4" /></td> --}}
                            <th>Année Nom</th>
                            <th>Module Nom</th>
                            <th>Cours Nom</th>
                            <th class="col-lg-3 col-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($chapters as $chapter)
                        <tr>
                            {{-- <td><input type="checkbox" class="table_checkbox4 responsive_checkbox_edit" /></td> --}}
                            <td class="responsive_edit">{{ $chapter->subject->year->year }}</td>
                            <td class="responsive_edit">{{ $chapter->subject->subject_name }}</td>
                            <td class="responsive_edit">{{ $chapter->chapter_name }}</td>
                            <td class="table_button_parent col-lg-3 col-4">
                                <form action="{{ route('deleteChapter', $chapter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete_button mb-md-0 mb-2 me-md-4">Supprimer</button>
                                </form>
                                <button type="button" class="update_button update_button4" data-chapter-id="{{ $chapter->id }}">mise à jour</button>
                                <form action="{{ route('updateChapter', $chapter->id) }}" method="POST" class="update-form" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="chapter_name" class="updated-chapter-input" placeholder="Entrez le nom du cours" value="{{ $chapter->chapter_name }}">
                                    <button type="submit" class="submit-update-button">Soumettre</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucun chapitre trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <form method="POST" action="{{ route('chapters.delete.all') }}" id="delete_all_form">
                @csrf
                <button type="submit" id="delete_all" class="delete_button">Supprimer tout</button>
            </form>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    {{-- <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var updateButtons = document.querySelectorAll(".update_button");
            var updateForms = document.querySelectorAll(".update-form");

            updateButtons.forEach(function (updateButton) {
                updateButton.addEventListener("click", function (event) {
                    event.stopPropagation();
                    var updateForm = this.nextElementSibling;
                    toggleUpdateForm(updateForm);
                });
            });

            document.body.addEventListener("click", function (event) {
                updateForms.forEach(function (updateForm) {
                    if (!updateForm.contains(event.target)) {
                        updateForm.style.display = "none";
                    }
                });
            });

            function toggleUpdateForm(updateForm) {
                if (updateForm.style.display === "none") {
                    updateForms.forEach(function (form) {
                        form.style.display = "none";
                    });
                    updateForm.style.display = "block";
                } else {
                    updateForm.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
