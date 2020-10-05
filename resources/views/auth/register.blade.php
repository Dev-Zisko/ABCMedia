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
                        <li><a href="{{ url('index') }}"><i class="fa fa-arrow-left"></i> Regresar</a></li>
                        <li><a href="{{ url('login') }}"><i class="fa fa-user-o"></i> Entrar</a></li>
                    </ul>
                </div>
            </div>
            <!-- /TOP HEADER -->
            <!-- MAIN HEADER -->
            <div id="header">
                <!-- container -->
                <div class="container" style="margin-left: 43.5%">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                            <div class="header-logo">
                                <a href="{{ url('/') }}" class="logo">
                                    <img src="./img/logo.png" alt="">
                                </a>
                        </div>
                        <!-- /LOGO -->
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
        </nav>
        <!-- /NAVIGATION -->

        <!-- SECTION -->
        <div class="section" style="background-image: url('./img/pattern.png');">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <h2 class="aside-title">Registro de Usuario</h2>
                            <br>
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label for="nombre" class="col-md-12 control-label" style="text-align: center;">Nombre</label>

                                    <div class="col-md-12">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                    <label for="apellido" class="col-md-12 control-label" style="text-align: center;">Apellido</label>

                                    <div class="col-md-12">
                                        <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>

                                        @if ($errors->has('apellido'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apellido') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                    <label for="cedula" class="col-md-12 control-label" style="text-align: center;">Cédula</label>

                                    <div class="col-md-12">
                                        <input id="cedula" type="number" class="form-control" name="cedula" value="{{ old('cedula') }}" required>

                                        @if ($errors->has('cedula'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cedula') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-12 control-label" style="text-align: center;">Correo</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                    <label for="telefono" class="col-md-12 control-label" style="text-align: center;">Teléfono</label>

                                    <div class="col-md-12">
                                        <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}" required>

                                        @if ($errors->has('telefono'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('paypal') ? ' has-error' : '' }}">
                                    <label for="paypal" class="col-md-12 control-label" style="text-align: center;">Correo de Paypal</label>

                                    <div class="col-md-12">
                                        <input id="paypal" type="email" class="form-control" name="paypal" value="{{ old('paypal') }}" required>

                                        @if ($errors->has('paypal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('paypal') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}" style="margin-top: -100px">
                                        <input id="rol" type="hidden" class="form-control" name="rol" value="Cliente" readonly="readonly">
                                        @if ($errors->has('rol'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rol') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label" style="text-align: center;">Contraseña</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-12 control-label" style="text-align: center;">Confirmar Contraseña</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn primary-btn"><i class="fa fa-save"></i>
                                            Registrarse
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                    <li><a href="abcmedia.webmaster@gmail.com"><i class="fa fa-envelope-o"></i> abcmedia.webmaster</a></li>
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

