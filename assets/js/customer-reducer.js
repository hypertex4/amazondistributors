(function($) {
    'use strict';
    // No White Space
    $.validator.addMethod("noSpace", function(value, element) {
        if( $(element).attr('required') ) {
            return value.search(/^(?! *$)[^]+$/) == 0;
        }
        return true;
    }, 'Please fill this empty field.');

    $.validator.addClassRules({
        'form-control': {noSpace: true}
    });

    $("form[name='newsLetter']").validate({
        rules: {
            sub_email: {email: true, required: true},
        },
        messages: {
            sub_email: "Email is required",
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var $form = $(form),
                $submitButton = $(this.submitButton),
                submitButtonText = $submitButton.html();
            $submitButton.html( $submitButton.data('loading-text') ? $submitButton.data('wait') : 'wait' ).attr('disabled', true);

            $.ajax({
                url: "controllers/create-newsletter.php", type: "POST", data: $form.serialize(),
                success: function (data) {
                    if (data.status === 1) {
                        document.getElementById('newsLetter').reset();
                        new PNotify({title:'Congratulations!',text:'Thanks for joining our mailing list.',type:'success'});
                    } else {
                        new PNotify({title:'Email already exist!',text:'could not subscribe to our newsletter.',type:'error'});
                    }
                },
                error: function (errData) {},
                complete: function () { $submitButton.html( submitButtonText ).attr('disabled', false); }
            });
        }
    });

    $("form[name='contact_form']").validate({
        rules: {
            fname: {'required': true},
            phone: {digits: true, required: true},
            email: {email: true, required: true},
            message: {'required': true},
        },
        messages: {
            fname: "Full Name is required",
            phone: "Invalid phone number",
            email: "Invalid email address",
            message: "Description is required"
        },
        errorPlacement: function(error, element) {
            if(element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else if( element.is('select') && element.closest('.custom-select-1') ) {
                error.appendTo(element.closest('.form-group'));
            } else {
                if( element.closest('.form-group').length ) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var $form = $(form),
                $submitButton = $(this.submitButton),
                submitButtonText = $submitButton.html();
            $submitButton.html( $submitButton.data('loading-text') ? $submitButton.data('wait') : 'wait' ).attr('disabled', true);

            $.ajax({
                url: "controllers/send-contact-email.php", type: "POST", data: $form.serialize(),
                success: function (data) {
                    if (data.status === 1) {
                        document.getElementById('contact_form').reset();
                        $.alert({
                            title: 'Thanks!', content: data.message, type: 'green', typeAnimated: true,
                            buttons: {ok: function () {window.location.reload();}}
                        });
                    } else {
                        $.alert({title: 'Error!', content: data.message, type: 'red', typeAnimated: true,});
                    }
                },
                error: function (errData) {},
                complete: function () { $submitButton.html( submitButtonText ).attr('disabled', false); }
            });
        }
    });

    $("form[name='ship_request']").validate({
        rules: {
            from_country: "required",
            from_state: "required",
            from_area: "required",
            from_address: "required",
            from_fullname: "required",
            from_phone: {required:true,digits: true, minlength:11},
            from_email: {required:true,email: true},
            to_country: "required",
            to_state: "required",
            to_area: "required",
            to_address: "required",
            to_firstname: "required",
            to_lastname: "required",
            to_email: {required:true,email:true},
            to_phone: {required:true,digits: true, minlength:11},
            p_weight: "required",
        },
        messages: {
            from_state: "Select pickup state",
            from_country: "Select pickup country",
            from_area: "Select pickup area",
            from_address: "Enter pickup address",
            from_email: "Enter valid sender's email",
            from_fullname: "Enter sender's full name",
            from_phone: "Enter valid sender's phone",
            to_country: "Select destination country",
            to_state: "Select destination state",
            to_area: "Select destination area",
            to_address: "Enter pickup address",
            to_firstname: "Enter receiver's first name",
            to_lastname: "Enter receiver's last name",
            to_email: "Enter valid receiver's email",
            to_phone: "Enter valid receiver's phone",
            p_weight: "required",
        },
        errorPlacement: function(error, element) {
            if(element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else if( element.is('select') && element.closest('.custom-select-1') ) {
                error.appendTo(element.closest('.origin-place'));
            } else {
                if( element.closest('.origin-place').length ) {
                    error.appendTo(element.closest('.origin-place'));
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var $form = $(form),
                $submitButton = $(this.submitButton),
                submitButtonText = $submitButton.html();
            $submitButton.html( $submitButton.data('loading-text') ? $submitButton.data('please wait') : 'please wait' ).attr('disabled', true);

            payWithPaystack();
            function payWithPaystack() {
                var handler = PaystackPop.setup({
                    key: 'pk_test_84b96ad57b85b12841d6e3757327b9d49b291627',
                    email: $('#to_email').val(),
                    amount: $('#delivery_fee').val() * 100,
                    currency: "NGN",
                    ref: 'AD' + Math.floor((Math.random() * 100000000) + 1),
                    metadata: {custom_fields: [{display_name: "Amazon Distributors"}]},
                    callback: function (response) {
                        $("#payment_ref").val(response.reference);
                        $.ajax({
                            url: "controllers/process-pickup-request.php", type: "POST", data: $form.serialize(),
                            success: function (data) {
                                if (data.status === 1) {
                                    document.getElementById('ship_request').reset();
                                    $.alert({
                                        title: 'Successful!', content: data.message, type: 'green', typeAnimated: true,
                                        buttons: {
                                            ok: function () {
                                                window.location.reload();
                                            }
                                        }
                                    });
                                } else {
                                    $.alert({title: 'Error!', content: data.message, type: 'red', typeAnimated: true,});
                                }
                            },
                            error: function (errData) {
                            },
                            complete: function () {
                                $submitButton.html(submitButtonText).attr('disabled', false);
                            }
                        });
                    },
                    onClose: function(){ $submitButton.val( submitButtonText ).attr('disabled', false); }
                });
                handler.openIframe();
            }
        }
    });

}).apply(this, [jQuery]);

function sendSuccessResponse(head,body) {
    $("#response-alert").html('' +
        '<div class="alert alert-success alert-dismissible" role="alert">'+
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
        '<strong><i class="far fa-thumbs-up"></i> '+head+'!</strong> '+body+'</div>'
    );
}

function sendErrorResponse(head,body) {
    $("#response-alert").html('' +
        '<div class="alert alert-danger alert-dismissible" role="alert">'+
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
        '<strong><i class="fas fa-exclamation-triangle"></i> '+head+'!</strong> '+body+'</div>'
    );
}