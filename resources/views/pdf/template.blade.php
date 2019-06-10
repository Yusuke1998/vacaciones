<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> @yield('title') </title>
	</head>
	<style>
		html {
			margin: 50px;
			padding: 0;
		}

		footer , header {
			text-align: center;
		}

		#date {
			text-align: right;
		}

		#title {
			text-transform: uppercase;
			text-align: center;
		}

	</style>
	@yield('styles')
	<body>
		<header>
			<div id="date">
				{{ date('d-m-Y') }}
			</div>
			<div id="title">
				@yield('title') 
			</div>
		</header><!-- /header -->
		@yield('content')
		<footer>
			<b>Sistema de vacaciones</b>
		</footer>
	</body>
</html>