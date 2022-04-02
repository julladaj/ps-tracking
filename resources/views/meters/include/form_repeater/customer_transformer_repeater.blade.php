<div id="customer_transformer_repeater">
    <div data-repeater-list="meter_extra_keys[customer_transformer]">
        @forelse($meter->meter_extra_groups('customer_transformer') as $data)
            <div class="row mt-1" data-repeater-item>
                <div class="col-md-2 text-right vertical-middle">
                    <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/ติดตั้ง</code> <label>หม้อแปลง ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="transformer_size" placeholder="คอร. ขนาด" value="{{ $data['transformer_size']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">เควีเอ.</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>ระบบ</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <select class="form-control" name="phase">
                        <option value="1" {{ (isset($data['phase']) && $data['phase'] === '1')? 'selected':'' }}>1 เฟส</option>
                        <option value="3" {{ (isset($data['phase']) && $data['phase'] === '3')? 'selected':'' }}>3 เฟส</option>
                    </select>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>จำนวน</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" placeholder="เครื่อง" value="{{ $data['quantity']?? 0 }}">
                            <div class="input-group-append">
                                <span class="input-group-text">เครื่อง</span>
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
                    <code><i class="cursor-pointer bx bx-map text-muted align-middle"></i> รื้อถอน/ติดตั้ง</code> <label>หม้อแปลง ขนาด</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="transformer_size" placeholder="คอร. ขนาด" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">เควีเอ.</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>ระบบ</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <select class="form-control" name="phase">
                        <option value="1">1 เฟส</option>
                        <option value="3">3 เฟส</option>
                    </select>
                </div>
                <div class="col-md-1 text-right vertical-middle">
                    <label>จำนวน</label>
                </div>
                <div class="col-md-2 form-group vertical-middle">
                    <fieldset>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" placeholder="เครื่อง" value="0">
                            <div class="input-group-append">
                                <span class="input-group-text">เครื่อง</span>
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