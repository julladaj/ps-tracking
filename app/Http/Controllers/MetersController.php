<?php

namespace App\Http\Controllers;

use App\Models\ElectricExpands;
use App\Models\JobAmounts;
use App\Models\JobStatuses;
use App\Models\JobTypes;
use App\Models\Meters;
use App\Models\PeaStaffs;
use App\Models\Transformers;
use Illuminate\Http\Request;

class MetersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $pageSize = (int)$request->query('page_size', 10);
        $search = (string)$request->query('search', '');

        $meters = Meters::with(['job_type', 'job_status', 'job_amount', 'transformer', 'pea_staff'])
            ->orderBy('id', 'desc');

        if ($search) {
            $meters
                ->where('meters.document_number', 'like', '%' . $search . '%')
                ->orWhere('meters.customer_name', 'like', '%' . $search . '%')
                ->orWhereHas('job_status', function ($query) use ($search) {
                    return $query->where('description', 'like', '%' . $search . '%');
                });
        }

        $report = [
            'wait_for_action' => Meters::where('job_status_id', 1)->count(),
            'survey' => Meters::where('job_status_id', 2)->count(),
            'estimate' => Meters::where('job_status_id', 3)->count(),
            'approve' => Meters::where('job_status_id', 4)->count(),
            'payment' => Meters::where('job_status_id', 5)->count(),
            'all' => Meters::count()
        ];

        return view('meters.index', [
            'meters' => $meters->sortable()->paginate($pageSize),
            'pageSize' => $pageSize,
            'search' => $search,
            'report' => $report
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('meters.edit', [
            'isCreate' => true,
            'job_amounts' => JobAmounts::all(),
            'job_statuses' => JobStatuses::all(),
            'job_types' => JobTypes::all(),
            'pea_staffs' => PeaStaffs::all(),
            'transformers' => Transformers::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (!$request->has('meters')) {
            return back()->with('error', 'ข้อมูลไม่ครบถ้วน');
        }
        $meter = Meters::create($request->get('meters'));
        return redirect(route('meters.edit', $meter))->with('success', 'บันทึกข้อมูลสำเร็จ');
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
     * @param  \App\Models\Meters  $meter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Meters $meter)
    {
        $meter->with(['job_type', 'job_status', 'job_amount', 'transformer', 'pea_staff', 'electric_expand']);

        return view('meters.edit', [
            'isCreate' => false,
            'meter' => $meter,
            'job_amounts' => JobAmounts::all(),
            'job_statuses' => JobStatuses::all(),
            'job_types' => JobTypes::all(),
            'pea_staffs' => PeaStaffs::all(),
            'transformers' => Transformers::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meters  $meter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Meters $meter)
    {
        if (!$request->has('meters')) {
            return back()->with('error', 'ข้อมูลไม่ครบถ้วน');
        }

        $request_meter = $request->get('meters');
        $request_electric_expands = $request->get('electric_expands');

        if ($request_meter['electric_expand_id']) {
            $electric_expands = ElectricExpands::find($request_meter['electric_expand_id']);
        } else {
            $electric_expands = ElectricExpands::create(['job_name' => '-']);
            $request_meter['electric_expand_id'] = $electric_expands->id;
        }

        $meter->update($request_meter);
        $electric_expands->update($request_electric_expands);

        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
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
