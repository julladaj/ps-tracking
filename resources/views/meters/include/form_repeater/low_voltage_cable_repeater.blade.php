<div id="low_voltage_cable_repeater">
    <div data-repeater-list="meter_extra_keys[low_voltage_cable]">
        @forelse($meter->meter_extra_groups('low_voltage_cable') as $data)
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-3 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน" {{ ((isset($data['job_type']) && $data['job_type'] === 'รื้อถอน'))? 'selected':'' }}>รื้อถอน</option>
                        <option value="พาด" {{ ((isset($data['job_type']) && $data['job_type'] === 'พาด'))? 'selected':'' }}>พาด</option>
                    </select>
                    <label>สายอลูมิเนียม</label>
                    <select class="form-control inline-fit" name="cable_type">
                        <option value="เปลือย" {{ ((isset($data['cable_type']) && $data['cable_type'] === 'เปลือย'))? 'selected':'' }}>เปลือย</option>
                        <option value="หุ้มฉนวน" {{ ((isset($data['cable_type']) && $data['cable_type'] === 'หุ้มฉนวน'))? 'selected':'' }}>หุ้มฉนวน</option>
                    </select>
                    <label>ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cord_size" placeholder="คอร. ขนาด" value="{{ $data['cord_size']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">ตร.มม.</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>ระบบ</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <select class="form-control" name="phase">
                        <option value="1" {{ (isset($data['phase']) && $data['phase'] === '1')? 'selected':'' }}>1 เฟส</option>
                        <option value="3" {{ (isset($data['phase']) && $data['phase'] === '3')? 'selected':'' }}>3 เฟส</option>
                    </select>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>สายระยะทางประมาณ</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cable_length" placeholder="จำนวน" value="{{ $data['cable_length']?? 0 }}">
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
                <div class="col-md-3 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน">รื้อถอน</option>
                        <option value="พาด">พาด</option>
                    </select>
                    <label>สายอลูมิเนียม</label>
                    <select class="form-control inline-fit" name="cable_type">
                        <option value="เปลือย">เปลือย</option>
                        <option value="หุ้มฉนวน">หุ้มฉนวน</option>
                    </select>
                    <label>ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cord_size" placeholder="คอร. ขนาด" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">ตร.มม.</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>ระบบ</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <select class="form-control" name="phase">
                        <option value="1">1 เฟส</option>
                        <option value="3">3 เฟส</option>
                    </select>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>สายระยะทางประมาณ</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cable_length" placeholder="จำนวน" value="0">
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