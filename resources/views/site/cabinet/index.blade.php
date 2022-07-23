@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<div class="tw-bg-red-200 tw-p-5 tw-rounded-md">
		<p class="tw-text-2xl tw-font-bold">User's cabinet</p>
		@if(auth()->user()->is_admin === 1)	
			<a href="{{ route('admin.index') }}">
			Go to admin
		</a>
		@endif
	</div>
</div>
@endsection