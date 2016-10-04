<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SocialPrayer | @yield('title', 'Pray Online')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <link rel="apple-touch-icon" href="/images/apple-touch-icon-iphone-retina.png">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
	'csrfToken' => csrf_token(),
]); ?>
    </script>
</head>
<body>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84987127-1', 'auto');
      ga('send', 'pageview');

    </script>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container col-lg-8 col-lg-offset-2">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <div class="navbar-brand">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('images/social-prayer-logo.png') }}" style="height: 25px;" />
                    </a>
                </div>
                    <a href="{{ url('/home') }}" class="navbar-brand">
                        {{ config('app.name', 'Laravel') }}
                    </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
<!--                 <ul class="nav navbar-nav">
                    &nbsp;
                </ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/invite-friends') }}" data-remote="false" data-toggle="modal" data-target="#myModal">Invite Friends</a></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            @yield('content')
            </div>
        </div>
        <div style="position: fixed; bottom: 0; right: 10px;">
            <a href="{{ url('/privacy-policy') }}" class="text-muted" style="font-size: 10px;">Privacy Policy</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ url('/terms-and-conditions') }}" class="text-muted" style="font-size: 10px;">Terms and Conditions</a>
        </div>
    </div>

    <!-- Default bootstrap modal example -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

      </div>
    </div>


    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script>
    $(function(){
        $("#myModal").on("show.bs.modal", function(e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-content").load(link.attr("href"));
        });
    });
    </script>
    <!-- <script src="/js/sidebar.js"></script> -->

    @yield('footer')

</body>
</html>
