@if(!$isCreate)
    @if($meter->job_status_id >= 4)
        <div class="wizard">
            <div class="steps clearfix">
                <ul role="tablist">
                    @foreach($job_status_report as $key => $value)
                        @if ($value['payment'] === true)
                            <li role="tab"
                                class="{{ ($value['id'] === 4)? 'first' : '' }} {{ ($value['id'] === 5)? 'last' : '' }} {{ ($value['avg'] > $value['standard_days'])? 'overdue' : '' }} {{ ($is_current = ($meter->job_status_id === $value['id']))? 'current' : '' }} {{ ($is_pass = ($meter->job_status_id > $value['id']))? 'done' : '' }} {{ (!$is_current && !$is_pass)? 'disabled' : '' }}"
                                aria-disabled="{{ ($meter->job_status_id >= $value['id'])? 'false' : 'true' }}"
                                aria-selected="{{ ($meter->job_status_id >= $value['id'])? 'true' : 'false' }}"
                            >
                                <a id="steps-uid-3-t-{{ $value['id'] }}"
                                   href="#steps-uid-3-h-{{ $value['id'] }}"
                                   aria-controls="steps-uid-3-p-{{ $value['id'] }}"
                                >
                                    <span class="step"><i class="@if ($is_current) step-icon bx bx-time-five @elseif($meter->job_status_id > $value['id']) step-icon bx-check-circle bx @else step-icon @endif"></i></span>
                                    <span>{{ __('meter.job_status.' . $key) }} {{ $value['avg'] }} วัน</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-body">
                        <input type="hidden" name="meters[electric_expand_id]" value="{{ $meter->electric_expand_id?? 0 }}">
                        <div class="alert bg-rgba-primary mt-1 p-1">
                            <h4 class="text-primary">รายละเอียด</h4>
                            <p class="m-0">ขออนุมัติ<code class="highlighter-rouge">ขยายเขต/ย้ายแนว</code>ระบบจำหน่ายไฟฟ้า</p>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ชื่องาน</label>
                            </div>
                            <div class="col-md-10 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[job_name]" placeholder="ชื่องาน" value="{{ $meter->electric_expand->job_name?? old('electric_expands.job_name') }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>สถานที่ใช้ไฟฟ้า</label>
                            </div>
                            <div class="col-md-10 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[location]" placeholder="สถานที่ใช้ไฟฟ้า" value="{{ $meter->electric_expand->location?? old('electric_expands.location') }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ลักษณะการใช้พลังงานไฟฟ้า</label>
                            </div>
                            <div class="col-md-10 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[consumer_type]" placeholder="ลักษณะการใช้พลังงานไฟฟ้า"
                                       value="{{ $meter->electric_expand->consumer_type?? old('electric_expands.consumer_type') }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>สภาพภูมิประเทศ</label>
                            </div>
                            <div class="col-md-10 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[geo_id]">
                                    @forelse($geos as $geo)
                                        <option value="{{ $geo->id }}" {{ ((isset($meter->electric_expand->geo_id) && $meter->electric_expand->geo_id === $geo->id) || old('electric_expands.geo_id') === $geo->id)? 'selected':'' }}>{{ $geo->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>สภาพพื้นดิน</label>
                            </div>
                            <div class="col-md-10 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[env_earth_id]">
                                    @forelse($env_earths as $env_earth)
                                        <option value="{{ $env_earth->id }}" {{ ((isset($meter->electric_expand->env_earth_id) && $meter->electric_expand->env_earth_id === $env_earth->id) || old('electric_expands.env_earth_id') === $env_earth->id)? 'selected':'' }}>{{ $env_earth->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>สภาพต้นไม้ตามแนวขยายเขต</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[env_tree_id]">
                                    @forelse($env_trees as $env_tree)
                                        <option value="{{ $env_tree->id }}" {{ ((isset($meter->electric_expand->env_tree_id) && $meter->electric_expand->env_tree_id === $env_tree->id) || old('electric_expands.env_tree_id') === $env_tree->id)? 'selected':'' }}>{{ $env_tree->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-2 form-group vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="electric_expands[env_tree_distant_km]" placeholder="กิโลเมตร" aria-describedby="env_tree_distant_km"
                                               value="{{ $meter->electric_expand->env_tree_distant_km?? old('electric_expands.env_tree_distant_km') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="env_tree_distant_km">กม.</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-1 text-right vertical-middle">
                                <label>ป่าสงวน</label>
                            </div>
                            <div class="col-md-3 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[reserved_forest_id]">
                                    @forelse($reserved_forests as $reserved_forest)
                                        <option value="{{ $reserved_forest->id }}" {{ ((isset($meter->electric_expand->reserved_forest_id) && $meter->electric_expand->reserved_forest_id === $reserved_forest->id) || old('electric_expands.reserved_forest_id') === $reserved_forest->id)? 'selected':'' }}>{{ $reserved_forest->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>นำรถยนต์เข้าปฏิบัติงาน</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[working_with_car]" placeholder="นำรถยนต์เข้าปฏิบัติงาน"
                                       value="{{ $meter->electric_expand->working_with_car?? old('electric_expands.working_with_car') }}">
                            </div>
                            <div class="col-md-1 text-right vertical-middle">
                                <label>สภาพชุมชน</label>
                            </div>
                            <div class="col-md-5 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[env_community_id]">
                                    @forelse($env_communities as $env_community)
                                        <option value="{{ $env_community->id }}" {{ ((isset($meter->electric_expand->env_community_id) && $meter->electric_expand->env_community_id === $env_community->id) || old('electric_expands.env_community_id') === $env_community->id)? 'selected':'' }}>{{ $env_community->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>รับพลังงานไฟฟ้าจากหม้อแปลง PEA</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[transformer_pea_no]" placeholder="รับพลังงานไฟฟ้าจากหม้อแปลง PEA"
                                       value="{{ $meter->electric_expand->transformer_pea_no?? old('electric_expands.transformer_pea_no') }}">
                            </div>
                            <div class="col-md-1 text-right vertical-middle">
                                <label>ขนาด</label>
                            </div>
                            <div class="col-md-1 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[transformer_id]">
                                    @forelse($transformers as $transformer)
                                        <option value="{{ $transformer->id }}" {{ ((isset($meter->electric_expand->transformer_id) && $meter->electric_expand->transformer_id === $transformer->id) || old('electric_expands.transformer_id') === $transformer->id)? 'selected':'' }}>{{ $transformer->description }}
                                            kVA
                                        </option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-1 text-right vertical-middle">
                                <label>ระบบ</label>
                            </div>
                            <div class="col-md-3 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[transformer_type]" placeholder="ระบบ" value="{{ $meter->electric_expand->transformer_type?? old('electric_expands.transformer_type') }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>โวลท์ จากสถานี</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <select class="form-control" name="electric_expands[station_id]">
                                    @forelse($stations as $station)
                                        <option value="{{ $station->id }}" {{ ((isset($meter->electric_expand->station_id) && $meter->electric_expand->station_id === $station->id) || old('electric_expands.station_id') === $station->id)? 'selected':'' }}>{{ $station->description }}</option>
                                    @empty
                                        <option></option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-1 text-right vertical-middle">
                                <label>ฟีดเดอร์</label>
                            </div>
                            <div class="col-md-1 form-group vertical-middle">
                                <input type="text" class="form-control" name="electric_expands[feeder]" placeholder="ฟีดเดอร์" value="{{ $meter->electric_expand->feeder?? old('electric_expands.feeder') }}">
                            </div>
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ระยะห่างจากสถานีตามระบบจำหน่าย</label>
                            </div>
                            <div class="col-md-2 form-group vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="electric_expands[feeder_distant_km]" placeholder="กิโลเมตร" aria-describedby="feeder_distant_km"
                                               value="{{ $meter->electric_expand->feeder_distant_km?? old('electric_expands.feeder_distant_km') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="feeder_distant_km">กม.</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <hr>

                        <div class="alert bg-rgba-primary mt-1 p-1">
                            <h4 class="text-primary">ส่วนของ กฟภ. ดำเนินการ</h4>
                            <p class="m-0">แผนก<code class="highlighter-rouge">แรงสูง</code></p>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ระบบ</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <select class="form-control" name="high_voltage[phase]">
                                    <option value="1" {{ ((isset($meter->high_voltage->phase) && $meter->high_voltage->phase === 1) || old('high_voltage.phase') === 1)? 'selected':'' }}>1 เฟส</option>
                                    <option value="3" {{ ((isset($meter->high_voltage->phase) && $meter->high_voltage->phase === 3) || old('high_voltage.phase') === 3)? 'selected':'' }}>3 เฟส</option>
                                </select>
                            </div>
                            <div class="col-md-2 text-right vertical-middle">
                                <label>แรงดัน</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="high_voltage[voltage]" placeholder="แรงดัน" aria-describedby="high_voltage_voltage" value="{{ $meter->high_voltage->voltage?? old('high_voltage.voltage') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="high_voltage_voltage">เควี</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        {{-- REPEATER - START --}}
                        <div id="high_voltage_pole_repeater">
                            <div data-repeater-list="meter_extra_keys[high_voltage_pole]">
                                @foreach($meter->meter_extra_keys('high_voltage_pole') as $data)
                                    <div class="row mt-1" data-repeater-item>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/ปักเสา</code>
                                        </div>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>คอร. ขนาด</label>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="core_size" placeholder="คอร. ขนาด" value="{{ $data['core_size']?? 0 }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">เมตร</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>จำนวน</label>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="quantity" placeholder="จำนวน" value="{{ $data['quantity']?? 0 }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">ต้น</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                                            <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-1" data-repeater-item>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/ปักเสา</code>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>คอร. ขนาด</label>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="core_size" placeholder="คอร. ขนาด" value="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">เมตร</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>จำนวน</label>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="quantity" placeholder="จำนวน" value="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">ต้น</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                                        <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- REPEATER - END --}}

                        {{-- REPEATER - START --}}
                        <div id="high_voltage_cable_repeater">
                            <div data-repeater-list="meter_extra_keys[high_voltage_cable]">
                                @foreach($meter->meter_extra_keys('high_voltage_cable') as $data)
                                    <div class="row mt-1" data-repeater-item>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/พาดสาย</code>
                                        </div>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>แรงสูงด้วยสาย</label>
                                        </div>
                                        <div class="col-md-6 form-group vertical-middle">
                                            <input type="text" class="form-control" name="cable_type" placeholder="สาย" value="{{ $data['cable_type']?? '' }}">
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ขนาด</label>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="cable_size" placeholder="ขนาด" value="{{ $data['cable_size']?? 0 }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">ตร.มม.</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2 text-right vertical-middle">
                                            <label>ระยะทาง</label>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="length" placeholder="ระยะทาง" value="{{ $data['length']?? 0 }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">เมตร</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2 form-group vertical-middle">
                                            <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                                            <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-1" data-repeater-item>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/พาดสาย</code>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>แรงสูงด้วยสาย</label>
                                    </div>
                                    <div class="col-md-6 form-group vertical-middle">
                                        <input type="text" class="form-control" name="cable_type" placeholder="สาย" value="">
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ขนาด</label>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="cable_size" placeholder="ขนาด" value="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">ตร.มม.</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-2 text-right vertical-middle">
                                        <label>ระยะทาง</label>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <fieldset>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="length" placeholder="ระยะทาง" value="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">เมตร</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-2 form-group vertical-middle">
                                        <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                                        <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- REPEATER - END --}}

                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>เรียกเก็บจากผู้ใช้ไฟ</label>
                            </div>
                            <div class="col-md-4 vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox__input" id="has_payment" name="meters[has_payment]"
                                                           value="1" {{ ((isset($meter->has_payment) && $meter->has_payment) || old('meters.has_payment'))? 'checked':'' }}>
                                                    <label for="has_payment"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="meters[payment_request]" placeholder="เรียกเก็บจากผู้ใช้ไฟ" aria-describedby="payment_request"
                                               value="{{ $meter->payment_request?? old('meters.payment_request') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="payment_request">บาท</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-2 text-right vertical-middle">
                                <label>กำหนดยืนราคา</label>
                            </div>
                            <div class="col-md-4 vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="meters[paid_credit_terms]" placeholder="กำหนดยืนราคา" aria-describedby="paid_credit_terms"
                                               value="{{ $meter->paid_credit_terms?? old('meters.paid_credit_terms') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="paid_credit_terms">เดือน</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ผู้ใช้ไฟได้ชำระ</label>
                            </div>
                            <div class="col-md-4 vertical-middle">
                                <fieldset>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox__input" id="paid" name="meters[paid]"
                                                           value="1" {{ ((isset($meter->paid) && $meter->paid) || old('meters.paid'))? 'checked':'' }}>
                                                    <label for="paid"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="meters[paid_amount]" placeholder="ผู้ใช้ไฟได้ชำระ" aria-describedby="paid_amount"
                                               value="{{ $meter->paid_amount?? old('meters.paid_amount') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="paid_amount">บาท</span>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ใบเสร็จรับเงินเลขที่</label>
                            </div>
                            <div class="col-md-4 vertical-middle">
                                <input type="text" class="form-control" name="meters[receive_no]" placeholder="ใบเสร็จรับเงินเลขที่" value="{{ $meter->receive_no?? old('meters.receive_no') }}">
                            </div>

                            <div class="col-md-2 text-right vertical-middle">
                                <label>ลงวันที่</label>
                            </div>
                            <div class="col-md-4 vertical-middle">
                                <input type="date" class="form-control" name="meters[receive_date]" placeholder="ลงวันที่" value="{{ $meter->receive_date?? old('meters.receive_date') }}" data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{ buddhismDate($meter->receive_date?? old('meters.receive_date')) }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-2 text-right vertical-middle">
                                <label>ผู้เสนอขออนุมัติ</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <select class="form-control" name="meters[request_approve_user_id]">
                                    <option></option>
                                    @forelse($pea_staffs as $pea_staff)
                                        <option value="{{ $pea_staff->id }}" {{ ((isset($meter->request_approve_user_id) && $meter->request_approve_user_id === $pea_staff->id) || old('meters.request_approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-md-2 text-right vertical-middle">
                                <label>ผู้อนุมัติ</label>
                            </div>
                            <div class="col-md-4 form-group vertical-middle">
                                <select class="form-control" name="meters[approve_user_id]">
                                    <option></option>
                                    @forelse($pea_staffs as $pea_staff)
                                        <option value="{{ $pea_staff->id }}" {{ ((isset($meter->approve_user_id) && $meter->approve_user_id === $pea_staff->id) || old('meters.approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-1">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
                                <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
                                <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script src="{{asset('vendors/js/forms/repeater/jquery.repeater.custom.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@push('scripts')
    <script>
        $(document).ready(function () {

            $('#high_voltage_pole_repeater, #high_voltage_cable_repeater').repeater({
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

        });
    </script>
@endpush