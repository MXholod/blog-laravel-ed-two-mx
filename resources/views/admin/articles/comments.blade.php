@extends('admin.layouts.index')

@section('title','Comments related to the article')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-mt-2 tw-mb-2 tw-text-blue-600 tw-font-black">
		List of comments to the article
	</h3>
	<!--<ul class="list-group">-->
	{{--  @include('admin.articles.comment_list', ['comments' => $comments]) --}}
	<!--</ul>-->
	<mx-content :comments="{{ json_encode($comments) }}" :paginate="5" />
</div>
@endsection