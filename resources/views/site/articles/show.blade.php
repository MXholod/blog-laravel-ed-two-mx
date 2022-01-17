@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<article class="full-article tw-flex tw-flex-col">
		<header>	
			<h3 class="tw-text-lg tw-font-bold tw-p-3 full-article__header">
				{{ $article->title }}
			</h3>
			<div class="tw-text-xs tw-text-right tw-pr-10 tw-pb-3 full-article__created-at">
				Posted on: {{ $article->createdAtForHumans() }}
			</div>
		</header>
		<div class="full-article__content">
			<span class="full-article__image">
				<img src="{{ $article->img }}" />
			</span>
			{{ $article->body }}
		</div>
		<p>
			@foreach($article->tags as $tag)
				@if($loop->last)
					<span>{{ $tag->label }}</span>
				@else
					<span>{{ $tag->label }} |</span>
				@endif
			@endforeach
		</p>
		<footer class="tw-pt-6">
			<div class="tw-bg-slate-50 tw-w-2/6">
			@isset($article->statistics)
				<span class="badge bg-primary">
					{{ $article->statistics->likes }}
					<i class="far fa-thumbs-up"></i>
				</span>
			@endisset
			@isset($article->statistics)
				<span class="badge bg-danger">
					{{ $article->statistics->views }}
					<i class="far fa-eye"></i>
				</span>
			@endisset	
			</div>
		</footer>
	</article>
	<div class="tw-mt-4 article-comments">
		@auth
		<form action="" method="">
			<fieldset>
				<legend>Leave a comment</legend>
			<div>
				<label class="form-label">
					<input type="text" class="form-control" placeholder="Comment theme" />
				</label>
			</div>
			<div>
				<label class="form-label">Comment
					<textarea class="form-control" rows="3" cols="24"></textarea>
				</label>
				<input type="hidden" name="userId" value="{{ auth()->id() }}" />
				<input type="hidden" name="articleId" value="{{ $article->id }}" />
			</div>
			<button class="btn btn-success btn-sm" type="submit">Add comment</button>
			</fieldset>
		</form>
		@endauth
		@guest
			<p class="tw-font-bold tw-mb-8">You must be authenticated to leave a comment</p>
		@endguest
		@if($article->comments->count())
		<div class="tw-mt-3 article-comment-list">
			@foreach($article->comments as $comment)
				<div class="tw-w-full toast show" data-bs-autohide="false">
					<div class="toast-header">
						<img class="rounded" />
						<b>{{ $comment->subject }}</b>
					</div>
					<div class="toast-body">
						{{ $comment->body }}
					</div>
					<div>
						<small class="tw-inline-block tw-w-full tw-text-right tw-pr-6">
							Commented on: {{ $comment->createdAtForHumans() }}
						</small>
					</div>
				</div>
			@endforeach
		</div>
		@else
		<div class="tw-mt-3 article-comment-list">
			<p>Comments are absent</p>
		</div>
		@endif
	</div>
</div>
@endsection