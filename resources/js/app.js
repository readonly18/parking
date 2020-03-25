/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VuePagination from './components/pagination.vue';
import axios from 'axios';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

Vue.component(
    'example-component',
    require('./components/ExampleComponent.vue').default
);

const  app = new Vue({
    el: '#app',
    data: {
        clientsAutos: {
            total: 0,
            per_page: 15,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 15,
    },
    mounted() {
        this.getPagination();
    },
    components: {
        VuePagination,
    },
    methods: {
        getPagination() {
            axios.get(`/clients/autos?page=${this.clientsAutos.current_page}`)
                .then((response) => {
                    this.clientsAutos = response.data;
                })
                .catch(() => {
                    console.log('handle server error from here');
                });
        }
    }
});
