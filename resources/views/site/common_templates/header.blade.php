@include('site.common_templates.success_and_eerors')
<header>
	<nav class="tw-flex tw-justify-between tw-p-6 tw-bg-white">
		<ul class="tw-flex tw-items-center">
			<li>
				<a href="{{ route('home') }}" class="tw-p-3 {{ request()->is('/') ? 'tw-inline-block tw-border tw-border-blue-500 tw-rounded tw-py-1 tw-px-3 tw-bg-blue-500 tw-text-white' : '' }}">
					Home
				</a>
			</li>
			<li>
				<a href="{{ route('article.index') }}" class="tw-p-3 {{ (request()->is('articles') or request()->is('articles/*')) ? 'tw-inline-block tw-border tw-border-blue-500 tw-rounded tw-py-1 tw-px-3 tw-bg-blue-500 tw-text-white' : '' }}">
					Articles
				</a>
			</li>
			@if(auth()->user() && (auth()->user()->is_admin === 1))
			<li>
				<a href="{{ route('admin.index') }}" class="tw-p-3"> Admin dashboard</a>
			</li>
			@endif
		</ul>
		<ul class="tw-flex tw-items-center">
			@auth
				<li>
					<a href="{{ route('cabinet') }}" class="tw-p-3">{{ auth()->user()->firstname }}</a>
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