<div>
	<table class="table">
		<thead>
			<tr>
				<th>Tasa de Conversión</th>
				<th>A Cobrar @if(!is_null($currency_source)){{ "($currency_source->iso)" }}@endif</th>
				<th>Cargos @if(!is_null($currency_source)){{ "($currency_source->iso)" }}@endif</th>
				<th>Total @if(!is_null($currency_source)){{ "($currency_source->iso)" }}@endif</th>
				<th>En Destino @if(!is_null($currency_destination)){{ "($currency_destination->iso)" }}@endif</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ number_format($conversion_rate ?? 0.0000, 4, ',', '.') }}</td>
				<td>{{ currency_format($total, $currency_source->symbol ?? '', $currency_source->side ?? 'Derecha', 2, ',', '.') }}</td>
				<td>{{ currency_format($commission, $currency_source->symbol ?? '', $currency_source->side ?? 'Derecha', 2, ',', '.') }}</td>
				<td>{{ currency_format($amount, $currency_source->symbol ?? '', $currency_source->side ?? 'Derecha', 2, ',', '.') }}</td>
				<td>{{ currency_format($amount_destination, $currency_destination->symbol ?? '', $currency_destination->side ?? 'Derecha', 2, ',', '.') }}</td>
			</tr>
		</tbody>

		<div wire:loading>
			@include("admin.partials.livewire_loader")
		</div>
	</table>

	@if(session()->has('alert') && session()->has('type') && session()->has('title') && session()->has('msg'))
	@include('admin.partials.notifications')
	@endif
</div>