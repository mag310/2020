<template>
    <div>
        <sender title="Отправить метрику"></sender>
    </div>
</template>

<script>
    import HelloWorld from "./components/HelloWorld";
    import Calc from "./components/Calc";
    import Sender from "./components/Sender";
    import axios from 'axios';

    export default {
        components: {
            'hello-world': HelloWorld,
            'calc': Calc,
            'sender': Sender
        },
        name: "App",
        data: function () {
            return {
                text: 'Hello World!!!'
            }
        }
    }
</script>