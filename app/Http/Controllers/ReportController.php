<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users=User::where('user_role', '!=', 'Cliente')->orderBy('name', 'ASC')->get();
        return view('admin.reports.index', compact('currencies', 'users'));
    }

    public function export(ReportSearchRequest $request) {
        $user=User::where('slug', request('user_id'))->first();
        $currency=Currency::where('slug', request('currency_id'))->firstOrFail();
        $between=[date('Y-m-d H:i:s', strtotime(request('start'))), date('Y-m-d H:i:s', strtotime(request('end')))];
        $quotes=Quote::with(['user' => function($query) {
            $query->withTrashed();
        }, 'customer_source' => function($query) {
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
        }])->where('currency_source_id', $currency->id);

        if (!is_null($user)) {
            $quotes=$quotes->where('user_id', $user->id);
        }

        $quotes=$quotes->whereBetween('created_at', $between)->orderBy('id', 'DESC')->get();

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
