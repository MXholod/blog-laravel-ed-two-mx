@extends('admin.layouts.index')

@section('title','Create a tag')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-text-lg tw-font-black tw-text-blue-600">Create a tag</h3>
	<form method="POST" action="{{ route('admin.tags.store') }}" enctype="multipart/form-data">
		<div class="card-body">
			@csrf
			<div class="mb-3">
				<label for="label" class="form-label tw-font-black">Title</label>
				<input type="text" id="label" name="label" class="form-control @error('label') is-invalid @enderror" />
			</div>
		</div>
		<div class="card-footer">
            <button type="submit" class="btn btn-primary">Add a tag</button>
        </div>
	</form>
	<pre></pre>
</div>
@endsection