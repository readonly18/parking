import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

import VueClientsAutosTable from './components/ClientsAutosTable';

Vue.use(VueRouter);

const  app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    components : {
        'clients-autos-table' : VueClientsAutosTable,
        //'buttons-toolbar-create' : VueButtonsToolbarCreate,
    }
});
