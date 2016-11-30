<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{{ config('app.name') }}</title>
		<link href="/css/app.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet">
		@yield('scripts.header')
	</head>
	<body>

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><strong>{{ config('app.name') }}</strong></a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="/">New scrape</a>
					</li>
					<li>
						<a href="/history">History</a>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	<div class="content container">
		@yield('content')
	</div>

	<script src="/js/app.js"></script>
	<script src="/js/libs.js"></script>

	@yield('scripts.footer')
	</body>
</html>