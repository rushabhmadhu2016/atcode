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

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/style.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/css/counter.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/jquery-ui.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/owl.carousel.min.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('/css/custom.css') }}" type="text/css" rel="stylesheet"/>
    <!--[if IE]>
            <script type="text/javascript">
                     var console = { log: function() {} };
            </script>
    <![endif]-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('/js/lodash.min.js') }}"></script>
    <script src="{{ asset('/js/countdown.min.js') }}"></script>
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/js/canvasjs.min.js') }}"></script>
    <script src="{{ asset('/js/moment.js') }}"></script>
    <script src="{{ asset('/js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<?php
$route = \Route::currentRouteName();
?>
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
if (Auth::user()) {
	?>        <li class="menu-links menu-btn"><a class="color-blue" href="{{ url('logout') }}"><button type="button" class="btn btn-default navbar-btn">Logout</button></a></li>
                                                                <?php
}
?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </section>
            <div class="container {{ $route }}-page body-container">
                <div class="row">
                    <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                      <li role="presentation" <?php echo ($route == 'userDashboard') ? 'class=active' : ''; ?> ><a href="{{ url('userDashboard') }}">Dashboard</a></li>
                      <li role="presentation" <?php echo ($route == 'buy-token') ? 'class=active' : ''; ?> ><a href="{{ url('buy-token') }}">Buy Tokens</a></li>
                      <li role="presentation" <?php echo ($route == 'user-transactions') ? 'class=active' : ''; ?> ><a href="{{ url('user-transactions') }}">My Transactions</a></li>
                      <li role="presentation" <?php echo ($route == 'user-wallet') ? 'class=active' : ''; ?> ><a href="{{ url('user-wallet') }}">My Wallet</a></li>
                      <li role="presentation" <?php echo ($route == 'user-profile') ? 'class=active' : ''; ?> ><a href="{{ url('user-profile') }}">My Profile</a></li>
                      <li role="presentation" <?php echo ($route == 'my-referrals') ? 'class=active' : ''; ?> ><a href="{{ url('my-referrals') }}">My Referral</a></li>
                      <li role="presentation" <?php echo ($route == 'changePassword') ? 'class=active' : ''; ?> ><a href="{{ url('changePassword') }}">Change Password</a></li>
                      <li role="presentation" <?php echo ($route == 'logout') ? 'class=active' : ''; ?> ><a href="{{ url('logout') }}">Logout</a></li>
                    </ul>
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
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
