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
			@if(!!$article->getImage())
				@if(isset($article->title) && (substr($article->img, 0, 6) == "images"))
					<span class="full-article__image">		
						<img src="{{ url($article->getImage()) }}"
							width="160"
							height="120"
							alt="Image preview" 
							title="{{ $article->title }}" 
							class="tw-inline-block" 
						/>
					</span>
				@else
					<span class="full-article__image">
						<img src="{{ $article->img }}" alt="{{ $article->title }}" class="tw-inline-block" />
					</span>
				@endif
			@endif
			{{ $article->body }}
		</div>
		<p class="tw-mt-4 tw-ml-4">
			<span class="tw-italic tw-pr-4">Tags:</span>
			@foreach($article->tags as $tag)
				@if($loop->last)
					<span class="tw-font-bold">{{ $tag->label }}</span>
				@else
					<span class="tw-font-bold">{{ $tag->label }} |</span>
				@endif
			@endforeach
		</p>
		<footer class="tw-pt-6">
			<div class="tw-bg-slate-50 tw-w-2/6">
				@auth
					@isset($article->statistics)
						<article-likes 
							:user="{{json_encode(['userId'=>auth()->id()])}}" 
							:likes="{{ $likesAmount }}"
							>
							<span slot="likes" class="badge bg-primary">
								{{ $likesAmount }}
								<i class="far fa-thumbs-up"></i>
							</span>
						</article-likes>
					@endisset
				@endauth
				@guest
					<span slot="likes" class="badge bg-primary">
						{{ $likesAmount }}
						<i class="far fa-thumbs-up"></i>
					</span>
				@endguest
				@isset($article->statistics)
					<article-views>
						<span slot="views" class="badge bg-danger">
							{{ $article->statistics->views }}
							<i class="far fa-eye"></i>
						</span>
					</article-views>
				@endisset	
			</div>
		</footer>
	</article>
	<div class="tw-mt-4 article-comments">
		@auth
		<form action="{{route('comment.store')}}" method="post">
			<fieldset>
				<legend>Leave a comment</legend>
				@csrf
			<div>
				<label class="form-label">
					<input type="text" name="comTheme" class="form-control @error('comTheme') is-invalid @enderror" placeholder="Comment theme" value="{{ old('comTheme') }}" />
					@if($errors->has('comTheme'))
						<span class="text-danger">{{ $errors->first('comTheme') }}</span>
					@endif
				</label>
			</div>
			<div>
				<label class="form-label">Comment
					<textarea name="comText" class="form-control @error('comText') is-invalid @enderror" rows="3" cols="24" placeholder="Comment text">
						{{ old('comText') }}
					</textarea>
					@if($errors->has('comText'))
						<span class="text-danger">{{ $errors->first('comText') }}</span>
					@endif
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
			@foreach($article->portionComments() as $comment)
				<div class="tw-w-full toast show" data-bs-autohide="false">
					<div class="toast-header tw-flex-col tw-items-start">
						<span><b>User name:</b> {{ $comment->user->firstname }}</span>
						<img class="rounded" />
						<span><b>Discussed theme:</b> {{ $comment->subject }}</span>
					</div>
					@if(!$comment->user_warning)
					<div class="toast-body">
						{{ $comment->body }}
					</div>
					@else
					<div class="toast-body tw-text-center">
						<span class="tw-font-black" style="color: rgb(225 29 72)">
							Your comment has been banned by administrator
						</span>
					</div>
					@endif
					<div>
						<small class="tw-inline-block tw-w-full tw-text-right tw-pr-6">
							Commented on: {{ $comment->createdAtForHumans() }}
						</small>
					</div>
				</div>
			@endforeach
			<div class="tw-mt-2">
				{{ $article->portionComments()->links() }}
			</div>
		</div>
		@else
		<div class="tw-mt-3 article-comment-list">
			<p>Comments are absent</p>
		</div>
		@endif
	</div>
</div>
@endsection