require('./bootstrap');

window.moment = require('moment/moment.js');

Vue.component('prayers', require('./components/prayers/Prayer.vue'));

const app = new Vue({
    el: '#prayersSection'
});
