<div class="form-group row align-items-center" :class="{'has-danger': errors.has('province_id'), 'has-success': fields.province_id && fields.province_id.valid }">
    <label for="province_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.province_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.province_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('province_id'), 'form-control-success': fields.province_id && fields.province_id.valid}" id="province_id" name="province_id" placeholder="{{ trans('admin.district.columns.province_id') }}">
        <div v-if="errors.has('province_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('province_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('province'), 'has-success': fields.province && fields.province.valid }">
    <label for="province" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.province') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.province" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('province'), 'form-control-success': fields.province && fields.province.valid}" id="province" name="province" placeholder="{{ trans('admin.district.columns.province') }}">
        <div v-if="errors.has('province')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('province') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('city_id'), 'has-success': fields.city_id && fields.city_id.valid }">
    <label for="city_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.city_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.city_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('city_id'), 'form-control-success': fields.city_id && fields.city_id.valid}" id="city_id" name="city_id" placeholder="{{ trans('admin.district.columns.city_id') }}">
        <div v-if="errors.has('city_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('city_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('city_name'), 'has-success': fields.city_name && fields.city_name.valid }">
    <label for="city_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.city_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.city_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('city_name'), 'form-control-success': fields.city_name && fields.city_name.valid}" id="city_name" name="city_name" placeholder="{{ trans('admin.district.columns.city_name') }}">
        <div v-if="errors.has('city_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('city_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('district_id'), 'has-success': fields.district_id && fields.district_id.valid }">
    <label for="district_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.district_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.district_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('district_id'), 'form-control-success': fields.district_id && fields.district_id.valid}" id="district_id" name="district_id" placeholder="{{ trans('admin.district.columns.district_id') }}">
        <div v-if="errors.has('district_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('district_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('district_name'), 'has-success': fields.district_name && fields.district_name.valid }">
    <label for="district_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.district.columns.district_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.district_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('district_name'), 'form-control-success': fields.district_name && fields.district_name.valid}" id="district_name" name="district_name" placeholder="{{ trans('admin.district.columns.district_name') }}">
        <div v-if="errors.has('district_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('district_name') }}</div>
    </div>
</div>


