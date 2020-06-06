<template>
    <div class="wrapper box">
        <input name="a" v-model="aValue"><br>
        <input name="b" v-model="bValue"><br>
        <span>Result: {{ result }}</span>
    </div>
</template>

<script>
    export default {
        name: "Calc",
        data:
            function () {
                return {
                    aValue: 0,
                    bValue: 0
                }
            },
        computed: {
            // геттер вычисляемого значения
            result: function () {
                // `this` указывает на экземпляр vm
                return Number(this.aValue) + Number(this.bValue)
            }
        }
    }
</script>

<style scoped>

</style>