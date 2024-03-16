<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>page de données utilisateur</title>
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
                <a href="{{ route('addUser') }}"><h2 class="add_users" style="color:rgb(11, 108, 255); border-color: rgb(11, 108, 255);">Données des membre</h2></a>
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
                <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('createQuestion') }}"><h2 class="add_data">Créer Question</h2></a>
            </div>
            <div class="arrow_parent mt-3 mb-4 d-flex">
                <i class="fas fa-book-open add_icon mt-2 me-3 mb-4"></i>
                <a href="{{ route('home') }}"><h2 class="add_data">accueil page</h2></a>
            </div>
        </div>

    <!-- Add User Form -->
    <form action="{{ route('storeUser') }}" method="POST" class="admin_child2 col-lg-9 col-12">
        @csrf
        <div class="part2_hidden">
            <div class="add_user_input col-11 mb-3" id="add_user">
                <input
                    type="text"
                    name="code"
                    class="user_input col-11 col-md-5 mt-5 me-3 ms-3"
                    placeholder="Ajouter un code utilisateur"
                />
                <select name="status" class="user_input col-11 col-md-5 mt-3 mt-md-5" style="background-color: white; border-radius:10px">
                    <option value="admin" {{ old('status') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="user" {{ old('status') == 'user' ? 'selected' : '' }}>membre</option>
                </select>

                <button type="submit" class="add_button mt-4 col-md-4 col-7 ">Ajouter</button>
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
    <!-- User Table -->
    <div class="admin_child2 ">
        <div class="row">
            <div class="col">
                <h2 class="text-center table-text">Données des membre</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Code</th>
                            <th>Première connexion à</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->code }}</td>
                                <td>{{ $user->first_login_at }}</td>
                                <td>{{ $user->status }}</td>
                                <td class="table_button_parent col-5">
                                    <form action="{{ route('deleteUser', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete_button mb-md-0 mb-2 me-md-4">Supprimer</button>
                                    </form>
                                    <button type="button" class="update_button update_button1">mise à jour</button>
                                    <!-- Update Form -->
                                    <form action="{{ route('updateUser', $user->id) }}" method="POST" class="update-form" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="code" class="updated-user-input mt-3 col-11 col-md-4" value="{{ $user->code }}"style="background-color: white; border-radius:10px;padding:0 12px">
                                        <select name="status" class="user_input col-11 col-md-4 mt-3 "style="background-color: white; border-radius:10px; height:47px">
                                            <option value="admin" {{ old('status') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                            <option value="user" {{ old('status') == 'user' ? 'selected' : '' }}>membre</option>
                                        </select>
                                        <br/>
                                        <button type="submit" class="submit-update-button col-6 col-md-4 mt-3">Soumettre</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="js/all.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap.bundle.min.js.map"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var updateButtons = document.querySelectorAll(".update_button1");
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
