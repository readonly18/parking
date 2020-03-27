import ClientsAutosTable from "./components/ClientsAutosTable";
import AutoCreate from "./components/AutoCreate";
import AutoDelete from "./components/AutoDelete";
import ClientAutoCreate from "./components/ClientAutoCreate";
import ClientAutoUpdate from "./components/ClientAutoUpdate";

export  default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: ClientsAutosTable
        },
        {
            path: '/autos',
            component: AutoCreate
        },
        {
            path: '/autos/:id/delete',
            component: AutoDelete
        },
        {
            path: '/clients',
            component: ClientAutoCreate
        },
        {
            path: '/autos/:id/update',
            component: ClientAutoUpdate
        },
    ]
}
