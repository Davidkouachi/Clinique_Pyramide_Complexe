<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from buybootstrap.com/demos/medflex/medflex-admin-dashboard/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Sep 2024 12:22:12 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Gallery - Medical Admin Templates & Dashboards</title>
    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}">
    <!-- *************
            ************ CSS Files *************
        ************* -->
    <link rel="stylesheet" href="{{asset('assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body class="login-bg" style="font-family: sans-serif; font-weight: bold;">
    <!-- Container starts -->
    <div class="container ">
        <!-- Auth wrapper starts -->
        <div class="auth-wrapper" style="margin-top: -100px; ">
            <!-- Form starts -->
            <form id="formulaire" action="{{route('trait_login')}}" method="post" >
                @csrf
                <div class="auth-box" style="max-width: 600px;">
                    <h2 class="mb-4">Bienvenue</h2>
                    <h6 class="mb-4" style="color: red;">Centre medico-social la pyramide du complexe</h6>
                    <h4 class="mb-4">Se connecter</h4>
                    <div class="mb-3">
                        <label class="form-label" for="email">login</label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Entrer votre Login">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="pwd">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" name="password" id="pwd" class="form-control" placeholder="Entrer votre mot de passe">
                            {{-- <button class="btn btn-outline-secondary" type="button">
                                <i class="ri-eye-line text-primary"></i>
                            </button> --}}
                        </div>
                    </div>
                    <p id="alert" class="text-danger" style="width: 300px;" ></p>
                    <!-- <div class="d-flex justify-content-end mb-3">
              <a href="forgot-password.html" class="text-decoration-underline">Forgot password?</a>
            </div> -->
                    <div class="mb-3 d-grid gap-2">
                        <button type="submit" class="btn btn-success">Connexion</button>
                        <!-- <a href="signup.html" class="btn btn-secondary">Not registered? Signup</a> -->
                    </div>
                </div>
            </form>
            <!-- Form ends -->
        </div>
        <!-- Auth wrapper ends -->
    </div>
    <!-- Container ends -->

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    @if (session('error'))
        <div class="modal fade" id="error" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <h1 class="display-4">
                            <i class="ri-close-circle-line text-danger"></i>
                        </h1>
                        <h4 class="text-danger">Erreur</h4>
                        <p>{{session('error')}}</p>
                        <a data-bs-dismiss="modal" class="btn btn-lg btn-danger w-25">
                            ok
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('error'));
                myModal.show();
            });
        </script>
        @php session()->forget('error'); @endphp
    @endif

    <script>
        document.getElementById("formulaire").addEventListener("submit", function(event) {
            event.preventDefault();

            var login = document.getElementById("login");
            var password = document.getElementById("pwd");

            const alert = document.getElementById("alert");

            if (!login.value.trim() || !password.value.trim()) {
                alert.innerHTML = 'Veuillez remplir tous les champs';
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneRegex = /^[0-9]{10}$/;
            if (!emailRegex.test(login.value) && !phoneRegex.test(login.value)) {
                alert.innerHTML = 'Veuillez saisir une adresse e-mail ou un numéro de téléphone valide.';
                return false;
            }

            var preloader_ch = `
                <div id="preloader_ch">
                    <div class="spinner_preloader_ch"></div>
                </div>
            `;
            // Add the preloader to the body
            document.body.insertAdjacentHTML('beforeend', preloader_ch);


            // Rafraîchir le token CSRF avant de soumettre le formulaire
            $.get('/refresh_csrf').done(function(data) {
                // Mettre à jour le token CSRF dans le champ du formulaire
                document.querySelector('input[name="_token"]').value = data.token;
                // Soumettre le formulaire
                this.submit();
            }.bind(this)); // Utiliser bind pour référencer le contexte correct

            // function verifierMotDePasse(motDePasse) {

            //     if (motDePasse.length < 8) {
            //         return false;
            //     }

            //     if (!/[A-Z]/.test(motDePasse)) {
            //         return false;
            //     }

            //     if (!/[a-z]/.test(motDePasse)) {
            //         return false;
            //     }

            //     if (!/\d/.test(motDePasse)) {
            //         return false;
            //     }

            //     return true;
            // }

        });

    </script>   

</body>
<!-- Mirrored from buybootstrap.com/demos/medflex/medflex-admin-dashboard/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Sep 2024 12:22:12 GMT -->

</html>
