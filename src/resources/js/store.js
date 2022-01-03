import './bootstrap';

const store = Vuex.createStore({
    modules: {
        // businessReport: require('@/js/new/modules/backend/businessReport/businessReport').default,
        // businessReportRule: require('@/js/new/modules/backend/businessReport/businessReportRule').default,
        // statisticalReport: require('@/js/new/modules/backend/ginbao/statisticalReport.js').default,
    },
});

export default store;
