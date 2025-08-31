<div class="form-group row align-items-center" :class="{'has-danger': errors.has('province_id'), 'has-success': fields.province_id && fields.province_id.valid }">
    <label for="province_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.province.columns.province_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.province_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('province_id'), 'form-control-success': fields.province_id && fields.province_id.valid}" id="province_id" name="province_id" placeholder="{{ trans('admin.province.columns.province_id') }}">
        <div v-if="errors.has('province_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('province_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('province'), 'has-success': fields.province && fields.province.valid }">
    <label for="province" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.province.columns.province') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.province" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('province'), 'form-control-success': fields.province && fields.province.valid}" id="province" name="province" placeholder="{{ trans('admin.province.columns.province') }}">
        <div v-if="errors.has('province')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('province') }}</div>
    </div>
</div>


