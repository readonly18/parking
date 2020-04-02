<template>
    <div>
        <h3>Новый клиент</h3>
        <form @submit.prevent="postAuto()">
            <button type="submit" :disabled="$v.$invalid" class="btn btn-info">Создать</button>
            <hr>
            <div class="client">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Телефон</span>
                    </div>
                    <select v-model.lazy="$v.body.client.phone.$model" :class="{'custom-select': !$v.body.client.phone.$error, 'custom-select is-invalid': $v.body.client.phone.$error}" name="phone">
                        <option disabled value="">Выберите один из вариантов</option>
                        <option v-for="phone in state.phones" :value="phone">{{ phone }}</option>
                    </select>
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
        name: "AutoCreate",
        data: function() {
            return {
                body: {
                    client: {
                        phone: '',
                    },
                    auto: {
                        model: '',
                        brand: '',
                        color: '',
                        plate_number: '',
                        parking_status: ''
                    }
                },
                state: {
                    gender: ['female', 'male'],
                    phones: [],
                }
            };
        },
        created() {
            this.getPhones();
        },
        validations: {
            body: {
                client: {
                    phone: {
                        required,
                        maxLength: maxLength(11),
                        minLength: minLength(11),
                        numeric,
                    },
                },
                auto: {
                    model: {
                        required,
                        minLength: minLength(1),
                        maxLength: maxLength(255),
                    },
                    brand: {
                        required,
                        minLength: minLength(1),
                        maxLength: maxLength(255),
                    },
                    color: {
                        required,
                        minLength: minLength(1),
                        maxLength: maxLength(255),
                    },
                    plate_number: {
                        required,
                        maxLength: maxLength(7),
                        validFormat: val => /^[A-Z]{3}-[0-9]{3}/.test(val),
                        async isUnique(value) {
                            if (value === '')
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
                }
            }
        },
        methods: {
            postAuto() {
                axios.post('/autos', this.body)
                    .then((response) => {
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        console.log(`failed to post new client. ${error.response.data.message}`);
                    });
            },
            getPhones() {
                axios.get(`/clients/phones`)
                    .then((response) => {
                        this.state.phones = response.data.phones;
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
