import AppListing from '../app-components/Listing/AppListing';

Vue.component('province-listing', {
    mixins: [AppListing],
    data() {
        return {
            populateLoading: false, // separate from table loading
        };
    },
    methods: {
        async populateProvinces(url) {
            this.populateLoading = true;

            try {
                await axios.post(url);
                this.$notify({ type: 'success', text: 'Provinces populated successfully!' });
                this.loadData(); // reload table after success

                this.populateLoading = false;
            } catch (e) {
                console.log(e);
                this.$notify({ type: 'error', text: 'Failed to populate provinces!' });
                
                this.populateLoading = false;
            }
        },
        
        async populateCities(url) {
            try {
                await axios.post(url);
                this.$notify({ type: 'success', text: 'Cities populated successfully!' });
                this.loadData(); // reload table after success
            } catch (e) {
                console.log(e);
                this.$notify({ type: 'error', text: 'Failed to populate cities!' });
            }
        }
    }
});