<template>
    <div>
        <h3>Новый клиент</h3>
        <form @submit.prevent="postClientAuto()">
            <button type="submit" :disabled="$v.$invalid" class="btn btn-info">Создать</button>
            <hr>
            <div class="client">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Фамилия</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.surname.$model" name ="surname" :class="{'form-control': !$v.body.surname.$error, 'form-control is-invalid': $v.body.surname.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Имя</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.name.$model" name = "name" :class="{'form-control': !$v.body.name.$error, 'form-control is-invalid': $v.body.name.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Отчество</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.patronymic.$model" name = "patronymic" :class="{'form-control': !$v.body.patronymic.$error, 'form-control is-invalid': $v.body.patronymic.$error}" placeholder="минимум 3 символа" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Пол</span>
                    </div>
                    <select v-model.lazy="$v.body.gender.$model" :class="{'custom-select': !$v.body.gender.$error, 'custom-select is-invalid': $v.body.gender.$error}" name="gender">
                        <option disabled value="">Выберите один из вариантов</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Телефон</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.phone.$model" name = "phone" :class="{'form-control': !$v.body.phone.$error, 'form-control is-invalid': $v.body.phone.$error}" placeholder="только цифры" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Адрес</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.address.$model" name = "address" :class="{'form-control': !$v.body.address.$error, 'form-control is-invalid': $v.body.address.$error}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
            </div>
            <h3>Автомобиль</h3>
            <hr>
            <div class="automobile">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Марка </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.brand.$model" name="brand" :class="{'form-control': !$v.body.brand.$error, 'form-control is-invalid': $v.body.brand.$error}"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Модель </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.model.$model" name = "model" :class="{'form-control': !$v.body.model.$error, 'form-control is-invalid': $v.body.model.$error}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Цвет кузова </span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.color.$model" name = "color" :class="{'form-control': !$v.body.color.$error, 'form-control is-invalid': $v.body.color.$error}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Гос номер</span>
                    </div>
                    <input type="text" v-model.lazy="$v.body.plate_number.$model" name = "plate_number" :class="{'form-control': !$v.body.plate_number.$change, 'form-control is-invalid': $v.body.plate_number.$error}" placeholder="например, ABC-123" aria-describedby="plateHelp">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Припаркован</span>
                    </div>
                    <select v-model.lazy="$v.body.parking_status.$model" :class="{'custom-select': !$v.body.parking_status.$error, 'custom-select is-invalid': $v.body.parking_status.$error}" name="parking_status">
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
        name: "ClientAutoCreate",
        data: function() {
            return {
                body: {
                    surname: '',
                    name: '',
                    patronymic: '',
                    gender: '',
                    phone: '',
                    address: '',
                    model: '',
                    brand: '',
                    color: '',
                    plate_number: '',
                    parking_status: ''
                },
            };
        },
        validations: {
            body: {
                surname: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(255),
                    alpha
                },
                name: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(255),
                    alpha
                },
                patronymic: {
                    required,
                    minLength: minLength(3),
                    maxLength: maxLength(255),
                    alpha
                },
                gender: {
                    required,
                    validFormat: val => /^female$|^male$/.test(val),
                },
                phone: {
                    required,
                    maxLength: maxLength(11),
                    minLength: minLength(11),
                    numeric,
                    async isUnique(value) {
                        if(value === '')
                            return true;
                        return await axios.get(`/clients/phones/${value}`)
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
                        if(value === '')
                            return true;
                        return await axios.get(`/autos/plate_numbers/${value}`)
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
        },
        methods: {
            postClientAuto($v) {
                axios.post('/clients', this.body)
                    .then((response) => {
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        console.log(`failed to post new client. ${error.response.data.message}`);
                    });
            },
        },
    }
</script>

<style scoped>

</style>
