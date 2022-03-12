<?php

namespace App\Http\Controllers;

use App\Helpers\MeterHelper;
use App\Models\ElectricExpands;
use App\Models\EnvCommunities;
use App\Models\EnvEarths;
use App\Models\EnvTrees;
use App\Models\Geos;
use App\Models\JobAmounts;
use App\Models\JobStatusDurations;
use App\Models\JobStatuses;
use App\Models\JobTypes;
use App\Models\Meters;
use App\Models\PeaStaffs;
use App\Models\RequestedPlaces;
use App\Models\ReservedForests;
use App\Models\Stations;
use App\Models\Transformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        if ($request->has('job_status_id') && $job_status_id = $request->get('job_status_id')) {
            $meters->where('job_status_id', $job_status_id);
        }

        if ($request->has('overdue') && $request->get('overdue')) {
            $meters->where('expires_quote_date', '>', now());
        }

        $meter_index_url = route('meters.index');

        $over_report = [
            'job_status_url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                'job_status_id' => 0
            ]),
            'count' => Meters::count(),
            'job_status_avg' => MeterHelper::getStatusAverageDay(0),
            'overdue' => Meters::where('expires_quote_date', '>', now())->count(),
            'overdue_url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                'overdue' => 1
            ]),
            'color' => 'danger'
        ];

        $job_status_report = [
            'wait_for_action' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 1
                ]),
                'count' => Meters::where('job_status_id', 1)->count(),
                'avg' => MeterHelper::getStatusAverageDay(1),
                'color' => 'success'
            ],
            'survey' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 2
                ]),
                'count' => Meters::where('job_status_id', 2)->count(),
                'avg' => MeterHelper::getStatusAverageDay(2),
                'color' => 'info'
            ],
            'estimate' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 3
                ]),
                'count' => Meters::where('job_status_id', 3)->count(),
                'avg' => MeterHelper::getStatusAverageDay(3),
                'color' => 'warning'
            ],
            'approve' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 4
                ]),
                'count' => Meters::where('job_status_id', 4)->count(),
                'avg' => MeterHelper::getStatusAverageDay(4),
                'color' => 'primary'
            ],
            'payment' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 5
                ]),
                'count' => Meters::where('job_status_id', 5)->count(),
                'avg' => MeterHelper::getStatusAverageDay(5),
                'color' => 'danger'
            ]
        ];

        return view('meters.index', [
            'meters' => $meters->sortable()->paginate($pageSize),
            'pageSize' => $pageSize,
            'search' => $search,
            'over_report' => $over_report,
            'job_status_report' => $job_status_report
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $seconds = 24 * 60 * 60;

        return view('meters.edit', [
            'isCreate' => true,
            'job_amounts' => Cache::remember('job_amounts', $seconds, function () {
                return JobAmounts::all();
            }),
            'job_statuses' => Cache::remember('job_statuses', $seconds, function () {
                return JobStatuses::all();
            }),
            'job_types' => Cache::remember('job_types', $seconds, function () {
                return JobTypes::all();
            }),
            'pea_staffs' => Cache::remember('pea_staffs', $seconds, function () {
                return PeaStaffs::all();
            }),
            'transformers' => Cache::remember('transformers', $seconds, function () {
                return Transformers::all();
            }),
            'requested_places' => Cache::remember('requested_places', $seconds, function () {
                return RequestedPlaces::all();
            })
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
        $request_meter = $request->get('meters');
        $meter = Meters::create($request_meter);

        JobStatusDurations::create([
            'meter_id' => $meter->id,
            'job_status_id' => $request_meter['job_status_id']
        ]);

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

        $meter_edit_url = route('meters.edit', $meter);

        $over_report = [
            'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                'job_status_id' => 0
            ]),
            'job_status_avg' => MeterHelper::getStatusAverageDay(0, $meter->id)
        ];

        $job_status_report = [
            'wait_for_action' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 1
                ]),
                'avg' => MeterHelper::getStatusAverageDay(1, $meter->id),
                'color' => 'success'
            ],
            'survey' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 2
                ]),
                'avg' => MeterHelper::getStatusAverageDay(2, $meter->id),
                'color' => 'info'
            ],
            'estimate' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 3
                ]),
                'avg' => MeterHelper::getStatusAverageDay(3, $meter->id),
                'color' => 'warning'
            ],
            'approve' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 4
                ]),
                'avg' => MeterHelper::getStatusAverageDay(4, $meter->id),
                'color' => 'primary'
            ],
            'payment' => [
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 5
                ]),
                'avg' => MeterHelper::getStatusAverageDay(5, $meter->id),
                'color' => 'danger'
            ]
        ];

        $seconds = 24 * 60 * 60;

        return view('meters.edit', [
            'isCreate' => false,
            'meter' => $meter,

            'job_amounts' => Cache::remember('job_amounts', $seconds, function () {
                return JobAmounts::all();
            }),
            'job_statuses' => Cache::remember('job_statuses', $seconds, function () {
                return JobStatuses::all();
            }),
            'job_types' => Cache::remember('job_types', $seconds, function () {
                return JobTypes::all();
            }),
            'pea_staffs' => Cache::remember('pea_staffs', $seconds, function () {
                return PeaStaffs::all();
            }),
            'transformers' => Cache::remember('transformers', $seconds, function () {
                return Transformers::all();
            }),
            'requested_places' => Cache::remember('requested_places', $seconds, function () {
                return RequestedPlaces::all();
            }),


            'geos' => Cache::remember('geos', $seconds, function () {
                return Geos::all();
            }),
            'env_earths' => Cache::remember('env_earths', $seconds, function () {
                return EnvEarths::all();
            }),
            'env_trees' => Cache::remember('env_trees', $seconds, function () {
                return EnvTrees::all();
            }),
            'reserved_forests' => Cache::remember('reserved_forests', $seconds, function () {
                return ReservedForests::all();
            }),
            'env_communities' => Cache::remember('env_communities', $seconds, function () {
                return EnvCommunities::all();
            }),
            'stations' => Cache::remember('stations', $seconds, function () {
                return Stations::all();
            }),

            'over_report' => $over_report,
            'job_status_report' => $job_status_report
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

        if ((int)$request_meter['job_status_id'] !== $meter->job_status_id) {
            $jobStatusDurations = JobStatusDurations::where('meter_id', $meter->id)
                ->orderBy('id', 'desc')
                ->first();

            if ($jobStatusDurations) {
                $duration = $jobStatusDurations->created_at->diffInSeconds(now());
                $jobStatusDurations->update([
                    'duration' => $duration
                ]);
            }

            JobStatusDurations::create([
                'meter_id' => $meter->id,
                'job_status_id' => $request_meter['job_status_id']
            ]);
        }

        $request_meter['has_payment'] = $request_meter['has_payment'] ?? 0;
        $request_meter['paid'] = $request_meter['paid'] ?? 0;

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
