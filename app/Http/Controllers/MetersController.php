<?php

namespace App\Http\Controllers;

use App\Helpers\MeterHelper;
use App\Http\Requests\StoreMeterRequest;
use App\Http\Requests\UpdateMeterRequest;
use App\Models\ElectricExpands;
use App\Models\EnvCommunities;
use App\Models\EnvEarths;
use App\Models\EnvTrees;
use App\Models\Geos;
use App\Models\JobAmounts;
use App\Models\JobStatusDurations;
use App\Models\JobStatuses;
use App\Models\JobTypes;
use App\Models\MeterExtraGroups;
use App\Models\MeterExtraKeys;
use App\Models\Meters;
use App\Models\PaymentRates;
use App\Models\PeaStaffs;
use App\Models\RequestedPlaces;
use App\Models\ReservedForests;
use App\Models\Stations;
use App\Models\Transformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MetersController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $pageSize = (int)$request->query('page_size', 10);
        $search = (string)$request->query('search', '');

        $meters = Meters::with(['job_type', 'job_status', 'job_amount', 'transformer', 'pea_staff']);

        if (!$request->has('sort')) {
            $meters->orderBy('id', 'desc');
        }

        $is_filter_empty = true;
        if ($meters_filter = session('meters-filter')) {
            foreach ($meters_filter as $key => $values) {
                $value = $values['value'] ?? null;
                $operator = $values['operator'] ?? '=';
                if ($value) {
                    $is_filter_empty = false;
                    $meters->where("meters.$key", $operator, $value);
                }
            }
        }

        if ($is_filter_empty) {
            session()->forget('meters-filter');
        }

        if ($search) {
            $meters
                ->where('meters.document_number', 'like', '%' . $search . '%')
                ->orWhere('meters.customer_name', 'like', '%' . $search . '%')
                ->orWhere('meters.job_number', 'like', '%' . $search . '%')
                ->orWhere('meters.customer_phone', 'like', '%' . $search . '%')
                ->orWhereHas('job_status', function ($query) use ($search) {
                    return $query->where('description', 'like', '%' . $search . '%');
                })
                ->orWhereHas('pea_staff', function ($query) use ($search) {
                    return $query->where('name', 'like', '%' . $search . '%');
                });
        }

        if ($request->has('job_status_id') && $job_status_id = $request->get('job_status_id')) {
            $meters->where('job_status_id', $job_status_id);
        }

        if ($request->get('quotation_overdue')) {
            $meters->where('expires_quote_date', '<', now())->where('job_status_id', 4);
        }

        $meter_index_url = route('meters.index');

        $raw_job_amounts_job_statuses = <<<SQL
(
    SELECT `job_amounts_id`, SUM(`standard_duration`) AS `sum_standard_duration`
    FROM `job_amounts_job_statuses` 
    WHERE `job_statuses_id` < 5
    GROUP BY `job_amounts_id`
) AS sd
SQL;
        $raw_job_status_durations = <<<SQL
(
    SELECT `meter_id`, SUM(CEILING(`duration` / 60 / 60 / 24)) AS `sum_job_duration`
    FROM `job_status_durations`
    WHERE `job_status_id` < 5
    GROUP BY `meter_id`
) AS jd
SQL;

        $overdueCount = Meters::query()
            ->leftJoin(
                DB::raw($raw_job_amounts_job_statuses),
                'meters.job_amount_id',
                '=',
                'sd.job_amounts_id'
            )
            ->leftJoin(
                DB::raw($raw_job_status_durations),
                'meters.id',
                '=',
                'jd.meter_id'
            )
            ->where('job_status_id', '<', 5)
            ->whereRaw('jd.`sum_job_duration` IS NOT NULL AND jd.`sum_job_duration` > sd.`sum_standard_duration`')
            ->count();

        if ($request->get('overdue')) {
            $meters
                ->leftJoin(
                    DB::raw($raw_job_amounts_job_statuses),
                    'meters.job_amount_id',
                    '=',
                    'sd.job_amounts_id'
                )
                ->leftJoin(
                    DB::raw($raw_job_status_durations),
                    'meters.id',
                    '=',
                    'jd.meter_id'
                )
                ->where('job_status_id', '<', 5)
                ->whereRaw('jd.`sum_job_duration` IS NOT NULL AND jd.`sum_job_duration` > sd.`sum_standard_duration`');
        }

        $over_report = [
            'job_status_url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                'job_status_id' => 0
            ]),
            'count' => Meters::count(),
            'job_status_avg' => MeterHelper::getStatusAverageDay(0),

            'overdue' => $overdueCount,
            'overdue_url' => route('meters.index', ['overdue' => 1]),

            'overdue_quotation' => Meters::where('expires_quote_date', '<', now())->where('job_status_id', 4)->count(),
            'overdue_quotation_url' => route('meters.index', ['quotation_overdue' => 1]),
            'color' => 'danger'
        ];

        $job_status_report = [
            'wait_for_action' => [
                'id' => 1,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 1
                ]),
                'count' => (clone $meters)->where('job_status_id', 1)->count(),
                'avg' => MeterHelper::getStatusAverageDay(1),
                'color' => 'success'
            ],
            'survey' => [
                'id' => 2,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 2
                ]),
                'count' => (clone $meters)->where('job_status_id', 2)->count(),
                'avg' => MeterHelper::getStatusAverageDay(2),
                'color' => 'info'
            ],
            'estimate' => [
                'id' => 3,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 3
                ]),
                'count' => (clone $meters)->where('job_status_id', 3)->count(),
                'avg' => MeterHelper::getStatusAverageDay(3),
                'color' => 'warning'
            ],
            'approve' => [
                'id' => 4,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 4
                ]),
                'count' => (clone $meters)->where('job_status_id', 4)->count(),
                'avg' => MeterHelper::getStatusAverageDay(4),
                'color' => 'primary'
            ],
            'payment' => [
                'id' => 5,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 5
                ]),
                'count' => (clone $meters)->where('job_status_id', 5)->count(),
                'avg' => MeterHelper::getStatusAverageDay(5),
                'color' => 'danger'
            ],
            'wait_for_paper' => [
                'id' => 98,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_index_url, [
                    'job_status_id' => 98
                ]),
                'count' => (clone $meters)->where('job_status_id', 98)->count(),
                'avg' => MeterHelper::getStatusAverageDay(98),
                'color' => 'warning'
            ]
        ];

        $seconds = 24 * 60 * 60;

        return view('meters.index', [
            'meters' => $meters->sortable()->paginate($pageSize),
            'meterCount' => Meters::count(),
            'pageSize' => $pageSize,
            'search' => $search,
            'over_report' => $over_report,
            'job_status_report' => $job_status_report,
            'pea_staffs' => Cache::remember('pea_staffs', $seconds, function () {
                return PeaStaffs::all();
            }),
            'job_statuses' => Cache::remember('job_statuses', $seconds, function () {
                return JobStatuses::all();
            })
        ]);
    }

    public function create()
    {
        $seconds = 24 * 60 * 60;

        $job_statuses = JobStatuses::where('id', 1)->get();

        return view('meters.edit', [
            'isCreate' => true,
            'job_amounts' => Cache::remember('job_amounts', $seconds, function () {
                return JobAmounts::all();
            }),
            'job_statuses' => $job_statuses,
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

    public function store(StoreMeterRequest $request)
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

    public function show(Meters $meters)
    {
        //
    }

    public function edit(Meters $meter)
    {
        $meter->with(['job_type', 'job_status', 'job_amount', 'transformer', 'pea_staff', 'electric_expand']);

        $meter_edit_url = route('meters.edit', $meter);

        $over_report = [
            'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                'job_status_id' => 0
            ]),
            'job_status_avg' => MeterHelper::getStatusAverageDay(0, $meter)
        ];

        $job_status_report = [
            'wait_for_action' => [
                'id' => 1,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 1
                ]),
                'avg' => MeterHelper::getStatusAverageDay(1, $meter),
                'color' => 'success',
                'standard_days' => 3,
                'payment' => false
            ],
            'survey' => [
                'id' => 2,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 2
                ]),
                'avg' => MeterHelper::getStatusAverageDay(2, $meter),
                'color' => 'info',
                'standard_days' => 3,
                'payment' => false
            ],
            'estimate' => [
                'id' => 3,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 3
                ]),
                'avg' => MeterHelper::getStatusAverageDay(3, $meter),
                'color' => 'warning',
                'standard_days' => 2,
                'payment' => false
            ],
            'approve' => [
                'id' => 4,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 4
                ]),
                'avg' => MeterHelper::getStatusAverageDay(4, $meter),
                'color' => 'primary',
                'standard_days' => 3,
                'payment' => false
            ],
            'payment' => [
                'id' => 5,
                'url' => MeterHelper::buildJobStatusFilterUrl($meter_edit_url, [
                    'job_status_id' => 5
                ]),
                'avg' => MeterHelper::getStatusAverageDay(5, $meter),
                'color' => 'danger',
                'standard_days' => 3,
                'payment' => true
            ]
        ];

        $seconds = 24 * 60 * 60;

        Cache::forget('job_statuses');
        Cache::forget('pea_staffs');

        if (!empty($meter->job_status_id)) {
            $job_status_id = $meter->job_status_id;
            $job_statuses = JobStatuses::where(function ($query) use ($job_status_id) {
                $query->whereIn('id', [
                    $job_status_id,
                    $job_status_id + 1
                ]);
                switch ($job_status_id) {
                    case 1:
                    case 2:
                    case 3:
                        $query->orWhere('id', 98);
                        break;
                    case 98:
                        $query->orWhere('id', '<=', 3);
                        break;
                    case 99:
                        break;
                }
            })
                ->orWhere('id', 99)
                ->get();
        } else {
            $job_statuses = JobStatuses::whereIn('id', [1, 99])->get();
        }

        $standardDurations = [];
        foreach (JobAmounts::all(['id']) as $jobAmount) {
            foreach ($jobAmount->jobStatuses()->get() as $jobStatus) {
                $standardDurations[$jobAmount->id][$jobStatus->id] = $jobStatus->pivot->standard_duration;
            }
        }

        return view('meters.edit', [
            'isCreate' => false,
            'meter' => $meter,
            'meter_extra' => $meter->meter_extra_keys(),

            'job_amounts' => Cache::remember('job_amounts', $seconds, function () {
                return JobAmounts::all();
            }),
            'job_statuses' => $job_statuses,
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
            'job_status_report' => $job_status_report,

            'payment_rates' => PaymentRates::all(),

            'standardDurations' => $standardDurations
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function update(UpdateMeterRequest $request, Meters $meter)
    {
        // Extra validation for update unique.
        $validation = Validator::make($request->all(), [
            'meters.document_number' => 'unique:meters,document_number,' . $meter->id
        ]);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

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

        $request_meter['has_payment'] = !empty($request_meter['has_payment'])? (int)$request_meter['has_payment'] : 0;
        $request_meter['paid'] = $request_meter['paid'] ?? 0;

        $meter->update($request_meter);
        $electric_expands->update($request_electric_expands);


        if ($request->has('meter_extra') && $request_meter_extra = $request->get('meter_extra')) {
            MeterExtraKeys::where('meter_id', $meter->id)->delete();
            foreach ($request_meter_extra as $key_name => $key_value) {
                if ($key_value) {
                    MeterExtraKeys::insert([
                        'meter_id' => $meter->id,
                        'key_name' => $key_name,
                        'key_value' => $key_value
                    ]);
                }
            }
        }

        if ($request->has('meter_extra_keys') && $request_meter_extra_keys = $request->get('meter_extra_keys')) {
            $data = [];
            foreach ($request_meter_extra_keys as $group_name => $group_list) {
                foreach ($group_list as $group_id => $key_list) {
                    foreach ($key_list as $key_name => $key_value) {
                        if ($key_value) {
                            $data[] = [
                                'meter_id' => $meter->id,
                                'group_name' => $group_name,
                                'group_id' => $group_id,
                                'key_name' => $key_name,
                                'key_value' => $key_value
                            ];
                        }
                    }
                }
            }

            if ($data) {
                MeterExtraGroups::where('meter_id', $meter->id)->delete();
                MeterExtraGroups::insert($data);
            }
        }

        return back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function destroy(Meters $meters)
    {
        //
    }
}
