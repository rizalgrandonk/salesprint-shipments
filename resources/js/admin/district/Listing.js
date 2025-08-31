import AppListing from '../app-components/Listing/AppListing';

Vue.component('district-listing', {
    mixins: [AppListing],
    data() {
        return {
            populateLoading: false, // separate from table loading
        };
    },
    methods: {
        async populateDistricts(url) {
            this.populateLoading = true;

            try {
                await axios.post(url);
                this.$notify({ type: 'success', text: 'Populate Districts is started!' });
                this.loadData(); // reload table after success

                this.populateLoading = false;
            } catch (e) {
                console.log(e);
                this.$notify({ type: 'error', text: 'Failed to populate provinces!' });
                
                this.populateLoading = false;
            }
        }
    }
});