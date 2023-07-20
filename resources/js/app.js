import './bootstrap';
import $ from 'jquery';
import { createApp } from 'vue';
import App from './App.vue';

createApp(App,{

    data(){

        return {

            text: "Hello"

        }

    }

}).mount("#app");

$(()=>{

    $("#sendButton").on('click',(e)=>{

        e.preventDefault();

        const url="/createAccount";
        const typeOfAccountValue=parseInt(document.querySelector("#typeOfAccount").value);

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $.ajax({

            method: "POST",
            url: url,
            data: {typeOfAccount: typeOfAccountValue},
            success: (store)=>{

                location.href=store;

                console.log("true");

            },
            error: ()=>{

                console.log("error");

            }
        
        }).done(()=>{

            alert("true");

        }).fail(()=>{

            alert("false");

        });

    });

});