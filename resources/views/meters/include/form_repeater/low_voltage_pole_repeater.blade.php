<div id="low_voltage_pole_repeater">
    <div data-repeater-list="meter_extra_keys[low_voltage_pole]">
        @forelse($meter->meter_extra_groups('low_voltage_pole') as $data)
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน" {{ ((isset($data['job_type']) && $data['job_type'] === 'รื้อถอน'))? 'selected':'' }}>รื้อถอน</option>
                        <option value="ปักเสา" {{ ((isset($data['job_type']) && $data['job_type'] === 'ปักเสา'))? 'selected':'' }}>ปักเสา</option>
                    </select>
                    <label>คอร. ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cord_size" placeholder="คอร. ขนาด" value="{{ $data['cord_size']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">เมตร</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
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
        @empty
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <select class="form-control inline-fit" name="job_type">
                        <option value="รื้อถอน">รื้อถอน</option>
                        <option value="ปักเสา">ปักเสา</option>
                    </select>
                    <label>คอร. ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="cord_size" placeholder="คอร. ขนาด" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">เมตร</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>จำนวน</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" placeholder="จำนวน" value="0">
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
        @endforelse
    </div>
</div>
<hr>