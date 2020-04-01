<template>
    <div>
        <h3>Клиент</h3>
        <form @submit.prevent="updateClientAuto()">
            <button type="submit" :disabled="$v.$invalid" class="btn btn-info">Обновить</button>
            <hr>
            <div class="client">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Фамилия</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.client.surname.$model" name ="surname" :class="{'form-control': !$v.body.client.surname.$error, 'form-control is-invalid': $v.body.client.surname.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Имя</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.client.name.$model" name = "name" :class="{'form-control': !$v.body.client.name.$error, 'form-control is-invalid': $v.body.client.name.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Отчество</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.client.patronymic.$model" name = "patronymic" :class="{'form-control': !$v.body.client.patronymic.$error, 'form-control is-invalid': $v.body.client.patronymic.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Пол</span>
                    </div>
                    <select v-model.lazy="$v.body.client.gender.$model" :class="{'custom-select': !$v.body.client.gender.$error, 'custom-select is-invalid': $v.body.client.gender.$error}" name="gender">
                        <option disabled value="">Выберите один из вариантов</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Телефон</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.client.phone.$model" name = "phone" :class="{'form-control': !$v.body.client.phone.$error, 'form-control is-invalid': $v.body.client.phone.$error}" placeholder="только цифры" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Адрес</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.client.address.$model" name = "address" :class="{'form-control': !$v.body.client.address.$error, 'form-control is-invalid': $v.body.client.address.$error}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <h3>Автомобиль</h3>
            <hr>
            <div class="automobile">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Марка </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.auto.brand.$model" name="brand" :class="{'form-control': !$v.body.auto.brand.$error, 'form-control is-invalid': $v.body.auto.brand.$error}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Модель </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.auto.model.$model" name = "model" :class="{'form-control': !$v.body.auto.model.$error, 'form-control is-invalid': $v.body.auto.model.$error}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Цвет кузова </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.auto.color.$model" name = "color" :class="{'form-control': !$v.body.auto.color.$error, 'form-control is-invalid': $v.body.auto.color.$error}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Гос номер</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.auto.plate_number.$model" name = "plate_number" :class="{'form-control': !$v.body.auto.plate_number.$change, 'form-control is-invalid': $v.body.auto.plate_number.$error}" placeholder="например, ABC-123" aria-describedby="plateHelp">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Припаркован</span>
                    </div>
                    <select v-model.lazy="$v.body.auto.parking_status.$model" :class="{'custom-select': !$v.body.auto.parking_status.$error, 'custom-select is-invalid': $v.body.auto.parking_status.$error}" name="parking_status">
                        <option disabled value="">Выберите один из вариантов</option>
                        <option value="1">Да</option>
                        <option value="0">Нет</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { required, maxLength, minLength, alpha, numeric, between } from 'vuelidate/lib/validators';
    import moment from 'moment';

    export default {
        name: "ClientAutoUpdate",
        data: function() {
            return {
                body: {
                    client: {
                        id: '',
                        surname: '',
                        name: '',
                        patronymic: '',
                        gender: '',
                        phone: '',
                        address: '',
                    },
                    auto: {
                        id: '',
                        model: '',
                        brand: '',
                        color: '',
                        plate_number: '',
                        parking_status: '',
                        client_id: ''
                    },
                },
                state: {
                    gender: ['female', 'male'],
                    phone: '',
                    plateNumber: '',
                    autoId: '',
                },
            };
        },
        created() {
            this.getData(this.$route.params.id);
            // if(typeof(data) === 'object') {
            //     console.log(data);
            //     this.body.client = data.client[0];
            //     this.body.auto = data.auto[0];
            //     this.state.phone = data.client[0].phone;
            //     this.state.plateNumber = data.auto[0].plate_number;
            // }
        },
        validations: {
            body: {
                client: {
                    surname: {
                        required,
                        minLength: minLength(3),
                        maxLength: maxLength(255),
                        //alpha
                    },
                    name: {
                        required,
                        minLength: minLength(3),
                        maxLength: maxLength(255),
                        //alpha
                    },
                    patronymic: {
                        required,
                        minLength: minLength(3),
                        maxLength: maxLength(255),
                        //alpha
                    },
                    gender: {
                        required,
                        inList(value) {
                            return this.state.gender.includes(value);
                        },
                    },
                    phone: {
                        required,
                        maxLength: maxLength(11),
                        minLength: minLength(11),
                        numeric,
                        async isUnique(value) {
                            if ((value === '') || (value === this.state.phone))
                                return true;
                            return await axios.get(`/clients/phones/validate?value=${value}`)
                                .then((response) => {
                                    return true;
                                })
                                .catch(() => {
                                    return false;
                                });
                        }
                    },
                    address: {
                        maxLength: maxLength(255),
                    },
                },
                auto: {
                    model: {
                        required,
                        maxLength: maxLength(255),
                    },
                    brand: {
                        required,
                        maxLength: maxLength(255),
                    },
                    color: {
                        required,
                        maxLength: maxLength(255),
                    },
                    plate_number: {
                        required,
                        maxLength: maxLength(7),
                        validFormat: val => /^[A-Z]{3}-[0-9]{3}/.test(val),
                        async isUnique(value) {
                            if ((value === '') || (value === this.state.plateNumber))
                                return true;
                            return await axios.get(`/autos/plate_numbers/validate?value=${value}`)
                                .then((response) => {
                                    return true;
                                })
                                .catch(() => {
                                    return false;
                                });
                        }
                    },
                    parking_status: {
                        required,
                        between: between(0, 1),
                    }
                },
            }
        },
        methods: {
            updateClientAuto() {
                //this.body.client and this.body.auto. Change validate method in php.
                axios.put(`/autos/${this.state.autoId}`, this.body)
                    .then((response) => {
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        console.log(`failed to post new client. ${error.response.data.message}`);
                    });
            },
            getData(id) {
                axios.get(`/autos/${id}`)
                    .then((response) => {
                        this.body.client = response.data.client[0];
                        this.body.auto = response.data.auto[0];
                        this.state.phone = response.data.client[0].phone;
                        this.state.plateNumber = response.data.auto[0].plate_number;
                        this.state.autoId = id;
                    })
                    .catch(() => {
                        console.log('failed to get source data');
                    });
            },
        },
    }
</script>

<style scoped>

</style>
