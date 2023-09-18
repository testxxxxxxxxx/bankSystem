<template>

    <h1>{{text}}</h1>

    <div v-if="isTrue" class="test">

        isTrue

    </div>

    <form></form>
    <login-form></login-form>


</template>
<script>

    import Form from './Form.vue';
    import LoginForm from './LoginForm.vue';

    export default {

        name: 'App',
        components: {

            'form': Form,
            'login-form': LoginForm

        },
        setup(){
            
            const text = "Siema"
            const isTrue = true;

            return{

                text,
                isTrue

            }
        }

    }

</script>