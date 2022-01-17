@extends('site.layouts.index')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3>All articles</h3>
	<ul class="nav flex-column tw-columns-3">
	  @foreach($articles as $article)
		<li class="nav-item tw-text-sm article-item-preview">
			<div class="tw-flex tw-flex-row">
				<span class="article-img-preview">
					<img src="{{ $article->img }}" alt="{{ $article->title }}" class="tw-inline-block" />
				</span>
				<div class="tw-flex tw-flex-col tw-pl-2 article-text-preview">
					<div class="tw-flex tw-flex-col article-main-text">
						<span>
							{{ $article->title }}
						</span>
						<span>
							{{ $article->getBodyPreview() }}
						</span>
					</div>
					<div class="mt-4">
						Tags:
						@foreach($article->tags as $tag)
							<a href="{{ route('article.tag', $tag->id) }}" class="badge btn-danger">
								{{ $tag->label }}
							</a>
						@endforeach
					</div>
					<div class="article-details">
						<span class="tw-text-sm article-created-at">
							Article created: {{ $article->createdAtForHumans() }}
						</span>
						<a href="{{ route('article.show', ['slug'=>$article->slug]) }}">more...</a>
					</div>
				</div>
			</div>
		</li>
	  @endforeach
	</ul>
	<div>{{ $articles->links() }}</div>
</div>
@endsection