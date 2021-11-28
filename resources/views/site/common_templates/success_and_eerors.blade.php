@if (session()->has('success'))
	<div class="block-success-error block-success-error__success">
		{{ session('success') }}
	</div>
@endif
@if (session()->has('error'))
	<div class="block-success-error block-success-error__error">
		{{ session('error') }}
	</div>
@endif

