@include('site.common_templates.success_and_eerors')
<header>
	<nav class="flex justify-between p-6 bg-white">
		<ul class="flex items-center">
			<li>
				<a href="{{ route('home') }}" class="p-3">Home</a>
			</li>
			<li>
				<a href="#" class="p-3">Dashboard</a>
			</li>
			<li>
				<a href="#" class="p-3">Article</a>
			</li>
		</ul>
		<ul class="flex items-center">
			@auth
				<li>
					<a href="#" class="p-3">{{ auth()->user()->firstname }}</a>
				</li>
				<li>
					<form action="{{ route('signout') }}" method="post" class="inline p-3">
						@csrf
						<button type="submit">Sign out</button>
					</form>
				</li>
			@endauth
			@guest
				<li>
					<a href="{{ route('signin') }}" class="p-3">Sign in</a>
				</li>
				<li>
					<a href="{{ route('signup') }}" class="p-3">Sign up</a>
				</li>
			@endguest
		</ul>
	</nav>
</header>