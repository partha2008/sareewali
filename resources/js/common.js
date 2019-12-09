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

    $('#keyword').autocomplete({
        serviceUrl: BASEPATH+"product/get_global_search",
        onSelect: function(suggestion) {
            $("#srch-btn").attr("onclick", "window.location.href='"+suggestion.data+"'");
        },
        onHint: function (hint) {
            $('#autocomplete-ajax-x').val(hint);
        }
    });

    $("#review_frm").submit(function(e){
        var me = $(this);

        $.ajax({
            url: BASEPATH + "product/add_review",
            type: 'post',
            dataType: 'json',
            data: me.serialize(),
            crossDomain: true,
            success: function(response) {
                $('#review_frm .error').hide();
                $('#review_frm .success').hide();
                if (!response.success) {
                    $('#review_frm .error').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#review_frm .error').show();
                } else {
                    $('#review_frm .error').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.msg + '</div>');
                    $('#review_frm .error').show();
                }
            },
        });
        return false;
    });

    $(".payment_mode_cls").click(function(){
        $(".payment_mode_cls").find("input:radio").removeAttr("checked");
        $(this).find("input:radio").prop('checked', true);
    });

    if(PAGENAME == 'checkout'){
        $('#frmCheckout').validate({ 
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true
                },
                phone: {
                    required: true
                },
                address1: {
                    required: true
                },
                city: {
                    required: true
                },
                country_id: {
                    required: true
                },
                state_id: {
                    required: true
                }
            },
            submitHandler: function (form) { 
                $("#place_order_btn").prop("disabled", true);
                $.post(BASEPATH+"cart/make_order", {data: $(form).serialize()}, function(data){
                    var response = JSON.parse(data);

                    $("#place_order_btn").prop("disabled", false);
                    if(response.status){                        
                        if(response.hasOwnProperty('redirect')){
                            window.location.href = response.redirect;
                        }else{
                            swal({
                                title: response.msgTxt,
                                text: "Transaction ID: "+response.text,
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            }).then((willDelete) => {
                                window.location.href = BASEPATH;
                            });
                        }
                    }else{
                        swal({
                            title: response.msgTxt,
                            text: "Please try again",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        }).then((willDelete) => {

                        });
                    }
                });
                
                return false;
            }
        });
    }

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
    var mode = $(".shortByDropDown ul li").find("a.active").attr("param");
    var min_price = $("#min_price").val();
    var max_price = $("#max_price").val();
    var attr_arr = [];
    var key, val;
    
    $("input:checkbox[class=filter_color]:checked").each(function () {    
        key = $(this).attr("name");
        val = $(this).val();        
        attr_arr.push({key: key, value: val});
    });

    var grouped = groupBy(attr_arr, 'key');

    if(mode){
        var url = BASEPATH+"product/load_products?page="+page+"&view="+view+"&mode="+mode+"&min_price="+min_price+"&max_price="+max_price+"&attrs="+JSON.stringify(grouped);
    }else{
        var url = BASEPATH+"product/load_products?page="+page+"&view="+view+"&min_price="+min_price+"&max_price="+max_price+"&attrs="+JSON.stringify(grouped);
    }
    $.ajax({
        url: url,
        type: "get",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    })
    .done(function(data)
    {     
        $('.ajax-load').hide();
        if(data.trim() == ""){
            sessionStorage.setItem("page_end", true);
            return false;
        }
        $("#load_products").append(data);
        $(".lazy").unveil(300);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}

function groupBy(array, groupBy){
    return array.reduce((acc,curr,index,array) => {
        var  idx = curr[groupBy]; 
        if(!acc[idx]){
            acc[idx] = array.filter(item => item[groupBy] === idx)
        } 

        return  acc; 
    },{})
}

function search_by_attr(page){
    sessionStorage.setItem("page", page);
    sessionStorage.setItem("page_end", false);

    var mode = $(".shortByDropDown ul li").find("a.active").attr("param");    
    var min_price = $("#min_price").val();
    var max_price = $("#max_price").val();
    var attr_arr = [];
    var key, val;

    $("input:checkbox[class=filter_color]:checked").each(function () {    
        key = $(this).attr("name");
        val = $(this).val();        
        attr_arr.push({key: key, value: val});
    });

    var grouped = groupBy(attr_arr, 'key');
    
    if(mode){
        var url = BASEPATH+"product/load_products?page="+page+"&view="+VIEW+"&mode="+mode+"&min_price="+min_price+"&max_price="+max_price+"&attrs="+JSON.stringify(grouped);
    }else{
        var url = BASEPATH+"product/load_products?page="+page+"&view="+VIEW+"&min_price="+min_price+"&max_price="+max_price+"&attrs="+JSON.stringify(grouped);
    }

    $.ajax({
        url: url,
        type: "get",
        beforeSend: function()
        {
            $('#loading').show();
        }
    })
    .done(function(data)
    {
        $('#loading').hide();
        if(data.trim() != ""){
            $("#load_products").html(data);
            $(".lazy").unveil(300);
        }else{
            $("#load_products").html('<div class="no-prd"> Oops, Sorry no item(s) found for the criteria </div>');
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
          alert('server not responding...');
    });
}

function load_unveil(){
    $(".lazy").unveil(300);
}

function loadWishList(page){
    $.ajax({
        url: BASEPATH+"home/load_wishlist?page="+page,
        type: "get",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    })
    .done(function(data)
    {     
        $('.ajax-load').hide();
        if(data.trim() == ""){
            if(page == 0){
                $("#wishlist_html").html('<div class="no-prd"> Oops, Sorry no item(s) found in your wishlist </div>');
            }
            sessionStorage.setItem("page_end", true);
            return false;
        }
        $("#wishlist_html").append(data);
        $('[data-toggle="tooltip"]').tooltip();
        $(".lazy").unveil(300);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('server not responding...');
    });
}

function addToWishList(product_id, is_logged_in){
    if(is_logged_in != "1"){
        openModal('login');

        return false;
    }

    $.post(BASEPATH+"home/add_to_wishlist", {data: product_id}, function(data){
        var response = JSON.parse(data);
        if(response.status){
            swal({
                text: response.msgText,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        }else{
            swal({
                text: response.msgText,
                icon: "error",
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        }
    });
}

function remove_from_wishlist(product_id, is_logged_in){
    if(is_logged_in != "1"){
        openModal('login');

        return false;
    }

    $.post(BASEPATH+"home/remove_from_wishlist", {data: product_id}, function(data){
        var response = JSON.parse(data);
        if(response.status){
            swal({
                text: response.msgText,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false
            }).then((willDelete) => {
                sessionStorage.setItem("page", 0);
                sessionStorage.setItem("page_end", false);
                $("#wishlist_html").html('');
                loadWishList(sessionStorage.getItem("page"));
            });
        }
    });
}

function addToCart(slug, is_logged_in, redirect){
    if(is_logged_in != "1"){
        openModal('login');
        return false;
    }

    $.post(BASEPATH+"cart/add_to_cart", {data: slug}, function(data){
        var response = JSON.parse(data);
        if(response.status){
            $(".topCart").html(response.html);
            swal({
                title: response.data,
                text: "is added to cart !",
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false
            }).then((willDelete) => {
                if(redirect){
                    window.location.href = BASEPATH+"cart";
                }
            });
        }
    });
}

function update_cart(mode, cart_id){
    $.post(BASEPATH+"cart/update_cart", {mode: mode, cart_id: cart_id}, function(data){
        var response = JSON.parse(data);
        if(response.status){
            $(".topCart").html(response.html);
            $(".page-content").html(response.data);
        }
    });
}

function populateStateByCountry(country_id){
    $.post(BASEPATH+"home/get_state_by_country", {country_id: country_id}, function(data){
        $("#state").html(data);
    });
}

function applyCoupon(){
    $("#btn-apply-coupon").prop('disabled', true); 
    $("#price_chart").append('<div id="loading_spinner" class="loading">Loading&#8230;</div>');

    var coupon = $("#coupon_code").val();
    $.post(BASEPATH+"cart/get_discount", {coupon: coupon}, function(data){
        var response = JSON.parse(data);
        
        $("#btn-apply-coupon").prop('disabled', false);  

        if(response.status){       
            $("#coupon_err").html('');
        }else{
            $("#coupon_err").html(response.msgText);
        }    
        $("#price_chart").html(response.data);    
    });
}

function cancelCoupon(){
    $("#price_chart").append('<div id="loading_spinner" class="loading">Loading&#8230;</div>');
    $.post(BASEPATH+"cart/cancel_discount", function(data){
        var response = JSON.parse(data);
        $("#price_chart").html(response.data);
        $("#coupon_code").val("");
    });
}$('[data-toggle="tooltip"]').tooltip();

function checkAvailability(){
    if(!$("#pin_code").val())
        return false;

    $.post(BASEPATH+"product/check_availability", {pincode: $("#pin_code").val()}, function(data){
        var response = JSON.parse(data);

        $("#txt_avl").html(response.msg);
    });
}