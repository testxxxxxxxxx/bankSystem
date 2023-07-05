import './bootstrap';
import $ from 'jquery';

$(()=>{

    $("#sendButton").on('click',()=>{

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

        }).done(()=>{

            alert("true");

        }).fail(()=>{

            alert("false");

        });

    });

});