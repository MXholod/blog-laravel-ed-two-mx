@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<div class="tw-w-4/12 tw-mx-auto tw-px-4">
		<p class="tw-text-lg tw-pl-3 tw-pb-3 tw-font-bold">Sign in</p>
		<form method="post" action="{{ route('signin') }}">
			@csrf
			<div class="tw-mb-4">
				<label for="email" class="tw-sr-only">Email</label>
				<input type="text" name="email" id="email" placeholder="Your email" class="tw-bg-gray-100 tw-border-2 tw-w-full tw-p-2 tw-rounded-lg @error('email') tw-border-red-500 @enderror" value="{{ old('email') }}" />
				@error('email')
					<div class="tw-text-red-500 tw-my-2 tw-text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="tw-mb-4">
				<label for="password" class="tw-sr-only">Password</label>
				<input type="password" name="password" id="password" placeholder="Choose a password" class="tw-bg-gray-100 tw-border-2 tw-w-full tw-p-2 tw-rounded-lg @error('password') tw-border-red-500 @enderror" value="{{ old('password') }}" />
				@error('password')
					<div class="tw-text-red-500 tw-my-2 tw-text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="tw-mb-4">
				<div class="tw-flex tw-items-center">
					<label for="remember">Remember me</label>
					<input type="checkbox" name="remember" id="remember" class="tw-ml-2" />
				</div>
			</div>
			<div>
				<button type="submit" class="tw-bg-blue-500 tw-text-white tw-px-2 tw-py-3 tw-rounded tw-font-medium tw-w-full">
					Sign in
				</button>
			</div>
		</form>
	</div>
</div>
@endsection