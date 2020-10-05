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
						<div class="container">
							<ul class="header-links pull-right">
								@if (Auth::guest())
									<li><a href="{{ url('register') }}"><i class="fa fa-address-book"></i> Registro</a></li>
									<li><a href="{{ url('login') }}"><i class="fa fa-user-o"></i> Entrar</a></li>
								@else
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
							<!-- Wishlist -->
                                <div style="margin-left: 50%;">
                                    <a href="{{ url('index') }}">
                                        <i style="color: white;" class="fa fa-home"></i>
                                            <span style="color: white;">Página Principal</span>
                                    </a>
                                </div>
                            <!-- /Wishlist -->
						</div>
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- ADMIN -->
		<div id="admin" height=100%>
			<div class="admin-container">
				<h3 class="admin-title-menu">Menú Administrativo</h3>
				<ul>
				    <li class="boton-admin-principal"><a  class="admin-a" href="{{ url('admin') }}"><i class="fa fa-user-o"></i> Usuarios</a></li>
				    <li class="boton-admin"><a class="admin-a" href="{{ url('category') }}"><i class="fa fa-check"></i> Categorías</a></li>
				    <li class="boton-admin"><a class="admin-a" href="{{ url('product') }}"><i class="fa fa-puzzle-piece"></i> Productos</a></li>
				    <li class="boton-admin"><a  class="admin-a" href="{{ url('payment') }}"><i class="fa fa-dollar"></i> Pagos</a></li>
				    <li class="boton-admin"><a  class="admin-a" href="{{ url('order') }}"><i class="fa fa-envelope"></i> Pedidos</a></li>
				</ul>	
			</div>
		</div>
		<!-- /ADMIN -->

		<!-- CONTENT -->
		<div id="content">
			<!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="newsletter">
                            <h2 class="aside-title">Registro de Usuario</h2>
                            <br>
                            <form class="form-horizontal" method="POST">
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

                                <label class="col-md-12 control-label" style="text-align: center;">Rol del usuario</label>
                                <br>
                                <br>
                                <select type="text" id="rol" name="rol">
  									<option value="Cliente" selected>Cliente</option>
  									<option value="Admin">Admin</option>
								</select>
								<br>
								<br>
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
                                            Registrar
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
		<!-- /CONTENT -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
