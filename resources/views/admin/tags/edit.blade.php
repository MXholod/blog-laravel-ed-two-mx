@extends('admin.layouts.index')

@section('title','Edit the chosen tag')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-text-lg tw-font-black tw-text-blue-600">Edit the tag</h3>
	<form method="POST" action="{{ route('admin.tags.update', ['tag' => $tag->id]) }}" enctype="multipart/form-data">
		<div class="card-body">
			@csrf
			@method('PUT')
			<div class="mb-3">
				<label for="label" class="form-label tw-font-black">Label</label>
				<input type="text" id="label" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ $tag->label }}">
			</div>
		</div>
		<div class="card-footer">
            <button type="submit" class="btn btn-primary">Update the tag</button>
        </div>
	</form>
	<pre></pre>
</div>
@endsection