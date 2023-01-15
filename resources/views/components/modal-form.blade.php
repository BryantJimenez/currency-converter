<div class="modal fade" id="{{ $modal }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog {{ $size }}" role="document">
		<form action="#" method="POST" class="modal-content" id="{{ $form }}">
			@csrf
			@if($method!='POST')
			@method($method)
			@endif
			<div class="modal-header">
				<h5 class="modal-title">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{ $slot }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">{{ $close }}</button>
				<button type="submit" class="btn btn-primary" action="{{ $validate }}">{{ $button }}</button>
			</div>
		</form>
	</div>
</div>