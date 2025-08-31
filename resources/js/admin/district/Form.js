import AppForm from '../app-components/Form/AppForm';

Vue.component('district-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                province_id:  '' ,
                province:  '' ,
                city_id:  '' ,
                city_name:  '' ,
                district_id:  '' ,
                district_name:  '' ,
                
            }
        }
    }

});