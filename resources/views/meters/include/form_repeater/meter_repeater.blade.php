<div id="meter_repeater">
    <div data-repeater-list="meter_extra_keys[meter]">
        @forelse($meter->meter_extra_groups('meter') as $data)
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> ติดตั้ง</code> <label>มิเตอร์ ขนาด</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_size" placeholder="แอมป์" value="{{ $data['meter_size']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">แอมป์</span>
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
                <div class="col-md-2 text-right vertical-middle">
                    <label>ประกอบ</label>
                    <select class="form-control inline-fit" name="job_type">
                        <option value="ซีที.แรงต่ำ" {{ ((isset($data['job_type']) && $data['job_type'] === 'ซีที.แรงต่ำ'))? 'selected':'' }}>ซีที.แรงต่ำ</option>
                        <option value="ซีที." {{ ((isset($data['job_type']) && $data['job_type'] === 'ซีที.'))? 'selected':'' }}>ซีที.</option>
                        <option value="วีที.แรงสูง" {{ ((isset($data['job_type']) && $data['job_type'] === 'วีที.แรงสูง'))? 'selected':'' }}>วีที.แรงสูง</option>
                    </select>
                    <label>ขนาด</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_volt" placeholder="ขนาด" value="{{ $data['meter_volt']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">โวลท์</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_amp" placeholder="แอมป์" value="{{ $data['meter_amp']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">แอมป์</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>จำนวน</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" placeholder="จำนวน" value="{{ $data['quantity']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">เครื่อง</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                    <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                </div>
            </div>
        @empty
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> ติดตั้ง</code> <label>มิเตอร์ ขนาด</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_size" placeholder="แอมป์" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">แอมป์</span>
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
                <div class="col-md-2 text-right vertical-middle">
                    <label>ประกอบ</label><code>ซีที.แรงต่ำ/ซีที./วีที.แรงสูง</code> <label>ขนาด</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_volt" placeholder="ขนาด" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">โวลท์</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="meter_amp" placeholder="แอมป์" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">แอมป์</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>จำนวน</label>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" placeholder="จำนวน" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">เครื่อง</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 form-group vertical-middle">
                    <button class="btn btn-icon rounded-circle btn-primary" type="button" data-repeater-create><i class="bx bx-plus"></i></button>
                    <button class="btn btn-icon btn-danger rounded-circle" type="button" data-repeater-delete><i class="bx bx-x"></i></button>
                </div>
            </div>
        @endforelse
    </div>
</div>
<hr>