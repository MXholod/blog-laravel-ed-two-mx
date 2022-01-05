<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="tw-font-sans">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Document</title>
		<link href="{{ mix('css/app.css') }}" rel="stylesheet" />
	</head>
	<body class="tw-bg-gray-200">
		<div class="tw-grid tw-gap-2 main-grid" id="app">
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
		<script src="{{ mix('js/app.js') }}"></script>
	</body>
</html>