<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
        <title>ABCMedia - MarketPlace</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- HEADER -->
        <header>
            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
                        <li><a href="tel:+585816211"><i class="fa fa-phone"></i> +058-581-6211</a></li>
                        <li><a href="mailto:abcmedia.webmaster@gmail.com"><i class="fa fa-envelope-o"></i> abcmedia.webmaster@gmail.com</a></li>
                        <li><a href="https://www.google.com/maps/place/Multicentro+Empresarial+del+Este/@10.4914518,-66.8560786,17z/data=!3m1!4b1!4m5!3m4!1s0x8c2a5855169a053d:0xbfa33c5cc82925f0!8m2!3d10.4914465!4d-66.8538899" target="_blank"><i class="fa fa-map-marker"></i> Venezuela, Caracas</a></li>
                    </ul>
                    <ul class="header-links pull-right">
                        @if (Auth::guest())
                            <li><a href="{{ url('register') }}"><i class="fa fa-address-book"></i> Registro</a></li>
                            <li><a href="{{ url('login') }}"><i class="fa fa-user-o"></i> Entrar</a></li>
                        @else
                            <li><a href="{{url('perfil',Crypt::encrypt( Auth::user()->id ))}}"><i class="fa fa-user-o"></i> Editar Perfil</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-sign-out"></i>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" style="color: #D10024; margin-left: 40%;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="{{ url('/') }}" class="logo">
                                    <img src="./img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- /LOGO -->

                        <!-- SEARCH BAR -->
                        <div class="col-md-6">
                            <div class="header-search">
                                
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->

                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                @if (Auth::guest())
                                @else
                                    @if (Auth::user()->rol == 'Cliente')
                                    <!-- Wishlist -->
                                    <div>
                                        <a href="{{ url('venta') }}">
                                            <i class="fa fa-dollar"></i>
                                            <span>Crear Venta</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{url('publicaciones',Crypt::encrypt( Auth::user()->id ))}}">
                                            <i class="fa fa-puzzle-piece"></i>
                                            <span>Mis ventas</span>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->
                                    @endif

                                    @if (Auth::user()->rol == 'Admin')
                                    <!-- Wishlist -->
                                    <div>
                                        <a href="{{ url('admin') }}">
                                            <i class="fa fa-cogs"></i>
                                            <span>Administrar sitio</span>
                                        </a>
                                    </div>
                                    <!-- /Wishlist -->
                                    @endif
                                @endif
                            </div>
                        </div>
                        <!-- /ACCOUNT -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- /MAIN HEADER -->
        </header>
        <!-- /HEADER -->

        <!-- NAVIGATION -->
        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav">
                        <li class="active"><a href="{{ url('/index') }}">Tienda</a></li>
                        <li><a href="{{ url('/mision') }}">Misión y Visión</a></li>
                        <li><a href="{{ url('/nosotros') }}">Sobre Nosotros</a></li>
                        <li><a href="{{ url('/contactanos') }}">Contáctanos</a></li>
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
        <!-- /NAVIGATION -->

        <!-- SECTION -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <h2 class="aside-title">Error 404. Página no encontrada.</h2>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->

        <!-- FOOTER -->
        <footer id="footer">
            <!-- top footer -->
            <div class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Sobre Nosotros</h3>
                                <p>Somos un marketplace. Vendemos productos para tu carro, compra Ya!</p>
                                <ul class="footer-links">
                                    <li><a href="https://www.google.com/maps/place/Multicentro+Empresarial+del+Este/@10.4914518,-66.8560786,17z/data=!3m1!4b1!4m5!3m4!1s0x8c2a5855169a053d:0xbfa33c5cc82925f0!8m2!3d10.4914465!4d-66.8538899" target="_blank"><i class="fa fa-map-marker"></i> Venezuela, Caracas</a></li>
                                    <li><a href="tel:+585816211"><i class="fa fa-phone"></i> +058-581-6211</a></li>
                                    <li><a href="mailto:abcmedia.webmaster@gmail.com"><i class="fa fa-envelope-o"></i> abcmedia.webmaster</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="clearfix visible-xs"></div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Información</h3>
                                <ul class="footer-links">
                                    <li><a href="{{ url('/contactanos') }}"><i class="fa fa-envelope-o"></i> Contáctanos</a></li>
                                    <li><a href="{{ url('/privacidad') }}"><i class="fa fa-user-secret"></i> Políticas de Privacidad</a></li>
                                    <li><a href="{{ url('/terminos') }}"><i class="fa fa-check"></i> Términos y Condiciones</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top footer -->

            <!-- bottom footer -->
            <div id="bottom-footer" class="section">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <ul class="footer-payments">
                                <li><a><i class="fa fa-cc-visa"></i></a></li>
                                <li><a><i class="fa fa-credit-card"></i></a></li>
                                <li><a><i class="fa fa-cc-paypal"></i></a></li>
                                <li><a><i class="fa fa-cc-mastercard"></i></a></li>
                            </ul>
                            <span class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </span>
                        </div>
                    </div>
                        <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bottom footer -->
        </footer>
        <!-- /FOOTER -->

        <!-- jQuery Plugins -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/nouislider.min.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
