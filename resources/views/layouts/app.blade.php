<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Avatar Life Token') }}</title>
    <!-- Styles -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Avatar Life" />
    <meta name="description" content=""/>
    <meta name="keywords"  content="" />
    <meta name="Resource-type" content="Document"/>

    <link href="{{ asset('/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/counter.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/jquery-ui.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/owl.carousel.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/custom.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/aos.css') }}" type="text/css" rel="stylesheet"/>
    <!--[if IE]>
            <script type="text/javascript">
                     var console = { log: function() {} };
            </script>
    <![endif]-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/lodash.min.js') }}"></script>
    <script src="{{ asset('/js/countdown.min.js') }}"></script>
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/canvasjs.min.js') }}"></script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/js/Chart.min.js') }}"></script>
    <script src="{{ asset('/js/aos.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
</head>
<body class="page">
    @php
    $class='';
    @endphp
    <div id="app">
        <div id="page-content">
             <section id="header" class="no-padd">
                <header class="main-head">
                    <div class="navbar-top">
                        <div class="container">
                            <p class="top-email"><i class="fa fa-envelope-o"></i> <a href="mailto:info@avatarlife.com" title="Email">info@avatarlife.com</a>
                                <span class="social-media-top">
                                    <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                    <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                                </span>
                            </p>
                        </div>
                    </div>
                    <nav id="menu-bar" class="navbar navbar-default navbar-static-top {{$class}}">
                        <div class="container">
                            <div class="navbar-header">
                                <!-- Collapsed Hamburger -->
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!-- Branding Image -->
                                <a class="navbar-brand" href="/">
                                    <img src="{{ asset('/images/Avatar_logo.png') }}">
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="nav navbar-nav">
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="nav navbar-nav navbar-right">
                                <?php
$array = array('login', 'register');
if (!in_array(Route::currentRouteName(), $array)) {
	?>
                                    <li class="menu-links"><a class="" href="#about">About AVR</a></li>
                                    <li class="menu-links"><a class="" href="#tokens">Tokens</a></li>
                                    <li class="menu-links"><a class="" href="#roadmap">Roadmap</a></li>
                                    <li class="menu-links"><a class="" href="#team-advisor">Team</a></li>
                                    <li class="menu-links"><a class="" href="#faq">FAQ</a></li>
                                    <li class="menu-links"><a class="" href="#contact">Contact</a></li>
                                    <li class="menu-links"><a class="color-blue" href="#global">White Paper</a></li>
                                    <li class="menu-links"><a class="color-blue" href="#">Summary</a></li>
<?php
}
?>
                                    <?php if (Auth::user()) {
	if (Auth::user()->user_type == 2) {?>
                                    <li class="menu-links menu-btn"><a class="color-blue" href="{{ url('adminDashboard') }}">
                                    <button type="button" class="btn btn-default navbar-btn">Admin Dashboard</button></a></li>
                                    <?php } else {?>
<li class="menu-links menu-btn"><a class="color-blue" href="{{ url('userDashboard') }}">
                                    <button type="button" class="btn btn-default navbar-btn">User Dashboard</button></a></li>
                                    <?php }} else {?>
                                    <li class="menu-links menu-btn"><a class="color-blue" href="{{ url('register') }}">
                                    <button type="button" class="btn btn-default navbar-btn">Sign Up</button>
                                    </a></li>
                                    <li class="menu-links menu-btn"><a class="color-blue" href="{{ url('login') }}">
                                    <button type="button" class="btn btn-default navbar-btn">Login</button>
                                    </a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </section>

            @yield('content')

           <section id="footer" class="no-padd">
                <footer class="site-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 copyright">
                                &copy; <script type="text/javascript">var dteNow = new Date(); var intYear = dteNow.getFullYear(); document.write(intYear);</script> AVATAR LIFE All rights reserved
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <ul class="footer-menu">
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                            <div id="telegram-icon">
                                <img src="{{ url('/images/telegram_icon.png') }}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </footer>
           </section>
        </div>
    </div>
    <!-- Scripts -->
    <script type="text/template" id="counter-template">
    <div class="time <%= label %>">
        <span class="count curr top"><%= curr %></span>
        <span class="count next top"><%= next %></span>
        <span class="count next bottom"><%= next %></span>
        <span class="count curr bottom"><%= curr %></span>
        <span class="label"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
    </div>
</script>
</body>
</html>
