<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
		<title>ABCMedia - MarketPlace</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="../css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="../css/style.css"/>

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
									<img src="../img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<!-- SEARCH BAR -->
						<div class="col-md-6" >
							<div class="header-search" >
								<form method="POST">
									{{ csrf_field() }}
									<select type="text" id="categoria" name="categoria" class="input-select">
										<option value="Campos">Campos</option>
										<option value="Nombre">Nombre</option>
										<option value="Categoría">Categoría</option>
										<option value="Precio">Precio</option>
										
									</select>
									<input id="texto" name="texto" type="text" class="input" placeholder="Escribe aquí para buscar">
									<button type="submit" class="search-btn">Buscar</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->
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
			<br>
			<h2 style="text-align: center;">Productos registrados en el sistema</h2>
			<br>
			<div class="admin-container">
				<a class="boton-admin-table" href="{{ url('rproduct') }}"><i class="fa fa-puzzle-piece"></i> Crear Producto</a>
			</div>
			<br>
			<div class="table-container" style="margin-left: 40px;">
				<table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Categoría</th>
							<th>Cantidad</th>
							<th>Precio ($)</th>
							<th>Precio (Bs)</th>
							<th>Dueño</th>
							<th>Cédula</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							@foreach ($users as $user)
								@if ($user->id == $product->id_user)
									<tr>
										<td>{{$product->nombre}}</td>
										<td>{{$product->categoria}}</td>
										<td>{{$product->cantidad}}</td>
										<td>{{$product->precio}}</td>
										<td>{{$product->preciobs}}</td>
										<td>{{$user->nombre}} {{$user->apellido}}</td>
										<td>{{$user->cedula}}</td>
										<td>
											<a class="boton-admin-table" href="{{url('uproduct',Crypt::encrypt($product->id))}}"><i class="fa fa-edit"></i></a>
											<a class="boton-admin-table" href="{{url('dproduct',Crypt::encrypt($product->id))}}"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								@endif
							@endforeach
						@endforeach
					</tbody>
				</table>
				<br>
				<div>{{$products->links()}}</div>
			</div>
		</div>
		<!-- /CONTENT -->

		<!-- jQuery Plugins -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/slick.min.js"></script>
		<script src="../js/nouislider.min.js"></script>
		<script src="../js/jquery.zoom.min.js"></script>
		<script src="../js/main.js"></script>

	</body>
</html>
