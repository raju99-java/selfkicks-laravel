/* global full_path */

// window height //
var currentRequest = null;
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #B40B2B;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

function success_msg(msg) {
    $.iaoAlert({
        type: "success",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "5000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
        zIndex: '9999',
    });
}
function  error_msg(msg) {
    $.iaoAlert({
        type: "error",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
        zIndex: '9999',
    });
}
jQuery(document).ready(function ($) {
    adjustWinHeight();
    $(window).resize(function () {
        adjustWinHeight();
    });
    function adjustWinHeight() {
        var $ = jQuery;
        var winHeight = $(window).height();
        var footerHeight = $('.site-footer').height();
        var headerHeight = $('.site-header').height();
        var mainHeight = winHeight - (footerHeight + headerHeight);
        $('.index-main').css('min-height', mainHeight);
        $('.main').css('min-height', mainHeight);
        $('.main .dashboard').css('min-height', mainHeight);
    }

// fixed header //

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            $(".site-header").addClass("fixed-header");
            $(".site-header").addClass("animated");
            $(".site-header").addClass("fadeInDown");
        } else if (scroll <= 1) {
            $(".site-header").removeClass("fixed-header");
            $(".site-header").removeClass("animated");
            $(".site-header").removeClass("fadeInDown");
        }
    });
// Responsive Menu //

    $(document).ready(function () {
        $(".site-menu #nav-toggle").click(function (e) {
            $(".site-menu ul").slideToggle('slow');
            $("#navigation-icon").toggle();
            $("#times-icon").toggle();
        });
//        if ($(window).width() < 1024) {
//            $('body').on('click', function () {
//                $('.site-menu ul').slideUp('slow');
//                $("#navigation-icon").show();
//                $("#times-icon").hide();
//            });
//        } else {
//            $('.site-menu ul').show('');
//        }
    });
    // scroll to top //

    $(window).scroll(function () {
        if ($(this).scrollTop() > 75) {
            $('#scroll_top').slideDown();
            $('#scroll_top').addClass('show-top');
        } else {
            $('#scroll_top').slideDown();
            $('#scroll_top').removeClass('show-top');
        }
    });
    $('#scroll_top').click(function () {
        $("html, body").animate({scrollTop: 0}, 1500);
        return false;
    });
    
    // search box date picker //

    /*********** Dashboard Menu *************/

    if ($(window).width() < 768) {
        $('#dashsidenav-toggle').click(function () {
            $('.left-side-item').slideToggle();
        });
        $('#dashsidenav-toggle').on('click', function () {
            this.classList.toggle('active');
        });
    } else {
        $('.left-side-item').show('');
    }
    if ($(window).width() < 1921) {
        $('#dashsidenav-toggle').click(function () {
            $('.user-left-side').toggleClass("slide-left");
            $('.dash-right').toggleClass("slide-right");
        });
    }

});
$(document).ready(function () {
    

    


    $('.get-started').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                ajaxindicatorstop();
                $('.get-started')[0].reset();

                setTimeout(() => {
                    window.location.href = resp.url;
                }, 1000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });


    $('#signup-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                
                
                ajaxindicatorstop();
                success_msg(resp.msg);

                $('.modal').modal('hide');
                $('#signupModalBtn').modal('show');
                
                
                
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#verify-otp-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                
                if(resp.status == 0){
                    ajaxindicatorstop();
                    error_msg(resp.msg);

                }else if(resp.status == 1){
                    ajaxindicatorstop();
                    success_msg(resp.msg);
                    $('#verify-otp-form')[0].reset();
                    $('#signupModalBtn').modal('hide');
                    $('#signup-form')[0].reset();

                    setTimeout(() => {
                        window.location.href = resp.url;
                    }, 3000);
                    
                }
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });


    $('#login-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                ajaxindicatorstop();
                success_msg(resp.msg);
                $('#login-form')[0].reset();

                setTimeout(() => {
                    window.location.href = resp.url;
                }, 1000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $(document).on('click', '#resend-otp', function(event){
        event.preventDefault();
        ajaxindicatorstart();
        var url = $("#resend-otp").attr("href");
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function (resp) {
                
                ajaxindicatorstop();
                success_msg(resp.msg);
                
            }
        })
        
    });


    $('#forgot-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                ajaxindicatorstop();
                success_msg(resp.msg);

                $('.modal').modal('hide');
                $('#forgotModalBtn').modal('show');

                //$('#forgot-form')[0].reset();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $(document).on('click', '#forgot-resend-otp', function(event){
        event.preventDefault();
        ajaxindicatorstart();
        var url = $("#forgot-resend-otp").attr("href");
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function (resp) {
                
                ajaxindicatorstop();
                success_msg(resp.msg);
                
            }
        })
        
    });

    $('#forgot-verify-otp-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                
                if(resp.status == 0){
                    ajaxindicatorstop();
                    error_msg(resp.msg);

                }else if(resp.status == 1){
                    ajaxindicatorstop();
                    success_msg(resp.msg);
                    $('#forgot-verify-otp-form')[0].reset();
                    $('#forgotModalBtn').modal('hide');
                    $('#forgot-form')[0].reset();

                    setTimeout(() => {
                        window.location.href = resp.url;
                    }, 3000);
                    
                }
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#reset-password-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                ajaxindicatorstop();
                success_msg(resp.msg);
                $('#reset-password-form')[0].reset();
                setTimeout(() => {
                    window.location.href = resp.url;
                }, 3000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        })
    });



    // user dashboard

    $('#update-profile-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                ajaxindicatorstop();
                success_msg(resp.msg);
                $('#update-profile-form')[0].reset();

                setTimeout(() => {
                    window.location.href = resp.url;
                }, 1000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#kyc-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {

                ajaxindicatorstop();
                success_msg(resp.msg);
                $('#kyc-form')[0].reset();

                setTimeout(() => {
                    window.location.href = resp.url;
                }, 1000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $(document).on('submit', '#plan-payment-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                ajaxindicatorstop();
                success_msg(resp.msg);

                $('#surl').val(resp.surl);
                $('#furl').val(resp.furl);
                $('#txnid').val(resp.txnid);
                $('#amount').val(resp.amount);
                $('#firstname').val(resp.firstname);
                $('#email').val(resp.email);
                $('#hash').val(resp.hash);
                $('#phone').val(resp.phone);
                
                
                setTimeout(() => {
                    submitPayuForm();
                }, 1000);
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });
   

    $('#customer-editprofile-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                ajaxindicatorstop();
//                window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });
    $('#user-profile-details-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                ajaxindicatorstop();
                //window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });
    $('#withdraw-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                    zIndex: '9999'
                });
                $('#withdraw-form')[0].reset();
                $('#withdrawModal').modal('hide');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });


    

    $(document).on('submit', '#contact-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $('#contact-form')[0].reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });

});


/********** Service list image upload ************/

$(document).on("click", ".browse", function () {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
});

function addWatchList(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    console.log(id);
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'add-watch-list',
        dataType: 'json',
        data: {video_id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            
            if(resp.status == 'error'){

                ajaxindicatorstop();
                error_msg(resp.msg);

            }else if(resp.status == 'success') {

                ajaxindicatorstop();
                success_msg(resp.msg);

            }
            
        }
    });
}

function removeWatchList(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    console.log(id);
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'remove-watch-list',
        dataType: 'json',
        data: {watch_id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            
            if(resp.status == 'error'){

                ajaxindicatorstop();
                error_msg(resp.msg);
                

            }else if(resp.status == 'success') {

                ajaxindicatorstop();
                success_msg(resp.msg);
                setTimeout(function(){
                    location.reload();
                },1000);

            }
            
        }
    });
}

function redeemRequest(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    console.log(id);
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'redeem-request',
        dataType: 'json',
        data: {user_id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            
            if(resp.status == 'error'){

                ajaxindicatorstop();
                error_msg(resp.msg);
                

            }else if(resp.status == 'success') {

                ajaxindicatorstop();
                success_msg(resp.msg);

            }
            
        }
    });
}
















