import AppListing from '../app-components/Listing/AppListing';

Vue.component('city-listing', {
    mixins: [AppListing],
    data() {
        return {
            populateLoading: false, // separate from table loading
        };
    },
    methods: {
        async populateCities(url) {
            this.populateLoading = true;

            try {
                await axios.post(url);
                this.$notify({ type: 'success', text: 'Populate cities is started!' });
                this.loadData(); // reload table after success

                this.populateLoading = false;
            } catch (e) {
                console.log(e);
                this.$notify({ type: 'error', text: 'Failed to populate provinces!' });
                
                this.populateLoading = false;
            }
        },
        
        async populateDistricts(url) {
            try {
                await axios.post(url);
                this.$notify({ type: 'success', text: 'Districts populated successfully!' });
                this.loadData(); // reload table after success
            } catch (e) {
                console.log(e);
                this.$notify({ type: 'error', text: 'Failed to populate Districts!' });
            }
        }
    }
});