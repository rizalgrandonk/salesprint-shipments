import AppForm from '../app-components/Form/AppForm';

Vue.component('shipment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                awb:  '' ,
                courier:  '' ,
                service:  '' ,
                status:  '' ,
                desc:  '' ,
                amount:  '' ,
                weight:  '' ,
                origin:  '' ,
                destination:  '' ,
                shipper:  '' ,
                receiver:  '' ,
                
            }
        }
    }

});