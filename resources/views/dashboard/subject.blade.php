<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Page des Modules</title>
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
            <i class="fas fa-chalkboard-teacher add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addSubject') }}"><h2 class="add_subject" style="color: rgb(11, 108, 255); border-color:rgb(11, 108, 255);">ajouter un Module</h2></a>
        </div>

        <div class="arrow_parent mt-3 mb-4 d-flex">
            <i class="fas fa-layer-group add_icon mt-2 me-3 mb-4"></i>
            <a href="{{ route('addChapter') }}"><h2 class="add_chapter">ajouter un Cours</h2></a>
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

    <!-- Create New Subject Form -->
    <form action="{{ route('storeSubject') }}" method="POST" class="admin_child2 col-lg-9 col-12">
        @csrf
        <div class="create_subject">
            <div class="add_user_input col-11" id="add_user">
                <input type="text" name="year" class="user_input col-11 col-md-5 col-lg-5 mx-md-2 mb-4 mt-5" placeholder="Entrez le nom de l'année" />
                <input type="text" name="subject_name" class="user_input col-11 col-md-5 col-lg-5 mb-4 mt-2 mt-md-5" placeholder="Entrez un nouveau Module" />
                <button type="submit" class="add_button col-md-3 col-6 mb-3">Créer</button>
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
    <!-- Subject Table -->
    <div class="admin_child2 mt-5">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
                        {{-- <td><input type="checkbox" id="checkbox_parent3" /></td> --}}
                        <th>Année Nom</th>
                        <th>Module Nom</th>
                        <th class="col-lg-3 col-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                    <tr>
                        <td class="responsive_edit">{{ $subject->year->year }}</td>
                        <td class="responsive_edit">{{ $subject->subject_name }}</td>
                        <td class="table_button_parent col-lg-3 col-4">
                            <form action="{{ route('deleteSubject', $subject->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete_button mb-md-0 mb-2 me-md-4">Supprimer</button>
                            </form>
                            <button type="button" class="update_button update_button3" data-subject-id="{{ $subject->id }}">Mise à jour</button>
                            <form action="{{ route('updateSubject', $subject->id) }}" method="POST" class="update-form" style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="subject_name" class="updated-subject-input" placeholder="Entrez le nom du Module" value="{{ $subject->subject_name }}">
                                <button type="submit" class="submit-update-button">Soumettre</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun chapitre trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <form method="POST" action="{{ route('delete.all.subjects') }}" id="delete_all_form">
            @csrf
            <button type="submit" id="delete_all" class="delete_button">Supprimer tout</button>
        </form>

        <!-- Update Subject Data -->
        <div id="Update_dev3">
            <div class="Update_dev1 d-flex justify-content-center col-lg-5 col-md-7 col-sm-8 col-10">
                <h2 class="update_h2">Mettre à jour les données</h2>
                <div class="text-center">
                    <input type="text" class="user_input col-9 mb-4" placeholder="Mettre à jour le nom du Module" />
                    <button type="submit" class="add_button col-6 mb-5">Soumettre</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var updateButtons = document.querySelectorAll(".update_button3");
        var updateForms = document.querySelectorAll(".update-form");

        updateButtons.forEach(function (updateButton) {
            updateButton.addEventListener("click", function () {
                var updateForm = this.nextElementSibling;
                var subjectId = this.dataset.subjectId; // Get the subject ID
                toggleUpdateForm(updateForm);
                populateUpdateFormFields(subjectId); // Populate update form fields with subject data
            });
        });

        function toggleUpdateForm(updateForm) {
            updateForms.forEach(function (form) {
                if (form !== updateForm) {
                    form.style.display = "none";
                }
            });
            if (updateForm.style.display === "none") {
                updateForm.style.display = "block";
            } else {
                updateForm.style.display = "none";
            }
        }

        function populateUpdateFormFields(subjectId) {
            // Assuming you have fetched subject data from the server, populate the form fields accordingly
            var updatedSubjectInput = document.querySelector(".updated-subject-input");
            updatedSubjectInput.value = ""; // Populate with subject data
        }
    });
</script>

</body>
</html>
