<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Schedule Pickup<small>Amazon Distributors Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Schedule Pickup</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <form name="ship_request" id="ship_request">
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Pickup Details (Sender's Info)</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-4">
                                        <label for="from_country" class="col-form-label pt-0">Pickup Country <span>*</span></label>
                                        <select class="custom-select" name="from_country" id="from_country">
                                        <?php
                                        $cou = $user->list_distinct_country();
                                        if ($cou->num_rows > 0) {
                                        while ($country = $cou->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$country['loc_country'];?>"><?=$country['loc_country'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="from_state" class="col-form-label pt-0">Pickup State <span>*</span></label>
                                        <select class="custom-select" name="from_state" id="from_state">
                                        <?php
                                        $sta = $user->list_distinct_state();
                                        if ($sta->num_rows > 0) {
                                        while ($state = $sta->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$state['loc_state'];?>"><?=$state['loc_state'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="from_area" class="col-form-label pt-0">Pickup Area <span>*</span></label>
                                        <select class="custom-select" name="from_area" id="from_area">
                                            <option value="">Select Area</option>
                                        <?php
                                        $ar = $user->list_distinct_area();
                                        if ($ar->num_rows > 0) {
                                        while ($area = $ar->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$area['loc_area'];?>"><?=$area['loc_area'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="from_address" class="col-form-label pt-0">Pickup Address <span>*</span></label>
                                        <input class="form-control" id="from_address" name="from_address" type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="from_fullname" class="col-form-label pt-0">Sender Name <span>*</span></label>
                                        <input class="form-control" id="from_fullname" name="from_fullname" type="text">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="from_email" class="col-form-label pt-0">Sender Email <span>*</span></label>
                                        <input class="form-control" id="from_email" name="from_email" type="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="from_phone" class="col-form-label pt-0">Sender Phone <span>*</span></label>
                                        <input class="form-control" id="from_phone" name="from_phone" type="text" maxlength="11">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Destination Details (Receiver's Info)</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-4">
                                        <label for="to_country" class="col-form-label pt-0">Destination Country <span>*</span></label>
                                        <select class="custom-select" name="to_country" id="to_country">
                                        <?php
                                        $cou = $user->list_distinct_country();
                                        if ($cou->num_rows > 0) {
                                        while ($country = $cou->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$country['loc_country'];?>"><?=$country['loc_country'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="to_state" class="col-form-label pt-0">Destination State <span>*</span></label>
                                        <select class="custom-select" name="to_state" id="to_state">
                                        <?php
                                        $sta = $user->list_distinct_state();
                                        if ($sta->num_rows > 0) {
                                        while ($state = $sta->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$state['loc_state'];?>"><?=$state['loc_state'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="to_area" class="col-form-label pt-0">Destination Area <span>*</span></label>
                                        <select class="custom-select" name="to_area" id="to_area">
                                            <option value="">Select Area</option>
                                        <?php
                                        $ar = $user->list_distinct_area_dest();
                                        if ($ar->num_rows > 0) {
                                        while ($area = $ar->fetch_assoc()) {
                                        ?>
                                            <option value="<?=$area['loc_area_dest'];?>"><?=$area['loc_area_dest'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="to_address" class="col-form-label pt-0">Destination Address <span>*</span></label>
                                        <input class="form-control" id="to_address" name="to_address" type="text">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="to_firstname" class="col-form-label pt-0">Receiver's First Name <span>*</span></label>
                                        <input class="form-control" id="to_firstname" name="to_firstname" type="text">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="to_lastname" class="col-form-label pt-0">Receiver's Last Name <span>*</span></label>
                                        <input class="form-control" id="to_lastname" name="to_lastname" type="text">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="to_email" class="col-form-label pt-0">Receiver's Email <span>*</span></label>
                                        <input class="form-control" id="to_email" name="to_email" type="email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="to_phone" class="col-form-label pt-0">Receiver's Phone <span>*</span></label>
                                        <input class="form-control" id="to_phone" name="to_phone" type="text" maxlength="11">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Shipping Details (Package Info)</h4>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-6">
                                        <label for="p_weight" class="col-form-label pt-0">Package Weight <span>*</span></label>
                                        <select class="custom-select" name="p_weight" id="p_weight">
                                            <option value="1">1 Kg</option>
                                            <option value="2">2 Kg</option>
                                            <option value="3">3 Kg</option>
                                            <option value="4">4 Kg</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="delivery_fee" class="col-form-label pt-0">Delivery Fee <span>*</span></label>
                                        <input class="form-control" id="delivery_fee" name="delivery_fee" type="number">
                                        <input id="payment_ref" name="payment_ref" type="hidden" value="<?='T'.rand(100000000,999999999);?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr style="1px solid #ccc" /></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-success">Create Pickup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("change", "#from_area,#to_area", function (e) {
            var from_area = $("#from_area").val();
            var to_area = $("#to_area").val();

            var from_state = $("#from_state").val();
            var to_state = $("#to_state").val();

            $("#delivery_fee").val(0);

            $.ajax({
                url: "../calculate-shipping-fee.php", type: "POST",
                data: {from_area,to_area,from_state,to_state},
                success: function (data) { $("#delivery_fee").val(data.resp); },
                error: function (errData) {}
            });
        });
    });
</script>