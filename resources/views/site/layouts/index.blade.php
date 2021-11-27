<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-sans">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Document</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
	</head>
	<body class="bg-gray-200">
		<div class="grid gap-2 main-grid">
			<div class="header">
				<!-- Header -->
				@include('site.common_templates.header')
			</div>
			<div class="sidebar">
				<!-- Sidebar -->
				@include('site.common_templates.sidebar')
			</div>
			<div class="content">
				<!-- Main content -->
				@yield('content')
			</div>
			<div class="footer">
				<!-- Footer -->
				@include('site.common_templates.footer')
			</div>
		</div>
	</body>
</html>