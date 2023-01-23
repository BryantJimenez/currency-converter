<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quote;
use App\Models\Account;
use App\Models\Setting;
use App\Models\Currency\Currency;
use App\Models\Currency\Exchange;
use App\Http\Requests\Quote\QuoteStoreRequest;
use App\Http\Requests\Quote\QuoteUpdateRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $quotes=Quote::with(['customer_source' => function($query) {
            $query->withTrashed();
        }, 'customer_destination' => function($query) {
            $query->withTrashed();
        }, 'currency_source' => function($query) {
            $query->withTrashed();
        }, 'currency_destination' => function($query) {
            $query->withTrashed();
        }])->orderBy('id', 'DESC')->get();
        return view('admin.quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    	$currencies=Currency::where('state', '1')->orderBy('name', 'ASC')->get();
    	$customers=User::role(['Cliente'])->with(['accounts'])->where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.quotes.create', compact('currencies', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteStoreRequest $request) {
        $data=$this->calculateQuote($request->all());
        $quote=Quote::create($data);
        if ($quote) {
            return redirect()->route('quotes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La cotización ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('quotes.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote) {
        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote) {
    	$currencies=Currency::where('state', '1')->orderBy('name', 'ASC')->get();
    	$customers=User::role(['Cliente'])->with(['accounts'])->where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.quotes.edit', compact('quote', 'currencies', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteUpdateRequest $request, Quote $quote) {
        $data=$this->calculateQuote($request->all());
        $quote->fill($data)->save();
        if ($quote) {
            return redirect()->route('quotes.edit', ['quote' => $quote->id])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La cotización ha sido editada exitosamente.']);
        } else {
            return redirect()->route('quotes.edit', ['quote' => $quote->id])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quote $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote) {
        $quote->delete();
        if ($quote) {
            return redirect()->route('quotes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La cotización ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('quotes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function invoice(Quote $quote) {
        $types=['Empresa', 'Cliente'];
        $pdf=PDF::setOptions(['isPhpEnabled' => true]);
        $pdf=PDF::loadView('pdfs.quotes.invoice', compact('quote', 'types'));
        return $pdf->stream('factura.pdf');
    }

    public function calculateQuote($request) {
        $settings=Setting::first();
        if (is_null($settings)) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Los ajustes no estan configurados', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }

        $customer_source=User::where('slug', $request['customer_source_id'])->first();
        $customer_destination=User::where('slug', $request['customer_destination_id'])->first();
        $account_destination=Account::where('slug', $request['account_destination_id'])->first();
        $currency_source=Currency::where('slug', $request['currency_source_id'])->first();
        $currency_destination=Currency::where('slug', $request['currency_destination_id'])->first();

        $exchange=Exchange::where([['currency_id', $currency_source->id], ['currency_exchange_id', $currency_destination->id]])->first();
        if (is_null($exchange) || is_null($exchange->conversion_rate)) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'La tasa de conversión no existe', 'msg' => 'Agrega una tasa de intercambio entre estas monedas e intentelo nuevamente.'])->withInputs();
        }

        $iva=0.00;
        $total=0.00;
        $commission=0.00;
        $amount=$request['amount'];
        $conversion_rate=$exchange->conversion_rate;
        if ($request['type_operation']=='1') {
            $amount_destination=$amount;
            $amount=($conversion_rate>0) ? $amount_destination*(1/$conversion_rate) : 0.00;
            $commissions=calculate_commission($amount, $settings->fixed_commission, $settings->percentage_commission, $settings->iva, $settings->max_fixed_commission);
            $type_commission=$commissions['type_commission'];
            $value_commission=$commissions['value_commission'];
            $iva=$commissions['iva'];
            $commission=$commissions['commission']-$iva;
            $total=$amount+$commission+$iva;
        } elseif ($request['type_operation']=='2') {
            $amount_destination=$amount*$conversion_rate;
            $commissions=calculate_commission($amount, $settings->fixed_commission, $settings->percentage_commission, $settings->iva, $settings->max_fixed_commission);
            $type_commission=$commissions['type_commission'];
            $value_commission=$commissions['value_commission'];
            $iva=$commissions['iva'];
            $commission=$commissions['commission']-$iva;
            $total=$amount+$commission+$iva;
        } elseif ($request['type_operation']=='3') {
            $amount_destination=$amount*$conversion_rate;
            $type_commission='1';
            $value_commission=$settings->fixed_commission;
            $total=$amount;
        }

        $data=array('amount' => $amount, 'commission' => $commission, 'iva' => $iva, 'total' => $total, 'amount_destination' => $amount_destination, 'conversion_rate' => $conversion_rate, 'type_operation' => $request['type_operation'], 'type_commission' => $type_commission, 'value_commission' => $value_commission, 'iva_percentage' => $settings->iva, 'reason' => $request['reason'], 'customer_source_id' => $customer_source->id, 'customer_destination_id' => $customer_destination->id, 'account_destination_id' => $account_destination->id, 'currency_source_id' => $currency_source->id, 'currency_destination_id' => $currency_destination->id);

        return $data;
    }
}
