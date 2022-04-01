<aside class="tw-bg-white tw-p-2 tw-rounded-r-lg">
	<h3>Sidebar</h3>
	@if(count($lastArticles) > 0)
	<div class="articles__list">
		<h3 data-icon="show">
			<span>Recent articles (total: {{ $lastArticles->count() }})</span>
			<i class="bi bi-caret-up"></i>
			<i class="bi bi-caret-down"></i>
		</h3>
		<ul class="nav flex-column">
		  @foreach($lastArticles as $lastArticle)
			<li class="nav-item tw-text-sm article-item-preview">
				<div class="tw-flex tw-flex-row">
					<span class="article-img-preview">
						@if(isset($lastArticle->title) && (substr($lastArticle->img,0,6) == "images"))
						<img src="{{ url('downloads/'.$lastArticle->img) }}"
							alt="{{ $lastArticle->title }}" 
							title="{{ $lastArticle->title }}"  
							class="tw-inline-block" 
						/>
						@else
							<img src="{{ $lastArticle->img }}" alt="{{ $lastArticle->title }}" class="tw-inline-block" />
						@endif
					</span>
					<div class="tw-flex tw-flex-col article-text-preview">
						<span>
							{{ $lastArticle->getBodyPreview() }}
						</span>
						<a class="nav-link active" aria-current="page" href="{{ route('article.show', ['slug'=>$lastArticle->slug]) }}">
							{{ $lastArticle->title }}
						</a>
					</div>
				</div>
				<div class="tw-flex tw-flex-row tw-text-base article-statistics">
					<div class="tw-bg-slate-50 tw-w-2/6">
						@isset($lastArticle->statistics)
						<span class="badge bg-primary">
							{{ $lastArticle->statistics->likes }}
							<i class="far fa-thumbs-up"></i>
						</span>
						@endisset
						@isset($lastArticle->statistics)
						<span class="badge bg-danger">
							{{ $lastArticle->statistics->views }}
							<i class="far fa-eye"></i>
						</span>
						@endisset
					</div>
					<div class="tw-bg-slate-200 tw-w-4/6">
						<span>Tags</span>
						@foreach($lastArticle->tags as $tag)
							<a href="{{ route('article.tag', $tag->id) }}" class="badge btn-danger">
								{{ $tag->label }}
							</a>
						@endforeach
					</div>
				</div>
				<div class="article-created-at">
					<span class="tw-text-sm">
						Article created: 
					</span>
					{{ $lastArticle->createdAtForHumans() }}
				</div>
			</li>
		  @endforeach
		</ul>
	</div>
	@endif
</aside>
@push('scripts-bottom')
<script>
	const articlesListBlock = document.querySelector('.articles__list');
	if(articlesListBlock !== null){
		const h3 = articlesListBlock.children[0];
		const ul = articlesListBlock.children[1];
		const arrowUp = h3.children[1];
		const arrowDown = h3.children[2];
		h3.addEventListener('click',function(e){
			//Hide list if shown
			if(h3.dataset.icon === 'show'){
				h3.dataset.icon = 'hide';
				arrowUp.style.display = "none";
				arrowDown.style.display = "inline";
				//Show the items. Amount of LIs, time, interval, forward or backward
				customInterval(ul.children.length,200, 100, false);
			}else{//Show list if hidden
				h3.dataset.icon = 'show';
				arrowUp.style.display = "inline";
				arrowDown.style.display = "none";
				//Show the items. Amount of LIs, time, interval, forward or backward
				customInterval(ul.children.length,100, 100, true);
			}
		},false);
		
		function customInterval(stop = 1, time = 200, extraTime = 200, reverse = false){
			let t1 = null,t2 = null, start = 0;
			t1 = window.setTimeout(function f(){
				t2 = window.setTimeout(f, time);
				//Call closure
				showItems();
			}, time);
			//Closure
			function showItems(){
				//Backward
				if(stop !== 0 && reverse){
					//time -= Math.floor(extraTime / stop);
					ul.children[start].style.display = "none";
				}
				//Forward
				if(stop !== 0 && !reverse){
					time += Math.floor(extraTime / stop);;
					ul.children[start].style.display = "block";
				}
				start++;
				if(t1){
					window.clearTimeout(t1);
					t1 = null;
				} 
				if(start >= stop){
					window.clearTimeout(t2);
					t2 = null;
					start = 0;
				}
			}
		}
	}
	
</script>
@endpush