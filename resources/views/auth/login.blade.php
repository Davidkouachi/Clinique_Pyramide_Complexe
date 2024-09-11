<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- End Google Tag Manager -->
    <title>Se connecter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets_login/css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets_login/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets_login/fonts/flaticon/font/flaticon.css')}}">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('assets_login/img/favicon.ico')}}" type="image/x-icon">
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets_login/css/style.css')}}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{asset('assets_login/css/skins/default.css')}}">
</head>

<body id="top" style="background-color: #116aef;">
    <div class="page_loader"></div>
    <!-- Login 18 start -->
    <div class="login-18">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-section">
                        {{-- <div class="logo-2">
                            <a href="login-18.html">
                                <img src="{{asset('assets_login/img/logos/logo.png')}}" alt="logo">
                            </a>
                        </div> --}}
                        <div class="typing">
                            <h3>Connexion</h3>
                        </div>
                        <form action="{{route('trait_auth')}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="second_field" class="form-label float-start">
                                    Identifiant
                                </label>
                                <input  name="email" type="email" class="form-control" autocomplete="off" id="second_field" placeholder="Entrer votre identifiant" aria-label="Entrer votre identifiant">
                            </div>
                            <div class="form-group clearfix">
                                <label for="third_field" class="form-label float-start">Password</label>
                                <input  name="password" type="password" class="form-control" autocomplete="off" id="third_field" placeholder="Entrer votre mot de passe" aria-label="Entrer votre mot de passe">
                            </div>
                            <div class="checkbox form-group clearfix">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                <a href="{{route('mdp_oublie_email')}}" class="float-end">
                                    Mot de passe oublié
                                </a>
                            </div>
                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary btn-lg btn-theme">
                                    Connexion
                                </button>
                            </div>
                        </form>
                        {{-- <div class="social-list">
                            <span>Or Login With</span>
                            <a href="#" class="facebook-bg">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="twitter-bg">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="google-bg">
                                <i class="fa fa-google"></i>
                            </a>
                            <a href="#" class="linkedin-bg">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <p>Don't have an account?<a href="register-18.html"> Register here</a></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 18 end -->
    <!-- External JS libraries -->
    <script src="{{asset('assets_login/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets_login/js/popper.min.js')}}"></script>
    <script src="{{asset('assets_login/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Custom JS Script -->
</body>

</html>
