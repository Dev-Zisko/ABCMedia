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
								<form method="POST">
									{{ csrf_field() }}
									<select type="text" id="categoria" name="categoria" class="input-select">
										<option value="Categorías">Categorías</option>
										@foreach($categories as $category)
										<option value="{{$category->nombre}}">{{$category->nombre}}</option>
										@endforeach
									</select>
									<input id="texto" name="texto" type="text" class="input" placeholder="Escribe aquí">
									<button type="submit" class="search-btn">Buscar</button>
								</form>
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
						<li><a href="{{ url('/index') }}">Tienda</a></li>
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
							<h2 class="aside-title">Políticas de Privacidad</h2>
							<br>
							<p style="font-size: large;">Nosotros somos ABCMedia. Nuestra página web es: <a href="https://abcmedia.com" target="_blank">https://abcmedia.com</a>.</p>
							<br>
							<h3>¿Qué datos personales recogemos y por qué los recogemos?</h3>
							<br>
							<h4 style="text-align: left;">Comentarios</h4>
							<p style="font-size: large; text-align: justify;">Cuando los usuarios dejan comentarios en la web, recopilamos los datos que se muestran en el formulario de comentarios, así como la dirección IP del visitante y la cadena de agentes de usuario del navegador para ayudar a la detección de spam.</p>
							<br>
							<h4 style="text-align: left;">Medios</h4>
							<p style="font-size: large; text-align: justify;">Si subes imágenes a la web deberías evitar subir imágenes con datos de ubicación (GPS EXIF) incluidos. Los visitantes de la web pueden descargar y extraer cualquier dato de localización de las imágenes de la web.</p>
							<br>
							<h3>Formularios de Contacto</h3>
							<br>
							<h4 style="text-align: left;">Cookies</h4>
							<p style="font-size: large; text-align: justify;">Si tienes una cuenta y te conectas a este sitio, instalaremos una cookie temporal para determinar si tu navegador acepta cookies. Esta cookie no contiene datos personales y se elimina al cerrar el navegador.</p>
							<p style="font-size: large; text-align: justify;">Cuando inicias sesión, también instalaremos varias cookies para guardar tu información de inicio de sesión y tus opciones de visualización de pantalla. Las cookies de inicio de sesión duran dos días, y las cookies de opciones de pantalla duran un año. Si seleccionas “Recordarme”, tu inicio de sesión perdurará durante dos semanas. Si sales de tu cuenta, las cookies de inicio de sesión se eliminarán.</p>
							<p style="font-size: large; text-align: justify;">Si editas o publicas un artículo se guardará una cookie adicional en tu navegador. Esta cookie no incluye datos personales y simplemente indica el ID del artículo que acabas de editar. Caduca después de 1 día.</p>
							<br>
							<h4 style="text-align: left;">Contenido incrustado de otros sitios web</h4>
							<p style="font-size: large; text-align: justify;">Los artículos de este sitio pueden incluir contenido incrustado (por ejemplo, vídeos, imágenes, artículos, etc.). El contenido incrustado de otras web se comporta exactamente de la misma manera que si el visitante hubiera visitado la otra web.</p>
							<p style="font-size: large; text-align: justify;">Estas web pueden recopilar datos sobre ti, utilizar cookies, incrustar un seguimiento adicional de terceros, y supervisar tu interacción con ese contenido incrustado, incluido el seguimiento de tu interacción con el contenido incrustado si tienes una cuenta y estás conectado a esa web.</p>
							<br>
							<h4 style="text-align: left;">Analítica</h4>
							<p style="font-size: large; text-align: justify;">Nosotros usamos Google Analytics para coleccionar datos sobre la experiencia del usuario y nuestro sitio web, estos datos son confidenciales y nosotros usamos esos datos para mejorar nuestro sitio web. Tu puedes ver más sobre las políticas de privacidad de Google Analytics <a href="https://policies.google.com/privacy" target="_blank">aquí.</a></p>
							<br>
							<h3>¿Con quién compartimos tus datos?</h3>
							<br>
							<h4 style="text-align: left;">¿Cuánto tiempo conservamos tus datos?</h4>
							<p style="font-size: large; text-align: justify;">De los usuarios que se registran en nuestra web, también almacenamos la información personal que proporcionan en su perfil de usuario. Todos los usuarios pueden ver, editar o eliminar su información personal en cualquier momento (excepto que no pueden cambiar su nombre de usuario). Los administradores de la web también pueden ver y editar esa información.</p>
							<br>
							<h4 style="text-align: left;">¿Qué derechos tienes sobre tus datos?</h4>
							<p style="font-size: large; text-align: justify;">Si tienes una cuenta o has dejado comentarios en esta web, puedes solicitar recibir un archivo de exportación de los datos personales que tenemos sobre ti, incluyendo cualquier dato que nos hayas proporcionado. También puedes solicitar que eliminemos cualquier dato personal que tengamos sobre ti. Esto no incluye ningún dato que estemos obligados a conservar con fines administrativos, legales o de seguridad.</p>
							<br>
							<h3>Información de Contacto</h3>
							<br>
							<p style="font-size: large; text-align: justify;">Puedes dejarnos un mensaje en nuestro correo <a href="mailto:abcmedia.webmaster@gmail.com">abcmedia.webmaster@gmail.com</a> para obtener más información sobre nuestras políticas de privacidad o envíanos algun comentario.</p>
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
