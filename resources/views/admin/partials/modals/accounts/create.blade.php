<x-modal-form modal="accountCustomer" size="modal-lg" form="formAccountCustomer" method="POST" title="Agregar una cuenta bancaria" validate="customer" close="Cancelar" button="Guardar">
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
			<label class="col-form-label">Banco<b class="text-danger">*</b></label>
			<input class="form-control @error('bank') is-invalid @enderror" type="text" name="bank" required placeholder="Introduzca un banco" value="{{ old('bank') }}">
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Número de Cuenta<b class="text-danger">*</b></label>
			<input class="form-control number @error('number') is-invalid @enderror" type="text" name="number" required placeholder="Introduzca un número de cuenta" value="{{ old('number') }}">
		</div>
	</div>
</x-modal-form>