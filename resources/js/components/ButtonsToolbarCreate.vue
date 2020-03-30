<template>
<div>
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group mr-2" role="group">
            <router-link :to="{path: '/clients'}" class="btn btn-info">Новый клиент</router-link>
        </div>
        <div class="btn-group mr-2" role="group">
            <router-link :to="{path: '/autos'}" class="btn btn-info">Новый автомобиль</router-link>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "VueButtonsToolbarCreate"
    }
</script>

<style scoped>

</style>
