<?php

namespace App\Models;

use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = ['amount', 'commission', 'iva', 'total', 'amount_destination', 'conversion_rate', 'type_operation', 'type_commission', 'value_commission', 'iva_percentage', 'reason', 'state_payment', 'customer_source_id', 'customer_destination_id', 'account_destination_id', 'currency_source_id', 'currency_destination_id', 'user_id'];

    /**
     * Get the reference.
     *
     * @return string
     */
    public function getReferenceAttribute()
    {
        return str_pad($this->id, 8, 0, STR_PAD_LEFT);
    }

    /**
     * Get the type operation.
     *
     * @return string
     */
    public function getTypeOperationAttribute($value)
    {
        if ($value=='1') {
            return 'Pagar en Destino';
        } elseif ($value=='2') {
            return 'Comisión Incluida';
        } elseif ($value=='3') {
            return 'Sin Comisión';
        }
        return 'Desconocido';
    }

    /**
     * Get the type operation original value.
     *
     * @return string
     */
    public function getTypeOperationOriginalAttribute()
    {
        if ($this->type_operation=='Pagar en Destino') {
            return '1';
        } elseif ($this->type_operation=='Comisión Incluida') {
            return '2';
        } elseif ($this->type_operation=='Sin Comisión') {
            return '3';
        }
        return NULL;
    }

    /**
     * Get the type commission.
     *
     * @return string
     */
    public function getTypeCommissionAttribute($value)
    {
        if ($value=='1') {
            return 'Fija';
        } elseif ($value=='2') {
            return 'Porcentaje';
        }
        return 'Desconocido';
    }

    /**
     * Get the state payment.
     *
     * @return string
     */
    public function getStatePaymentAttribute($value)
    {
        if ($value=='1') {
            return 'Pagado en Destino';
        } elseif ($value=='2') {
            return 'Pendiente';
        } elseif ($value=='3') {
            return 'Inconsistente por Datos Errados';
        }
        return 'Desconocido';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $quote=$this->with(['user' => function($query) {
            $query->withTrashed();
        }, 'customer_source' => function($query) {
            $query->withTrashed();
        }, 'customer_destination' => function($query) {
            $query->withTrashed();
        }, 'account_destination' => function($query) {
            $query->withTrashed();
        }, 'currency_source' => function($query) {
            $query->withTrashed();
        }, 'currency_destination' => function($query) {
            $query->withTrashed();
        }])->where($field, $value)->first();
        if (!is_null($quote)) {
            return $quote;
        }

        return abort(404);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer_source() {
        return $this->belongsTo(User::class, 'customer_source_id');
    }

    public function customer_destination() {
        return $this->belongsTo(User::class, 'customer_destination_id');
    }

    public function account_destination() {
        return $this->belongsTo(Account::class, 'account_destination_id');
    }

    public function currency_source() {
        return $this->belongsTo(Currency::class, 'currency_source_id');
    }

    public function currency_destination() {
        return $this->belongsTo(Currency::class, 'currency_destination_id');
    }
}
