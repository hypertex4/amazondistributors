$(function() {

    $("form[name='createUser']").validate({
        rules: {
            username: {required: true, minlength: 5},
            password: {required: true, minlength: 6},
            confirm_password: {equalTo: '[name="password"]'}
        },
        errorPlacement: function (error, element) {
            if (element[0].id === "confirm_password") error.appendTo($(element).parents('div').find($('.errorCPass')));
            if (element[0].id === 'password') error.appendTo($(element).parents('div').find($('.errorPass')));
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var createUser = $('#createUser');
            var form_data = JSON.stringify(createUser.serializeObject());
            $("#createUserBtn").attr("disabled", true);
            $('#createUserBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("createUser").reset();
                        window.location.replace('user-list');
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#createUserBtn').attr("disabled", false);
                    $('#createUserBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
            });
        }
    });

    $("form[name='addLocation']").validate({
        rules: {
            loc_area: {required: true},
            loc_area_dest: {required: true},
            loc_state: {required: true},
            loc_country: {required: true},
            loc_amt: {required: true, digits: true}
        },
        messages: {
            loc_area: "required",
            loc_area_dest: "required",
            loc_state: "required",
            loc_country: "required",
            loc_amt: "Invalid amount",
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else if (element.is('select') && element.closest('.custom-select-1')) {
                error.appendTo(element.closest('.form-group'));
            } else {
                if (element.closest('.form-group').length) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form) {
            var $form = $(form),
                $submitButton = $(this.submitButton),
                submitButtonText = $submitButton.html();
            var form_data = JSON.stringify($form.serializeObject());
            $submitButton.val($submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'wait..').attr('disabled', true);

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("addLocation").reset();
                        window.location.reload();
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $submitButton.val(submitButtonText).attr('disabled', false);
                }
            });
        }
    });

    $("form[name='updateLocation']").validate({
        rules: {
            edit_loc_area: {required: true},
            edit_loc_area_dest: {required: true},
            edit_loc_state: {required: true},
            edit_loc_country: {required: true},
            edit_loc_amt: {required: true, digits: true}
        },
        messages: {
            edit_loc_area: "required",
            edit_loc_area_dest: "required",
            edit_loc_state: "required",
            edit_loc_country: "required",
            edit_loc_amt: "Invalid amount",
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else if (element.is('select') && element.closest('.custom-select-1')) {
                error.appendTo(element.closest('.form-group'));
            } else {
                if (element.closest('.form-group').length) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form) {
            var $form = $(form),
                $submitButton = $(this.submitButton),
                submitButtonText = $submitButton.html();
            var form_data = JSON.stringify($form.serializeObject());
            $submitButton.val($submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'wait..').attr('disabled', true);

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("addLocation").reset();
                        window.location.reload();
                    }, 1500);
                },
                error: function (errData) {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-right"};
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $submitButton.html(submitButtonText).attr('disabled', false);
                }
            });
        }
    });

    $("form[name='updateAdmUser']").validate({
        rules: {
            edit_adm_username: {"required": true, minlength: 3},
        },
        submitHandler: function (form, e) {
            e.preventDefault();
            var updateAdmUser = $('#updateAdmUser');
            var form_data = JSON.stringify(updateAdmUser.serializeObject());
            $("#updateAdmUserBtn").attr("disabled", true);
            $('#updateAdmUserBtn').css("cursor", 'not-allowed');
            $(".fa-spin").addClass("d-inline-block");

            $.ajax({
                url: "form-reducer-action.php",
                type: "POST",
                contentType: 'application/json',
                data: form_data,
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {
                        document.getElementById("updateAdmUser").reset();
                        window.location.replace('user-list');
                    }, 1000);
                },
                error: function (errData) {
                    toastr["error"](errData.responseJSON.message);
                },
                complete: function () {
                    $('#updateAdmUserBtn').attr("disabled", false);
                    $('#updateAdmUserBtn').css("cursor", 'pointer');
                    $(".fa-spin").removeClass("d-inline-block");
                }
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
            from_phone: {required: true, digits: true, minlength: 11},
            from_email: {required: true, email: true},
            to_country: "required",
            to_state: "required",
            to_area: "required",
            to_address: "required",
            to_firstname: "required",
            to_lastname: "required",
            to_email: {required: true, email: true},
            to_phone: {required: true, digits: true, minlength: 11},
            p_weight: "required",
            delivery_fee: {required: true, digits: true}
        },
        messages: {
            from_state: "Select pickup state",
            from_country: "Select pickup country",
            from_area: "Select pickup area",
            from_address: "Enter pickup address",
            from_fullname: "Enter sender's full name",
            from_email: "Enter valid sender's email",
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
            delivery_fee: "invalid amount"
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                error.appendTo(element.closest('.form-group'));
            } else if (element.is('select') && element.closest('.custom-select-1')) {
                error.appendTo(element.closest('.form-group'));
            } else {
                if (element.closest('.form-group').length) {
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
            $submitButton.html($submitButton.data('loading-text') ? $submitButton.data('please wait') : 'please wait').attr('disabled', true);

            $.ajax({
                url: "../controllers/process-pickup-request-2.php", type: "POST", data: $form.serialize(),
                success: function (data) {
                    if (data.status === 1) {
                        document.getElementById('ship_request').reset();
                        $.alert({
                            title: 'Successful!', content: data.message, type: 'green', typeAnimated: true,
                            buttons: { ok: function () { window.location.reload(); } }
                        });
                    } else {
                        $.alert({title: 'Error!', content: data.message, type: 'red', typeAnimated: true,});
                    }
                },
                error: function (errData) {},
                complete: function () { $submitButton.html(submitButtonText).attr('disabled', false); }
            });
        }
    });

    $(document).on("click", "#ApprovedProductBtn", function (e) {
        e.preventDefault();
        var pid = $(this).data("id");
        var status = $(this).data("status");
        var r = confirm("Are you sure you want to update product status?");
        $("#ApprovedProductBtn").attr("disabled", true);
        $('#ApprovedProductBtn').css("cursor", 'not-allowed');$(".fa-spin").addClass("d-inline-block");

        if (r===true){
            $.ajax({
                url: "form-reducer-action.php", type: "POST",
                data: JSON.stringify({pid:pid,status:status,action_code:604}),
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {window.location.replace('product-list'); }, 500);
                },
                error: function (errData)  {toastr["error"](data.message); },
                complete: function () {
                    $('#ApprovedProductBtn').attr("disabled", false);
                    $('#ApprovedProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
                }
            });
        } else {
            $('#ApprovedProductBtn').attr("disabled", false);
            $('#ApprovedProductBtn').css("cursor", 'pointer');$(".fa-spin").removeClass("d-inline-block");
        }
    });

    $(document).on("click", "#delete_adm_user", function (e) {
        e.preventDefault();
        var admin_id = $(this).data("id");
        var r = confirm("Are you sure you want to delete admin user?");
        if (r===true){
            $.ajax({
                url: "form-reducer-action.php", type: "POST",
                data: JSON.stringify({admin_id:admin_id,action_code:402}),
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {window.location.replace('user-list'); }, 500);
                },
                error: function (errData)  {toastr["error"](data.message); }
            });
        }
    });

    $(document).on("click", "#statusBtn", function (e) {
        e.preventDefault();
        var status = $(this).data("status");
        var pickup_id = $(this).data("pickup_id");
        var s_email = $(this).data("s_email");
        var s_name = $(this).data("s_name");

        var submitButton = $(this);
        var submitButtonText = $(this).val();
        submitButton.val('wait..' ).attr('disabled', true);
            $.confirm({
                title: 'Warning', content: 'Are you sure you want to update this pickup request to '+status+' ?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            url: "form-reducer-action.php", type: "POST",
                            data: JSON.stringify({status,pickup_id,s_email,s_name,action_code: 905}),
                            success: function (data) {
                                if (data.status === 1) {
                                    toastr["success"](data.message);
                                    setTimeout(function () {window.location.reload(); }, 500);
                                } else { toastr["error"](data.message); }
                            },
                            error: function (errData) {},
                            complete: function () { submitButton.val(submitButtonText).attr('disabled', false); }
                        });
                    }, cancel: function () { submitButton.val(submitButtonText).attr('disabled', false);},
                }
            });
    });

    $(document).on("click", "#edit_adm_user", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var user = $(this).data("user");

        $("#edit_adm_id").val(id);
        $("#edit_adm_username").val(user);
    });

    $(document).on("click", "#edit_location", function (e) {
        e.preventDefault();
        var lid = $(this).data("lid");
        var loc_area = $(this).data("loc_area");
        var loc_area_dest = $(this).data("loc_area_dest");
        var loc_amt = $(this).data("loc_amt");
        var loc_state = $(this).data("loc_state");
        var loc_country = $(this).data("loc_country");

        $("#edit_loc_id").val(lid);
        $("#edit_loc_area").val(loc_area);
        $("#edit_loc_area_dest").val(loc_area_dest);
        $("#edit_loc_amt").val(loc_amt);
        $("#edit_loc_state").val(loc_state);
        $("#edit_loc_country").val(loc_country);
    });

    $(document).on("click", "#delete_location", function (e) {
        e.preventDefault();
        var loc_id = $(this).data("loc_id");
        var r = confirm("Are you sure you want to delete this location?");
        if (r===true){
            $.ajax({
                url: "form-reducer-action.php", type: "POST",
                data: JSON.stringify({loc_id:loc_id,action_code:903}),
                success: function (data) {
                    toastr["success"](data.message);
                    setTimeout(function () {window.location.reload(); }, 500);
                },
                error: function (errData)  {toastr["error"](data.message); }
            });
        }
    });

});