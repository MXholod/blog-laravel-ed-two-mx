@extends('admin.layouts.index')

@section('title','Comments related to the article')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-mt-2 tw-mb-2 tw-text-blue-600 tw-font-black">
		List of comments to the article
	</h3>
	<ul class="list-group">
		@foreach($comments as $comment)
			@if ($loop->first)
				<li class="list-group-item disabled" aria-disabled="true">
					<div><b>User: </b>{{ $comment->user->firstname }}</div>
					<div>
						<b>Subject: </b>
						{{ $comment->subject }}
					</div>
					<div><b>Comment: </b>{{ $comment->body }}</div>
				</li>
			@else
			<li class="list-group-item">
				<div><b>User: </b>{{ $comment->user->firstname }}</div>
				<div>
					<b>Subject: </b>
					{{ $comment->subject }}
				</div>
				<div><b>Comment: </b>{{ $comment->body }}</div>
			</li>
			@endif
		@endforeach
	</ul>
</div>
@endsection