@extends('admin.layouts.index')

@section('title','Edit the chosen article')

@section('content')
<div class="tw-container tw-bg-white tw-p-6 tw-rounded-l-lg">
	<h3 class="tw-text-lg tw-font-black tw-text-blue-600">Edit the article</h3>
	<form method="POST" action="{{ route('admin.articles.update', ['article' => $article->id]) }}" enctype="multipart/form-data">
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
			<div class="mb-3 tw-mt-3">
				<p class="tw-font-black tw-mb-3">Comments of the article</p>
				@if($comments->count() > 0)
					<div class="container">
						<input type="hidden" id="artId" value="{{$article->id}}" />
						<ul class="list-group list-group-flush" id="comments-list">
							@include('admin.articles.comments_edit_block', ['comments' => $comments, 'id' => $article->id])
						</ul>
					</div>
					<div id="comments-paginate">
						{{ $comments->appends(request()->query())->links() }}
					</div>
				@else
					<p class="tw-text-red-600">There are no comments for this article</p>
				@endif
			</div>
		</div>
		<div class="card-footer">
            <button type="submit" class="btn btn-primary">Update article</button>
        </div>
	</form>
	<pre></pre>
</div>
@endsection


@push("scripts-admin-bottom")
	<script type="text/javascript">
		const artId = document.getElementById("artId");
		const commentsList = document.getElementById("comments-list");
		const commentsPaginate = document.getElementById("comments-paginate");
		let listLI = commentsPaginate.querySelectorAll(".pagination li");
		//"http://laravelblogsecond/admin/article/1/edit?page="
		let host = window.location.protocol+"//"+window.location.host;
		let uri = host+"/admin/article/"+artId.value+"/edit?page=";
		//Three numbers 
		let currentButton = 0, current = 0, end = listLI.length - 1;
		//Subscribe on all LI elements
		for(let i = end; i >= 0; i--){
			//Set the current page
			if(listLI[i].hasAttribute("aria-current")){
				current = i;
				currentButton = i;
			}
			listLI[i].onclick = clickOnPagination;
		}
		//Click on each LI element
		function clickOnPagination(e){
			e.preventDefault();
			//Reset attributes and classes
			for(let i = end; i >= 0; i--){
				//Remove attribute 'aria-current' and class 'active'
				if(listLI[i].hasAttribute("aria-current") && listLI[i].classList.contains("active")){
					listLI[i].removeAttribute("aria-current");
					listLI[i].classList.remove("active");
				}
				//Remove attribute 'aria-disabled' and class 'disabled'
				if(listLI[i].hasAttribute("aria-disabled") && listLI[i].classList.contains("disabled")){
					listLI[i].removeAttribute("aria-disabled");// true
					listLI[i].removeAttribute("aria-label");// '« Previous' or 'Next »'
					listLI[i].classList.remove("disabled");
				}
			}
			
			//this //this - LI
			let el = determineChild(this);
			let elementCode = el.firstChild.nodeValue.charCodeAt();
			if(el.tagName === "A"){
				//Clicked on 'A'
				if(elementCode !== 8249 && elementCode !== 8250){
					//
					current = Number(el.firstChild.nodeValue);
				}else{//Clicked on 'A' but value is a: < or >
					//Back '<' character
					if(elementCode === 8249 && current > 1){
						current -= 1;
						//setAttrsNear(this, "« Previous");
					}
					//Forward '>' character
					if(elementCode === 8250 && current < (end - 1)){
						current += 1;
						//setAttrsNear(this, "Next »");
					}
				}
			}else if(el.tagName === "SPAN"){
				//Back '<' character
				if(elementCode === 8249){
					//
					if(current > 1){
						current -= 1;
					}else{
						current = 1;
					}
					//setAttrsNear(this, "« Previous");
				//Forward '>' character
				}else if(elementCode === 8250){
					if(current < (end - 1)){
						current += 1;
					}else{
						current = (end - 1);
					}
					//setAttrsNear(this, "Next »");
				}else{//Get a page number from 'SPAN' - active page number
					current = Number(el.firstChild.nodeValue);
				}
			}
			//URI formed with query string
			let uriPageNumber = uri+current;
			//Set element as 'active'
			activeElement();
			//Request to the server
			if(currentButton !== current){
				//Save 'current' to prevent request repeating 
				currentButton = current;
				getPaginationData(uriPageNumber);
			}
		}
		//Determine child relationally to parent element LI
		function determineChild(parentEl){
			if(parentEl.firstChild.nodeType !== 1){
				return parentEl.firstChild.nextSibling;
			}else{
				return parentEl.firstChild;
			}
		}
		//Set the current page as 'Active'
		function activeElement(){
			for(let i = end; i >= 0; i--){
				if(i === current){
					listLI[i].setAttribute("aria-current","page");
					listLI[i].classList.add("active");
					//
					if(current === 1){
						setAttrsNear(listLI[0], "« Previous");
					}
					if(current === (end - 1)){
						setAttrsNear(listLI[end], "Next »");
					}
				}
			}
		}
		//Rewrite attributes according to the 'Active' page for arrows '<' and '>'
		function setAttrsNear(el, ariaLabel){
			//Remove attribute 'aria-disabled' and class 'disabled'
			if(!el.hasAttribute("aria-disabled") && !el.classList.contains("disabled")){
				el.setAttribute("aria-disabled","true");
				el.setAttribute("aria-label", ariaLabel);// '« Previous' or 'Next »'
				el.classList.add("disabled");
			}
		}
		//Request on server
		async function getPaginationData(uri){
			try{
				//Make a request to server to get LI elements with content for the pagination
				const response = await window.axios.get(uri);
				//Assign data to UL element
				commentsList.innerHTML = response.data;
			}catch(e){
				//console.log(e);
				alert("Pagination is failed");
			}
		}
	</script>
@endpush