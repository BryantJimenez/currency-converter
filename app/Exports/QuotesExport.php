<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QuotesExport implements FromView, ShouldAutoSize
{
	public $quotes;

    public function __construct($quotes)
    {
    	$this->quotes=$quotes;
    }

    public function view(): View
    {
        return view('exports.reports.quotes', [
            'quotes' => $this->quotes
        ]);
    }
}