<?php

namespace App\Http\Controllers;

use App\Models\Meters;
use App\Models\Transformers;
use Illuminate\Support\Facades\Cache;

class PDFController extends Controller
{
    public function show(Meters $meter)
    {
        $seconds = 24 * 60 * 60;

        return \Barryvdh\DomPDF\Facade\Pdf::loadView('meters.pdf', [
            'meter' => $meter,
            'meter_extra' => $meter->meter_extra_keys(),
            'transformers' => Cache::remember('transformers', $seconds, function () {
                return Transformers::all();
            }),
        ])->stream();
    }
}
