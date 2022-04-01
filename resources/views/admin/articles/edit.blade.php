@extends('admin.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-text-lg tw-font-black tw-text-blue-600">Edit the article</h3>
	<form method="POST" action="{{ route('articles.update', ['article' => $article->id]) }}" enctype="multipart/form-data">
		<div class="card-body">
			@csrf
			@method('PUT')
			<div class="mb-3">
				<label for="title" class="form-label tw-font-black">Title</label>
				<input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" aria-describedby="emailHelp" value="{{ $article->title }}">
			</div>
			<div class="mb-3">
			  <label for="body" class="form-label tw-font-black">Text content</label>
			  <textarea id="body" name="body" rows="3" class="form-control @error('body') is-invalid @enderror">{{ $article->body }}</textarea>
			</div>
			<div class="form-group tw-p-4 tw-pl-0">
				<label for="thumbnail" class="tw-font-black">Image</label>
				<div class="input-group tw-mb-2">
					<div class="custom-file">
						<input type="file" name="img" id="thumbnail" />
						<label for="thumbnail" class="custom-file-label">Choose an image</label>
					</div>
				</div>
				@if(!$article->getImage())
					<span class="alert alert-danger" role="alert" style="position:relative;top:1rem;">
						Image is absent
					</span>
				@else
					@if(isset($article->title) && (substr($article->img, 0, 6) == "images"))
						<img src="{{ url($article->getImage()) }}"
							width="160"
							height="120"
							alt="Image preview" 
							title="{{ $article->title }}" 
							class="tw-inline-block" 
						/>
					@else
						<img src="{{ $article->img }}" alt="{{ $article->title }}" class="tw-inline-block" />
					@endif
				@endif
			</div>
			<div class="form-group">
				@if(count($allTags))
				<label for="tags" class="tw-font-black">Tags</label>
				<select multiple="multiple" id="tags" name="tags[]" class="select tw-border-solid tw-border tw-border-black tw-pl-2" data-placeholder="Tag selection" style="width:100%;">
					@foreach($allTags as $k_id => $v_label)
						<option value="{{ $k_id }}" @if(in_array($k_id, $article->tags->pluck('id')->all())) selected @endif>
							{{ $v_label}}
						</option>
					@endforeach
				</select>
				@else
					<p>There are no tags</p>
				@endif
			</div>
		</div>
		<div class="card-footer">
            <button type="submit" class="btn btn-primary">Add article</button>
        </div>
	</form>
	<pre></pre>
</div>
@endsection