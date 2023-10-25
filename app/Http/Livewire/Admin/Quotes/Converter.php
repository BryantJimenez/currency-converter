<?php

namespace App\Http\Livewire\Admin\Quotes;

use App\Models\Setting;
use App\Models\Currency\Currency;
use App\Models\Currency\Exchange;
use Livewire\Component;

class Converter extends Component
{
	public $currency_source=NULL;
	public $currency_destination=NULL;
	public $type_operation=NULL;
	public $conversion_rate=0.00;
	public $amount=0.00;
	public $commission=0.00;
	public $iva=0.00;
	public $total=0.00;
	public $amount_destination=0.00;

	protected $listeners=['calculateCuote' => 'calculateCuote', 'refreshConverter' => '$refresh'];

	public function mount()
	{
		$settings=Setting::first();
		if (!is_null($settings)) {
			if (!is_null($this->currency_source) && is_string($this->currency_source)) {
				$currency=Currency::where('slug', $this->currency_source)->first();
				$this->currency_source=$currency;
				if (is_null($currency)) {
					session_flash_messages('error', 'Moneda de origen no existe', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
				}
			}

			if (!is_null($this->currency_destination) && is_string($this->currency_destination)) {
				$currency=Currency::where('slug', $this->currency_destination)->first();
				$this->currency_destination=$currency;
				if (is_null($currency)) {
					session_flash_messages('error', 'Moneda de destino no existe', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
				}
			}

			if (!is_null($this->currency_source) && !is_null($this->currency_destination)) {
				$exchange=Exchange::where([['currency_id', $this->currency_source->id], ['currency_exchange_id', $this->currency_destination->id]])->first();
				if (is_null($exchange)) {
					session_flash_messages('warning', 'La tasa de conversión no existe', 'Agrega una tasa de intercambio entre estas monedas.');
				}
				$this->conversion_rate=$exchange->conversion_rate ?? 0.00;

				if ($this->type_operation=='1' || $this->type_operation=='2' || $this->type_operation=='3') {
					if ($this->type_operation=='1') {
						$this->amount_destination=$this->amount;
						$this->amount=($this->conversion_rate>0) ? $this->amount_destination*(1/$this->conversion_rate) : 0.00;
						$commissions=calculate_commission($this->amount, $settings->fixed_commission, $settings->percentage_commission, $settings->iva, $settings->max_fixed_commission);
						$this->commission=$commissions['commission'];
						$this->iva=$commissions['iva'];
						$this->total=$this->amount+$this->commission;
					} elseif ($this->type_operation=='2') {
						$commissions=calculate_commission($this->amount, $settings->fixed_commission, $settings->percentage_commission, $settings->iva, $settings->max_fixed_commission);
						$this->commission=$commissions['commission'];
						$this->iva=$commissions['iva'];
						$this->total=$this->amount-$this->commission;
						$this->amount_destination=$this->total*$this->conversion_rate;
					} elseif ($this->type_operation=='3') {
						$this->amount_destination=$this->amount*$this->conversion_rate;
						$this->commission=0.00;
						$this->iva=0.00;
						$this->total=$this->amount;
					}
				} else {
					$this->resetExcept(['currency_source', 'currency_destination', 'type_operation', 'amount']);
				}

			} else {
				$this->resetExcept(['currency_source', 'currency_destination', 'type_operation', 'amount']);
			}
		} else {
			session_flash_messages('error', 'Los ajustes no estan configurados', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
		}
		$this->emit('refreshConverter');
	}

	public function render() {
		return view('livewire.admin.quotes.converter');
	}

	public function calculateCuote($data) {
		if (isset($data['currency_source']) && !empty($data['currency_source'])) {
			$currency=Currency::where('slug', $data['currency_source'])->first();
			$this->currency_source=$currency;
			if (is_null($currency)) {
				session_flash_messages('error', 'Moneda de origen no existe', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
			}
		} else {
			$this->currency_source=NULL;
			session_flash_messages('warning', 'Moneda de origen no seleccionada', 'Selecciona una moneda de origen e intentelo nuevamente.');
		}

		if (isset($data['currency_destination']) && !empty($data['currency_destination'])) {
			$currency=Currency::where('slug', $data['currency_destination'])->first();
			$this->currency_destination=$currency;
			if (is_null($currency)) {
				session_flash_messages('error', 'Moneda de destino no existe', 'Ha ocurrido un error durante el proceso, intentelo nuevamente.');
			}
		} else {
			$this->currency_destination=NULL;
			session_flash_messages('warning', 'Moneda de destino no seleccionada', 'Selecciona una moneda de destino e intentelo nuevamente.');
		}

		if (isset($data['type']) && !empty($data['type'])) {
			$this->type_operation=$data['type'];
		} else {
			$this->type_operation=NULL;
			session_flash_messages('warning', 'Tipo de operación no seleccionada', 'Selecciona el tipo de operación e intentelo nuevamente.');
		}

		if (isset($data['amount']) && !empty($data['amount'])) {
			$this->amount=(Float) $data['amount'];
		} else {
			$this->amount=0.00;
		}
		
		$this->emit('refreshConverter');
		$this->resetExcept(['currency_source', 'currency_destination', 'type_operation', 'amount']);
		$this->mount();
	}
}
