@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<div class="tw-w-4/12 tw-mx-auto tw-px-4">
		<p class="tw-text-lg tw-pl-3 tw-pb-3 tw-font-bold">Sign up</p>
		<form method="post" action="{{ route('signup') }}">
			@csrf
			<div class="tw-mb-4">
				<label for="firstname" class="tw-sr-only">User first name</label>
				<input type="text" name="firstname" id="firstname" placeholder="Your first name" class="tw-bg-gray-100 tw-border-2 tw-w-full tw-p-2 tw-rounded-lg @error('firstname') tw-border-red-500 @enderror" value="{{ old('firstname') }}" />
				@error('firstname')
					<div class="tw-text-red-500 tw-my-2 tw-text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="tw-mb-4">
				<label for="lastname" class="tw-sr-only">User last name</label>
				<input type="text" name="lastname" id="lastname" placeholder="Your last name" class="tw-bg-gray-100 tw-border-2 tw-w-full tw-p-2 tw-rounded-lg @error('lastname') tw-border-red-500 @enderror" value="{{ old('lastname') }}" />
				@error('lastname')
					<div class="tw-text-red-500 tw-my-2 tw-text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
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
				<label for="password_confirmation" class="tw-sr-only">Repeat your password</label>
				<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation" class="tw-bg-gray-100 tw-border-2 tw-w-full tw-p-2 tw-rounded-lg" value="" />
			</div>
			<div>
				<button type="submit" class="tw-bg-blue-500 tw-text-white tw-px-2 tw-py-3 tw-rounded tw-font-medium tw-w-full">
					Sign up
				</button>
			</div>
		</form>
	</div>
</div>
@endsection