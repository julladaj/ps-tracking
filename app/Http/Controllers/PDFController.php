<?php

namespace App\Http\Controllers;

use App\Models\Meters;
use App\Models\Transformers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class PDFController extends Controller
{
    public function show(Meters $meter)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::class;

        $seconds = 24 * 60 * 60;

        return PDF::loadView('meters.pdf', [
            'pdf' => $pdf,
            'meter' => $meter,
            'meter_extra' => $meter->meter_extra_keys(),
            'transformers' => Cache::remember('transformers', $seconds, function () {
                return Transformers::all();
            }),
        ])->stream();
    }
}
