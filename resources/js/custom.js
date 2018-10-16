$(document).ready(function ()
{
    calc_total_investment();
    var CSRF_TOKEN = $("input[name=_token]").val();

    $(document).on('keyup', '#price, #quantity', function(event) {
        calc_total_investment();
    });

    $(document).on('click', '.delete', function(event) {
        event.preventDefault();

        var id = $(this).data('id');
        if(confirm("Are you sure you want to delete this instrument?")){
            $.ajax({
                type    : 'DELETE',
                url     : '/purchase/' + id,
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
                data    : { id: id, token: CSRF_TOKEN },
                success : function (data)
                {
                    window.location.replace("/purchase");
                }
            });
        } else {
            return false;
        }
    });

    $(document).on('click', '.remove', function(event) {
        event.preventDefault();

        var email = $(this).data('email');
        if(confirm("Are you sure you want to delete this email?")){
            $.ajax({
                type    : 'DELETE',
                url     : '/email/' + email,
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
                data    : { email: email, token: CSRF_TOKEN },
                success: function(msg){
                    generateMessage(msg);
                    if(msg.status == 'alert-success'){
                        window.location.replace("/profile");
                    }
                }
            });
        } else {
            return false;
        }
    });

    $(document).on('click', '.email', function(){
        var email = $(this, ".email").html();

        $.ajax({
            type: "post",
            url: "/changeDefaultEmail",
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            data: { 'email' : email, token: CSRF_TOKEN },
            success: function(msg){
                generateMessage(msg);
                if(msg.status == 'alert-success')
                    window.location.replace("/profile");
            }
        });
    });

    $('#save').click(function(){
        var email_address = $('#email_address').val();
        if(email_address == ''){
            alert('Please input email address');
            return;
        }
        $.ajax({
            type: "post",
            url: "/email",
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            data: { 'email' : email_address, token: CSRF_TOKEN },
            success: function(msg){
                generateMessage(msg);
                $('#myModal').modal('hide');
                if(msg.status == 'alert-success'){
                    window.location.replace("/profile");
                }
            }
        });
    });

    $('.userinfo').change(function(){
        var field = this.id;
        var value = this.value;

        if((field == 'first_name' || field == 'last_name') && value==""){

            msg = {'status': 'alert-danger', 'message': 'Please fill both fields.'};
            generateMessage(msg);
            return;
        }
        $.ajax({
            type: "put",
            url: "/update",
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
            data: { 'field' : field, 'value' : value, token: CSRF_TOKEN },
            success: function(msg){
                generateMessage(msg);
            }
        });
    });

});

function generateMessage(msg) {
    $('.message').removeClass('alert-danger alert-success').addClass(msg.status).html(msg.message);
}

function calc_total_investment() {
    price = $('#price').val();
    quantity = $('#quantity').val();

    $('#total_investment').html((price * quantity).toFixed(2));
}
