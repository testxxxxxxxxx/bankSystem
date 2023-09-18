<template v-bind:typesOfAccounts="{{ $typesOfAccounts }}">

    <div class="row form-group">

    <select id="typeOfAccount" class="form-control">

        <div v-for="type of typesOfAccounts" :key="type">

            <option value="{{type.id}}">{{ type.name }}</option>
        
        </div>

    </select>

    <button id="sendButton">{{text}}</button>

</div>

</template>
<script>

    export default {

        name: 'Form',

        setup(){

            const text="create";

            return {

                text

            }

        }

    }

</script>