<!-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('awb'), 'has-success': fields.awb && fields.awb.valid }">
    <label for="awb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.awb') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.awb" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('awb'), 'form-control-success': fields.awb && fields.awb.valid}" id="awb" name="awb" placeholder="{{ trans('admin.shipment.columns.awb') }}">
        <div v-if="errors.has('awb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('awb') }}</div>
    </div>
</div> -->

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('courier'), 'has-success': fields.courier && fields.courier.valid }">
    <label for="courier" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.courier') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.courier" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('courier'), 'form-control-success': fields.courier && fields.courier.valid}" id="courier" name="courier" placeholder="{{ trans('admin.shipment.columns.courier') }}">
        <option value="">Select Value</option>
            <option value="jne">JNE</option>
            <option value="sicepat">SiCepat</option>
            <option value="jnt">J&T</option>
        </select>
        <div v-if="errors.has('courier')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('courier') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('service'), 'has-success': fields.service && fields.service.valid }">
    <label for="service" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.service') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.service" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('service'), 'form-control-success': fields.service && fields.service.valid}" id="service" name="service" placeholder="{{ trans('admin.shipment.columns.service') }}">
            <option value="">Select Value</option>
            <option value="Regular">Regular</option>
            <option value="Cargo">Cargo</option>
        </select>
        <div v-if="errors.has('service')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('service') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <label for="status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.status" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('status'), 'form-control-success': fields.status && fields.status.valid}" id="status" name="status" placeholder="{{ trans('admin.shipment.columns.status') }}">
            <option value="">Select Value</option>
            <option value="ON_DELIVERY">On Devlivery</option>
            <option value="DELIVERED">Delivered</option>
        </select>
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('desc'), 'has-success': fields.desc && fields.desc.valid }">
    <label for="desc" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.desc') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.desc" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('desc'), 'form-control-success': fields.desc && fields.desc.valid}" id="desc" name="desc" placeholder="{{ trans('admin.shipment.columns.desc') }}">
        <div v-if="errors.has('desc')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('desc') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': fields.amount && fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': fields.amount && fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.shipment.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('weight'), 'has-success': fields.weight && fields.weight.valid }">
    <label for="weight" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.weight') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.weight" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('weight'), 'form-control-success': fields.weight && fields.weight.valid}" id="weight" name="weight" placeholder="{{ trans('admin.shipment.columns.weight') }}">
        <div v-if="errors.has('weight')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('weight') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('origin'), 'has-success': fields.origin && fields.origin.valid }">
    <label for="origin" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.origin') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.origin" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('origin'), 'form-control-success': fields.origin && fields.origin.valid}" id="origin" name="origin" placeholder="{{ trans('admin.shipment.columns.origin') }}">
        <div v-if="errors.has('origin')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('origin') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('destination'), 'has-success': fields.destination && fields.destination.valid }">
    <label for="destination" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.destination') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.destination" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('destination'), 'form-control-success': fields.destination && fields.destination.valid}" id="destination" name="destination" placeholder="{{ trans('admin.shipment.columns.destination') }}">
        <div v-if="errors.has('destination')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('destination') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipper'), 'has-success': fields.shipper && fields.shipper.valid }">
    <label for="shipper" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.shipper') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipper" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipper'), 'form-control-success': fields.shipper && fields.shipper.valid}" id="shipper" name="shipper" placeholder="{{ trans('admin.shipment.columns.shipper') }}">
        <div v-if="errors.has('shipper')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipper') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('receiver'), 'has-success': fields.receiver && fields.receiver.valid }">
    <label for="receiver" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.receiver') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.receiver" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('receiver'), 'form-control-success': fields.receiver && fields.receiver.valid}" id="receiver" name="receiver" placeholder="{{ trans('admin.shipment.columns.receiver') }}">
        <div v-if="errors.has('receiver')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('receiver') }}</div>
    </div>
</div>


