$(document).ready(function(){

    $('form#formLogin').submit(function(event) {
        event.preventDefault();

        var postData = {
            'username': $('input[name=username]').val(),
            'password': $('input[name=password]').val()
        };

        $.ajax({
            type: 'POST',
            url: $('form#formLogin').attr('action'),
            data: postData,
            success: function (response) {
                window.location.href = response.message
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    $('form#formNewProposition').submit(function(event) {
        event.preventDefault();

        var postData = {
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'url': $('input[name=url]').val(),
            'content': $('textarea#inputContent').val(),
            'g-recaptcha-response': grecaptcha.getResponse()
        };

        $.ajax({
            type: 'POST',
            url: $('form#formNewProposition').attr('action'),
            data: postData,
            success: function (response) {
                window.location.href = response.message
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    $('form#complaintEditForm').submit(function(event) {
        event.preventDefault();

        var postData = {
            'id' : $('input[name=id]').val(),
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'url': $('input[name=url]').val(),
            'content': $('textarea#inputContent').val(),
        };

        $.ajax({
            type: 'POST',
            url: $('form#complaintEditForm').attr('action'),
            data: postData,
            success: function (response) {
                console.log(response)
                $('.alert-success').text(response.message);
                $('.alert-success').show();
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    $('form#propositionEditForm').submit(function(event) {
        event.preventDefault();

        var postData = {
            'id' : $('input[name=id]').val(),
            'name': $('input[name=name]').val(),
            'email': $('input[name=email]').val(),
            'url': $('input[name=url]').val(),
            'content': $('textarea#inputContent').val(),
        };

        $.ajax({
            type: 'POST',
            url: $('form#propositionEditForm').attr('action'),
            data: postData,
            success: function (response) {
                console.log(response)
                $('.alert-success').text(response.message);
                $('.alert-success').show();
            },
            error: function (response) {
                $('.alert-danger').text(response.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    $('a.delete-row').click(function (event) {
        event.preventDefault();

        var tr = $(this).closest('tr');
        var url = $(this).attr('href');
        console.log(url);
        $.ajax({
            type: 'GET',
            url: url,
            complete: function () {
                tr.css("background-color","#FF3700");
                tr.fadeOut(400, function(){
                    tr.remove();
                });
            }
        });
        
    })

});



