<x-modal-form modal="contactCustomer" size="modal-lg" form="formContactCustomer" method="POST" title="Seleccione al nuevo contacto del cliente" validate="customer" close="Cancelar" button="Guardar">
	<div class="row">
		<div class="col-12">
			@include('admin.partials.errors')
			<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Cliente</label>
			<input class="form-control text-dark" type="text" name="name" disabled value="">
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Contacto<b class="text-danger">*</b></label>
			<select class="form-control selectpicker @error('customer_id') is-invalid @enderror" name="customer_id" required title="Seleccione" data-live-search="true" data-size="10">
				@foreach($customers as $customer)
				<option value="{{ $customer->slug }}" @if(old('customer_id')==$customer->slug) selected @endif>{{ $customer->name.' '.$customer->lastname.' (DNI: '.$customer->dni.')' }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Alias del Cliente<b class="text-danger">*</b></label>
			<input class="form-control @error('user_alias') is-invalid @enderror" type="text" name="user_alias" required placeholder="Introduzca un alias del cliente" value="{{ old('user_alias') }}">
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Alias del Contacto<b class="text-danger">*</b></label>
			<input class="form-control @error('destination_alias') is-invalid @enderror" type="text" name="destination_alias" required placeholder="Introduzca un alias del contacto" value="{{ old('destination_alias') }}">
		</div>
	</div>
</x-modal-form>