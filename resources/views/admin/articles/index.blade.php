@extends('admin.layouts.index')

@section('title','List of articles')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-text-2xl">List of articles</h3>
	
	<div class="tw-mt-2 tw-mb-3 tw-p-2 tw-pl-4" style="background-color: rgb(240 249 255)">
		<p>Here you can add a new article.
			<a href="{{ route('articles.create') }}" class="tw-font-black tw-text-indigo-600">Add an article</a>
		</p>
	</div>
	
	<ul class="list-group tw-mb-4">
		@foreach($articles as $article)
			@if ($loop->first)
				<li class="list-group-item tw-font-bold">
					Amount of articles in the list: {{ $articles->count() }}
				</li>
			@endif
			<li class="list-group-item">
				{{ $article->title }}
				<div>
					<div>
						<span>Amount of comments: {{ $article->comments()->count() }}</span>
						<a href="{{ route('admin.article.comments', ['id'=>$article->id]) }}">
							See the list of comments
						</a>
					</div>
					<div>
						<a href="{{ route('articles.edit',$article->id) }}" class="tw-mr-4">
							<i class="bi bi-wrench"></i>
						</a>
						<form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST" class="tw-inline-block">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm tw-p-0 tw-pl-1 tw-pr-1" onclick="return confirm('Delete it?')">
									<i class="bi bi-trash"></i>
								</button>
						</form>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
	{{ $articles->links() }}
</div>
@endsection