<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Currency\Currency;
use App\Http\Requests\Report\ReportSearchRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\QuotesExport;
use Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currencies=Currency::where('state', '1')->orderBy('name', 'ASC')->get();
        return view('admin.reports.index', compact('currencies'));
    }

    public function export(ReportSearchRequest $request) {
        $currency=Currency::where('slug', request('currency_id'))->firstOrFail();
        $between=[date('Y-m-d H:i:s', strtotime(request('start'))), date('Y-m-d H:i:s', strtotime(request('end')))];
        $quotes=Quote::with(['customer_source' => function($query) {
            $query->withTrashed();
        }, 'customer_source.country' => function($query) {
            $query->withTrashed();
        }, 'customer_destination' => function($query) {
            $query->withTrashed();
        }, 'customer_destination.country' => function($query) {
            $query->withTrashed();
        }, 'currency_source' => function($query) {
            $query->withTrashed();
        }, 'currency_destination' => function($query) {
            $query->withTrashed();
        }])->where('currency_source_id', $currency->id)->whereBetween('created_at', $between)->orderBy('id', 'DESC')->get();

        if ($quotes->count()==0) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'No hay resultados', 'msg' => 'No hay cotizaciones realizadas, intentelo nuevamente.']);
        }

        if (request('type')=='1') {
            $pdf=PDF::setOptions(['isPhpEnabled' => true]);
            $pdf=PDF::loadView('pdfs.reports.quotes', compact('quotes'))->setPaper('a4', 'landscape');
            return $pdf->stream('cotizaciones.pdf');
        } else {
            return Excel::download(new QuotesExport($quotes), 'cotizaciones.xlsx');
        }
    }
}
