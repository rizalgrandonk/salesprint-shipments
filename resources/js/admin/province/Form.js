import AppForm from '../app-components/Form/AppForm';

Vue.component('province-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                province_id:  '' ,
                province:  '' ,
                
            }
        }
    }

});