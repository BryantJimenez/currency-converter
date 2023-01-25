<?php

namespace App\Http\Controllers;

use App\Models\Currency\Currency;
use App\Models\Currency\Exchange;
use App\Http\Requests\Currency\CurrencyStoreRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use App\Http\Requests\Currency\CurrencyExchangeUpdateRequest;
use Illuminate\Http\Request;
use Str;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currencies=Currency::orderBy('id', 'DESC')->get();
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyStoreRequest $request) {
        $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'), 'side' => request('side'));
        $currency=Currency::create($data);

        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La moneda ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('currencies.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency) {
        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency) {
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyUpdateRequest $request, Currency $currency) {
        $data=array('name' => request('name'), 'iso' => request('iso'), 'symbol' => request('symbol'), 'side' => request('side'));
        $currency->fill($data)->save();
        if ($currency) {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido editada exitosamente.']);
        } else {
            return redirect()->route('currencies.edit', ['currency' => $currency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency) {
        $currency->delete();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La moneda ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, Currency $currency) {
        $currency->fill(['state' => "0"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, Currency $currency) {
        $currency->fill(['state' => "1"])->save();
        if ($currency) {
            return redirect()->route('currencies.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La moneda ha sido activada exitosamente.']);
        } else {
            return redirect()->route('currencies.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function editExchanges(Currency $currency) {
        $exchanges=Currency::with(['exchanges_reverse' => function($query) use ($currency) {
            $query->where('currencies.id', $currency->id);
        }])->where('id', '!=', $currency->id)->orderBy('id', 'ASC')->get();
        return view('admin.currencies.exchange', compact('currency', 'exchanges'));
    }

    public function updateExchanges(CurrencyExchangeUpdateRequest $request, Currency $currency) {
        $success=true;

        foreach (request('currency_id') as $key => $value) {
            $currency_exchange=Currency::where('slug', $value)->first();
            if (!is_null($currency_exchange)) {
                $exchange=Exchange::where([['currency_id', $currency->id], ['currency_exchange_id', $currency_exchange->id]])->first();
                if (!is_null($exchange)) {
                    $exchange->fill(['conversion_rate' => request('conversion_rate')[$key]])->save();
                } else {
                    $exchange=Exchange::create(['conversion_rate' => request('conversion_rate')[$key], 'currency_id' => $currency->id, 'currency_exchange_id' => $currency_exchange->id]);
                }
                
                if (!$exchange) {
                    $success=false;
                }
            }
        }

        if ($success) {
            return redirect()->route('currencies.exchanges.edit', ['currency' => $currency->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Las tasas de intercambio han sido editadas exitosamente.']);
        } else {
            return redirect()->route('currencies.exchanges.edit', ['currency' => $currency->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
