$(document).ready(function() {
    // Login
    $(document).on("submit", "#frmLogin", function(){
        $.ajax({
            url: BASEPATH + "home/login",
            type: 'post',
            dataType: 'json',
            data: $('#frmLogin').serialize(),
            crossDomain: true,
            beforeSend: function() {
                $('#frmLogin input').css('border', '1px solid #ccc');
            },
            success: function(response) {
                $('#frmLogin .error').hide();
                $('#frmLogin .success').hide();
                if (!response.success) {
                    $('#frmLogin .error').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmLogin .error').show();
                } else {
                    location.reload(true);
                }
            },
        });
        return false;
    });

    // Register
    $(document).on("submit", "#frmSignups", function(){
        $.ajax({
            url: BASEPATH + "home/register",
            type: 'post',
            dataType: 'json',
            data: $('#frmSignups').serialize(),
            crossDomain: true,
            beforeSend: function() {
                $('#frmSignups input').css('border', '1px solid #ccc');
            },
            success: function(response) {
                $('#frmSignups .error').hide();
                $('#frmSignups .success').hide();
                if (!response.success) {
                    $('#frmSignups .error').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmSignups .error').show();
                } else {
                    $('#frmSignups .success').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmSignups .success').show();
                }
            },
        });
        return false;
    });

    // Forget Password
    $(document).on("submit", "#frmForgotPwd", function(){
        $.ajax({
            url: BASEPATH + "home/forget_password",
            type: 'post',
            dataType: 'json',
            data: $('#frmForgotPwd').serialize(),
            crossDomain: true,
            beforeSend: function() {
                $('#frmForgotPwd input').css('border', '1px solid #ccc');
            },
            success: function(response) {
                $('#frmForgotPwd .error').hide();
                $('#frmForgotPwd .success').hide();
                if (!response.success) {
                    $('#frmForgotPwd .error').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmForgotPwd .error').show();
                } else {
                    $('#frmForgotPwd .success').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmForgotPwd .success').show();
                }
            },
        });
        return false;
    });
    
    // Newsletter
    $('#newsltter-btn').click(function() {
        $.ajax({
            url: BASEPATH + "home/subscribe_newsletter",
            type: 'post',
            dataType: 'json',
            data: $('#frmNewsletter').serialize(),
            crossDomain: true,
            beforeSend: function() {
                $('#frmNewsletter input').css('border', '1px solid #ccc');
            },
            success: function(response) {
                if (!response.success) {
                    $('#frmNewsletter .error').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#frmNewsletter .error').show();
                } else {
                    $('#frmNewsletter input[type=text]').val('');
                    $('#frmNewsletter .error').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                }
            },
        });
        return false;
    });

    $("#country").change(function(){
        var me = $(this);

        if(me.val()){
            $.post(BASEPATH+"home/get_state_by_country", {country_id: me.val()}, function(data){
                $("#state").html(data);
            });
        }
    });

    //swal('xxx', "is added to cart !", "success");

    // Call login API on a click event
    $("#google-login-button").on('click', function() {
        // API call for Google login
        gapi.auth2.getAuthInstance().signIn().then(
            function(success) {
                // API call to get user profile information
                gapi.client.request({ path: 'https://www.googleapis.com/plus/v1/people/me' }).then(
                    function(success) {
                        // API call is successful

                        var user_info = JSON.parse(success.body);

                        // user profile information
                        //console.log(user_info);
                        var user = {};
                        user.id = user_info.id;
                        user.first_name = user_info.name.givenName;
                        user.last_name = user_info.name.familyName;
                        user.email = user_info.emails[0].value;

                        saveUserInfo(user);
                    },
                    function(error) {
                        // Error occurred
                        // console.log(error) to find the reason
                        $("#google-login-button").removeAttr('disabled');
                    }
                );
            },
            function(error) {
                // Error occurred
                // console.log(error) to find the reason
                $("#google-login-button").removeAttr('disabled');
            }
        );
    });
});

function openModal(mode){
	$.post(BASEPATH+"home/open_modal", {mode: mode}, function(data){
		$("#loginform").html(data);
		$('#loginModal').modal('show');
	});
}

function saveUserInfo(user){
    $.post(BASEPATH+"home/save_user_info", {user: user}, function(data){
        var data = JSON.parse(data);
        if(data.success){
            location.reload();
        }
    });
}

// Called when Google Javascript API Javascript is loaded
function HandleGoogleApiLibrary() {
    // Load "client" & "auth2" libraries
    gapi.load('client:auth2',  {
        callback: function() {
            // Initialize client & auth libraries
            gapi.client.init({
                apiKey: 'AIzaSyDmlAUQJCW8iBfXdBHBOUriDNf-EfTiWSg',
                clientId: '1098938373816-ngpbmhrrko4dvhq1s29304pr0d9o4m4t.apps.googleusercontent.com',
                scope: 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me'
            }).then(
                function(success) {
                    // Libraries are initialized successfully
                    $("#google-login-button").removeAttr('disabled');
                }, 
                function(error) {
                    // Error occurred
                    // console.log(error) to find the reason
                }
            );
        },
        onerror: function() {
            // Failed to load libraries
        }
    });
}

function load_products(page, view){
    $.ajax({
        url: BASEPATH+"product/load_products?page="+page+"&view="+view,
        type: "get",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    })
    .done(function(data)
    {
        $('.ajax-load').hide();
        $("#load_products").append(data);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
          alert('server not responding...');
    });
}