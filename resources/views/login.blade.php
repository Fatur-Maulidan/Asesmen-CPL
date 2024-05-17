<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <style>
        /* Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif !important;
        }

        .no-bullet {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column align-items-center justify-content-center"
        style="height: 100vh;background-color:#FEFEFE">
        <div class="d-flex flex-column align-items-center border-end-2 border-bottom-2 px-5 py-5 shadow-sm"
            style="background-color:#FFFFFF;">
            <div class="fw-bold fs-3 mb-4">Masuk</div>
            <form action="" method="POST">
                @csrf
                <div class="d-flex flex-column align-items-evenly">
                    <div class="">
                        <div class="mb-4">
                            <input type="email" placeholder="NIP" class="rounded py-2 px-2 border border-dark"
                                id="email" name="email" required>
                        </div>
                        <div class="mb-2 position-relative">
                            <input type="password" placeholder="Kata Sandi" class="rounded py-2 px-2 border border-dark"
                                id="password" required>
                            <i class="bi bi-eye-slash position-absolute" style="top:20%;right:5%;"
                                id="togglePassword"></i>
                        </div>
                        <div class="mb-5">
                            <a href=""
                                class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                style="font-size:12px;">
                                Lupa Kata Sandi?
                            </a>
                        </div>
                    </div>
                    <div class="d-flex flex-column position-relative">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                        <i class="bi bi-arrow-right position-absolute" style="color: #FEFEFE;top:19%;left:63%"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- jquery --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{-- Bootstrap Js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            if (password.getAttribute('type') === 'password') {
                password.setAttribute('type', 'text');
                togglePassword.classList.add('bi-eye');
                togglePassword.classList.remove('bi-eye-slash');
            } else {
                password.setAttribute('type', 'password');
                togglePassword.classList.add('bi-eye-slash');
                togglePassword.classList.remove('bi-eye');
            }
        });
    </script>
</body>

</html>
