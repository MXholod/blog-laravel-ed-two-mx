<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="tw-font-sans">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>@yield('title', env('APP_NAME','Admin main page'))</title>
		<link href="{{ mix('css/admin/app.css') }}" rel="stylesheet" />
	</head>
	<body class="tw-bg-gray-200">
		<div class="main-grid tw-grid" id="app">
			<div class="header">
				<!-- Header -->
				@include('admin.common_templates.header')
			</div>
			<div class="sidebar">
				<!-- Sidebar -->
				@include('admin.common_templates.sidebar')
			</div>
			<div class="content">
				<!-- Main content -->
				@yield('content')
			</div>
			<div class="footer">
				<!-- Footer -->
				@include('admin.common_templates.footer')
			</div>
		</div>
		<script src="{{ mix('js/admin/app.js') }}"></script>
		@stack('scripts-admin-bottom')
	</body>
</html>