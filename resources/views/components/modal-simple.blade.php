<div class="modal fade" id="{{ $modal }}" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{ $title }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="{{ $form }}">
					@csrf
					@method($method)
					<button type="submit" class="btn btn-primary">{{ $button }}</button>
				</form>
			</div>
		</div>
	</div>
</div>