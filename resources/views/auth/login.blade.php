<x-guest-layout>
    <!-- Session Status -->

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
                    </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <li class="nav-item pt-2" style="margin-top:-30px">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">accueil</a>
                        </li>
                        <ul class="navbar-nav signin-btn d-flex ml-auto flex-row">
                            {{-- <li><a href="{{ route('register') }}" class="btn login mx-3 btn-outline-primary">Sign Up</a></li> --}}
                            {{-- <li><a href="{{ route('login') }}" class="btn login btn-outline-primary">Sign in</a></li> --}}
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="responsive">
                <x-input-label for="code" :value="'code'" />
                <x-text-input id="code" class="block mt-1 w-full" type="text" placeholder="Entrez votre code"
                    name="code" :value="old('code')" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ 'Remember me' }}</span>
                </label>
            </div>
            {{-- <div class="mt-4">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">{{ ('Register') }}</a></p>
        </div> --}}

        <div class="text-start">
            <x-primary-button class="childbtn" style="margin-left: 120px;">
                {{ 'Connexion' }}
            </x-primary-button>

        </div>

            </div>
        </form>
    </body>

    </html>
</x-guest-layout>
