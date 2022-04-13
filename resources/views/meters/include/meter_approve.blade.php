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
        <div class="col-md-2 form-group vertical-middle">
            <select class="form-control" name="meter_extra[high_voltage_phase]">
                <option value="1" {{ ((isset($meter_extra['high_voltage_phase']) && $meter_extra['high_voltage_phase'] === '1') || old('meter_extra.high_voltage_phase') === '1')? 'selected':'' }}>1 เฟส</option>
                <option value="3" {{ ((isset($meter_extra['high_voltage_phase']) && $meter_extra['high_voltage_phase'] === '3') || old('meter_extra.high_voltage_phase') === '3')? 'selected':'' }}>3 เฟส</option>
            </select>
        </div>
        <div class="col-md-1 text-right vertical-middle">
            <label>แรงดัน</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[high_voltage]" placeholder="แรงดัน" aria-describedby="high_voltage_voltage" value="{{ $meter_extra['high_voltage']?? 22 }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="high_voltage_voltage">เควี</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.high_voltage_pole_repeater')
    {{-- REPEATER - END --}}

    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.high_voltage_cable_repeater')
    {{-- REPEATER - END --}}

    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ติดตั้งชุดบัคอาร์ม จำนวน</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[buc_arm]" placeholder="ชุดบัคอาร์ม" aria-describedby="high_voltage_buc_arm" value="{{ $meter_extra['buc_arm']?? old('meter_extra.buc_arm') }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="high_voltage_buc_arm">ชุด</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <hr>

    <div class="alert bg-rgba-primary mt-1 p-1">
        <p class="m-0">แผนก<code class="highlighter-rouge">หม้อแปลง</code></p>
    </div>
    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.transformer_repeater')
    {{-- REPEATER - END --}}

    <div class="alert bg-rgba-primary mt-1 p-1">
        <p class="m-0">แผนก<code class="highlighter-rouge">แรงต่ำ</code></p>
    </div>
    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.low_voltage_pole_repeater')
    {{-- REPEATER - END --}}

    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.low_voltage_cable_repeater')
    {{-- REPEATER - END --}}

    <div class="alert bg-rgba-primary mt-1 p-1">
        <p class="m-0">แผนก<code class="highlighter-rouge">มิเตอร์</code></p>
    </div>
    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.meter_repeater')
    {{-- REPEATER - END --}}

    <div class="alert bg-rgba-primary mt-1 p-1">
        <p class="m-0">แผนก<code class="highlighter-rouge">ไฟสาธารณะ</code></p>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <select class="form-control inline-fit" name="meter_extra[public_light_cable_type]">
                <option value="รื้อถอน" {{ ((isset($meter_extra['public_light_cable_type']) && $meter_extra['public_light_cable_type'] === 'รื้อถอน'))? 'selected':'' }}>รื้อถอน</option>
                <option value="พาด" {{ ((isset($meter_extra['public_light_cable_type']) && $meter_extra['public_light_cable_type'] === 'พาด'))? 'selected':'' }}>พาด</option>
            </select>
            <label>สายอลูมิเนียมหุ้มฉนวน ขนาด</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[public_light_cable_size]" placeholder="ขนาด" value="{{ $meter_extra['public_light_cable_size']?? 0 }}">
                    <div class="input-group-append">
                        <span class="input-group-text">ตร.มม.</span>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>ระยะทางประมาณ</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[public_light_cable_length]" placeholder="เมตร" value="{{ $meter_extra['public_light_cable_length']?? 0 }}">
                    <div class="input-group-append">
                        <span class="input-group-text">เมตร</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <select class="form-control inline-fit" name="meter_extra[public_light_lamp_type]">
                <option value="รื้อถอน" {{ ((isset($meter_extra['public_light_lamp_type']) && $meter_extra['public_light_lamp_type'] === 'รื้อถอน'))? 'selected':'' }}>รื้อถอน</option>
                <option value="ติดตั้ง" {{ ((isset($meter_extra['public_light_lamp_type']) && $meter_extra['public_light_lamp_type'] === 'ติดตั้ง'))? 'selected':'' }}>ติดตั้ง</option>
            </select>
            <label>ชุดโคมไฟ ขนาด</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[public_light_lamp_size]" placeholder="ขนาด" value="{{ $meter_extra['public_light_lamp_size']?? 0 }}">
                    <div class="input-group-append">
                        <span class="input-group-text">วัตต์</span>
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
                    <input type="number" class="form-control" name="meter_extra[public_light_lamp_quantity]" placeholder="ชุด" value="{{ $meter_extra['public_light_lamp_quantity']?? 0 }}">
                    <div class="input-group-append">
                        <span class="input-group-text">ชุด</span>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>สวิชต์ควบคุม จำนวน</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[public_light_lamp_switch_quantity]" placeholder="ชุด" value="{{ $meter_extra['public_light_lamp_switch_quantity']?? 0 }}">
                    <div class="input-group-append">
                        <span class="input-group-text">ชุด</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <hr>

    <div class="alert bg-rgba-warning mt-1 p-1">
        <h4 class="text-warning">ส่วนของผู้ใช้ไฟดำเนินการเอง</h4>
        <p class="m-0">แผนก<code class="highlighter-rouge">แรงสูง</code></p>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ระบบ</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <select class="form-control" name="meter_extra[customer_high_voltage_phase]">
                <option value="1" {{ ((isset($meter_extra['customer_high_voltage_phase']) && $meter_extra['customer_high_voltage_phase'] === '1') || old('meter_extra.customer_high_voltage_phase') === '1')? 'selected':'' }}>1 เฟส
                </option>
                <option value="3" {{ ((isset($meter_extra['customer_high_voltage_phase']) && $meter_extra['customer_high_voltage_phase'] === '3') || old('meter_extra.customer_high_voltage_phase') === '3')? 'selected':'' }}>3 เฟส
                </option>
            </select>
        </div>
        <div class="col-md-1 text-right vertical-middle">
            <label>แรงดัน</label>
        </div>
        <div class="col-md-2 form-group vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meter_extra[customer_high_voltage]" placeholder="แรงดัน" aria-describedby="customer_high_voltage_voltage"
                           value="{{ $meter_extra['customer_high_voltage']?? 22 }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="customer_high_voltage_voltage">เควี</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.customer_high_voltage_pole_repeater')
    {{-- REPEATER - END --}}

    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.customer_high_voltage_cable_repeater')
    {{-- REPEATER - END --}}

    <div class="alert bg-rgba-warning mt-1 p-1">
        <p class="m-0">แผนก<code class="highlighter-rouge">หม้อแปลง</code></p>
    </div>
    {{-- REPEATER - START --}}
    @include('meters.include.form_repeater.customer_transformer_repeater')
    {{-- REPEATER - END --}}

    <hr>

    <div class="row mt-1">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
            <a href="{{ route('meter-pdf', $meter->id) }}" target="_BLANK" class="btn btn-success mr-1"><i class="bx bx-printer"></i> พิมพ์แบบฟอร์ม</a>
            <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

{{-- vendor scripts --}}
@section('vendor-scripts')
    <script src="{{asset('vendors/js/forms/repeater/jquery.repeater.custom.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@push('scripts')
    <script>
        $(document).ready(function () {

            $('#high_voltage_pole_repeater, #high_voltage_cable_repeater, #transformer_repeater, #low_voltage_pole_repeater, #low_voltage_cable_repeater, #meter_repeater, #customer_high_voltage_pole_repeater, #customer_high_voltage_cable_repeater, #customer_transformer_repeater').repeater({
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