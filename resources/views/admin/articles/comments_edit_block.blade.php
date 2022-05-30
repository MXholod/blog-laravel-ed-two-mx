@foreach ($comments as $comment)
	<li class="list-group-item tw-text-sm">
		<input type="hidden" name="com_id" value="{{$comment->id}}" />
		<input type="hidden" name="user_id" value="{{$comment->user_id}}" />
		<div class="tw-w-full tw-font-black">{{ $comment->subject }}</div>
		<div class="tw-w-full">{{ $comment->body }}</div>
	</li>
@endforeach