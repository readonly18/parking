<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ФИО</th>
                <th scope="col">Авто</th>
                <th scope="col">Номер</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="clientAuto in clientsAutos.data">
                <td> {{ clientAuto.name }} </td>
                <td> {{ clientAuto.model }} </td>
                <td> {{ clientAuto.plate_number }} </td>
                <td> <button v-on:click="updateClientAuto(clientAuto.id)" type="button" class="btn btn-primary">Изменить</button> </td>
                <td> <button v-on:click="deleteClientAuto(clientAuto.id)" type="button" class="btn btn-danger">Удалить</button> </td>
            </tr>
            </tbody>
        </table>
            <vue-pagination :pagination = "clientsAutos"
                            @paginate = "getPagination()"
                            :offset = "15">
            </vue-pagination>
    </div>
</template>

<script>
    import VuePagination from "./Pagination";

    export default {
        name: "ClientsAutosTable",
        data: function () {
            return {
                clientsAutos: {
                    total: 0,
                    per_page: 15,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 15
            }
        },
        created() {
            console.log('t');
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
                        console.log('failed to get pagination data');
                    });
            },
            deleteClientAuto(autoId) {
                axios.delete(`/autos/${autoId}`)
                    .then(() => {
                        this.getPagination();
                    })
                    .catch(() => {
                        console.log(`Error by delete ${autoId} car`);
                    });
            }
        }
    }
</script>
