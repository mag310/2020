<template>
    <div id="sender-form">
        <h3> {{ title }}</h3>
        <input v-model="userData">
        <button v-on:click="send">Отправить</button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Sender",
        props: ['title'],
        data: function () {
            return {
                userData: ""
            }
        },
        methods: {
            send: function (event) {
                alert(this.userData);
                axios
                    .post('/api/data', {'data': this.userData})
                    // .then(response => (this.info = response.data.bpi))
                    .catch(error => console.log(error));

            }
        }
    }
</script>

<style scoped>

</style>