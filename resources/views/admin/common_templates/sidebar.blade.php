<aside class="tw-bg-white tw-p-2 tw-rounded-r-lg">
	<div class="tw-border-2 tw-border-indigo-300 tw-border-solid tw-rounded tw-p-1">
		<h3 class="tw-text-center tw-font-black">Entity management </h3>
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="{{ route('admin.articles.index') }}">
					Articles
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" aria-current="page" href="{{ route('admin.tags.index') }}">
					Tags
				</a>
			</li>
		</ul>
	</div>
</aside>
@push('scripts-admin-bottom')

@endpush