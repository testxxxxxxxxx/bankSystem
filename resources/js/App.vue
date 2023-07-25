<template>

    <h1>{{text}}</h1>

    <div v-if="isTrue" class="test">

        isTrue

    </div>

    <Form/>

</template>
<script>

    import Form from './Form.vue';

    export default {

        components: {

            Form

        },
        setup(){
            
            const text="Siema"
            const isTrue=true;

            return{

                text,
                isTrue

            }
        }

    }

</script>