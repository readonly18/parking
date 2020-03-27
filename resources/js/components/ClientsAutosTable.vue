<template>
    <div>
        <h3>Клиенты</h3>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info " href="/clients" role="button">Новый клиент</a>
            </div>
            <div class="btn-group mr-2" role="group">
                <a class="btn btn-info " href="/autos" role="button">Новый автомобиль</a>
            </div>
        </div>
        <br>

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
                <div class="btn-toolbar" role="toolbar">
                    <td> <router-link :to="{path: '/autos', query: {id: clientAuto.id}}" class="btn btn-primary">Обновить</router-link> </td>
                    <td> <button v-on:click="deleteClientAuto(clientAuto.id)" type="button" class="btn btn-danger">Удалить</button> </td>
                </div>
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
                    current_page: 1,
                    data: []
                },
                offset: 15
            }
        },
        created() {
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

            },
        }
    }
</script>

<style scoped>

</style>
