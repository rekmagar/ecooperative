/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
require('@coreui/coreui/dist/js/coreui.bundle.min');

window.Vue = require('vue').default;
import vuetify from './vuetify';
import router from './router';

import { VueMaskDirective } from 'v-mask'
Vue.directive('mask', VueMaskDirective);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('fyear-component', require('./components/FYearComponent.vue').default);
import Example from './components/ExampleComponent'
// mix.disableNotifications();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
    router,
    vuetify,
    // components: {
    //     'example-component': Example,
    // }
});
