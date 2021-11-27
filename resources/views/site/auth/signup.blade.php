@extends('site.layouts.index')

@section('content')
<div class="container bg-white p-6 rounded-l-lg">
	<div class="w-4/12 mx-auto px-4">
		<p class="text-lg pl-3 pb-3 font-bold">Sign up</p>
		<form method="post" action="{{ route('signup') }}">
			@csrf
			<div class="mb-4">
				<label for="firstname" class="sr-only">User first name</label>
				<input type="text" name="firstname" id="firstname" placeholder="Your first name" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('firstname') border-red-500 @enderror" value="{{ old('firstname') }}" />
				@error('firstname')
					<div class="text-red-500 my-2 text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="lastname" class="sr-only">User last name</label>
				<input type="text" name="lastname" id="lastname" placeholder="Your last name" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('lastname') border-red-500 @enderror" value="{{ old('lastname') }}" />
				@error('lastname')
					<div class="text-red-500 my-2 text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="email" class="sr-only">Email</label>
				<input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}" />
				@error('email')
					<div class="text-red-500 my-2 text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="password" class="sr-only">Password</label>
				<input type="password" name="password" id="password" placeholder="Choose a password" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('password') border-red-500 @enderror" value="{{ old('password') }}" />
				@error('password')
					<div class="text-red-500 my-2 text-sm">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="mb-4">
				<label for="password_confirmation" class="sr-only">Repeat your password</label>
				<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation" class="bg-gray-100 border-2 w-full p-2 rounded-lg" value="" />
			</div>
			<div>
				<button type="submit" class="bg-blue-500 text-white px-2 py-3 rounded font-medium w-full">
					Sign up
				</button>
			</div>
		</form>
	</div>
</div>
@endsection