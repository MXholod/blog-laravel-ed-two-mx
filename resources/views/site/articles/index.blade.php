@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	@if(count($articles) > 0)
	<h3 class="tw-text-center tw-p-5 tw-font-semibold">
		The portion of {{ $articles->count() }} articles
	</h3>
	<ul class="nav flex-column tw-columns-3">
	  @foreach($articles as $article)
		<li class="nav-item tw-text-sm article-item-preview">
			<div class="tw-flex tw-flex-row">
				<span class="article-img-preview">
					@if(isset($article->title) && (substr($article->img,0,6) == "images"))
					<img src="{{ url('downloads/'.$article->img) }}"
						alt="{{ $article->title }}" 
						title="{{ $article->title }}" 
						class="tw-inline-block" 
					/>
					@else
						<img src="{{ $article->img }}" alt="{{ $article->title }}" class="tw-inline-block" />
					@endif
				</span>
				<div class="tw-flex tw-flex-col tw-pl-2 article-text-preview tw-bg-pink-50 tw-pb-2">
					<div class="tw-flex tw-flex-col article-main-text tw-pb-2">
						<span class="tw-pt-2 tw-text-center tw-font-semibold">
							{{ $article->title }}
						</span>
						<span class="tw-pt-1">
							{{ $article->getBodyPreview() }}
						</span>
					</div>
					<div class="article-details">
						<span class="tw-text-sm article-created-at">
							Article created: {{ $article->createdAtForHumans() }}
						</span>
						<a href="{{ route('article.show', ['slug'=>$article->slug]) }}" class="tw-bg-pink-400 tw-py-1 tw-px-2 tw-rounded-sm">
							more...
						</a>
					</div>
				</div>
			</div>
		</li>
	  @endforeach
	</ul>
	<div class="tw-mt-4 tw-ml-16">{{ $articles->links() }}</div>
	@else
		<h3 class="tw-text-center tw-p-5 tw-font-semibold">
			There is no any articles
		</h3>
	@endif
</div>
@endsection