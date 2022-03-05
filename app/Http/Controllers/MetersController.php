<?php

namespace App\Http\Controllers;

use App\Models\Meters;
use Illuminate\Http\Request;

class MetersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request):\Illuminate\Contracts\View\View
    {
        $pageSize = (int)$request->query('page_size', 10);
        $search = (string)$request->query('search', '');

        $meters = Meters::with(['job_type', 'job_status', 'job_amount', 'transformer']);

        if ($search) {
            $meters
                ->where('meters.document_number', 'like', '%' . $search . '%')
                ->orWhereHas('job_status', function ($query) use ($search) {
                    return $query->where('description', 'like', '%' . $search . '%');
                });
        }

//        dd(\Carbon\Carbon::parse('2019-03-01')->translatedFormat('d F Y'), now()->subMinute(5)->diffForHumans());

        return view('meters.index', [
            'meters' => $meters->sortable()->paginate($pageSize),
            'pageSize' => $pageSize,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meters  $meters
     * @return \Illuminate\Http\Response
     */
    public function show(Meters $meters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meters  $meters
     * @return \Illuminate\Http\Response
     */
    public function edit(Meters $meters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meters  $meters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meters $meters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meters  $meters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meters $meters)
    {
        //
    }
}
