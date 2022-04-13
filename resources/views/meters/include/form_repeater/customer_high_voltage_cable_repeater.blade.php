<div id="customer_high_voltage_cable_repeater">
    <div data-repeater-list="meter_extra_keys[customer_high_voltage_cable]">
        @forelse($meter->meter_extra_groups('customer_high_voltage_cable') as $data)
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน" {{ ((isset($data['job_type']) && $data['job_type'] === 'รื้อถอน'))? 'selected':'' }}>รื้อถอน</option>
                        <option value="พาดสาย" {{ ((isset($data['job_type']) && $data['job_type'] === 'พาดสาย'))? 'selected':'' }}>พาดสาย</option>
                    </select>
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
                <div class="col-md-1 text-right vertical-middle">
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
        @empty
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน">รื้อถอน</option>
                        <option value="พาดสาย">พาดสาย</option>
                    </select>
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
                <div class="col-md-1 text-right vertical-middle">
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
        @endforelse
    </div>
</div>
<hr>