@include('site.common_templates.success_and_eerors')
<header>
	<nav class="tw-flex tw-justify-between tw-p-6 tw-bg-white">
		<ul class="tw-flex tw-items-center">
			<li>
				<a href="{{ route('home') }}" class="tw-p-3">Home</a>
			</li>
			<li>
				<a href="#" class="tw-p-3">Dashboard</a>
			</li>
			<li>
				<a href="#" class="tw-p-3">Article</a>
			</li>
		</ul>
		<ul class="tw-flex tw-items-center">
			@auth
				<li>
					<a href="#" class="tw-p-3">{{ auth()->user()->firstname }}</a>
				</li>
				<li>
					<form action="{{ route('signout') }}" method="post" class="tw-inline tw-p-3">
						@csrf
						<button type="submit">Sign out</button>
					</form>
				</li>
			@endauth
			@guest
				<li>
					<a href="{{ route('signin') }}" class="tw-p-3">Sign in</a>
				</li>
				<li>
					<a href="{{ route('signup') }}" class="tw-p-3">Sign up</a>
				</li>
			@endguest
		</ul>
	</nav>
</header>