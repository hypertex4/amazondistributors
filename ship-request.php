<?php include_once("inc/header.nav.php"); ?>
<main>
    <section class="page-title-area sky-blue-bg pt-200 pb-110 pt-lg-110 pt-md-120 pb-md-100 pt-xs-160 pb-xs-90">
        <img class="page-shape shape_04 d-none d-md-inline-block" src="assets/img/shape/orange-1.svg" alt="Page Shape">
        <img class="page-shape shape_05 d-none d-xxl-inline-block" src="assets/img/shape/round-line-a.svg" alt="Page Shape">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="page-title-wrapper text-center">
                        <h4 class="styled-text theme-color mb-30">Request Pickup</h4>
                        <h5 class="h1 page-title">Schedule a Pickup</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="request-quote-area pt-120 pb-120 pt-lg-80 pb-lg-80 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
        <div class="container">
            <form class="quote-info-wrapper" name="ship_request" id="ship_request">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="quotes-title">Pickup Details (Sender's Info)</h3>
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>PICKUP COUNTRY</p>
                                <select name="from_country" id="from_country">
                                <?php
                                $cou = $user->list_distinct_country();
                                if ($cou->num_rows > 0) {
                                while ($country = $cou->fetch_assoc()) {
                                ?>
                                    <option value="<?=$country['loc_country'];?>"><?=$country['loc_country'];?></option>
                                <?php } } ?>
                                </select>
                            </div>
                            <div class="origin-place mb-30">
                                <p>PICKUP STATE</p>
                                <select name="from_state" id="from_state">
                                <?php
                                $sta = $user->list_distinct_state();
                                if ($sta->num_rows > 0) {
                                while ($state = $sta->fetch_assoc()) {
                                ?>
                                    <option value="<?=$state['loc_state'];?>"><?=$state['loc_state'];?></option>
                                <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>PICKUP AREA</p>
                                <select name="from_area" id="from_area">
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
                            <div class="origin-place mb-30">
                                <p>PICKUP ADDRESS</p>
                                <div class="quantity q-style1 me-lg-5 me-4">
                                    <input type="text" class="qty-input" name="from_address" id="from_address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="origin-place me-2 mb-30">
                            <p>SENDER FULL NAME</p>
                            <div class="quantity q-style1 me-4">
                                <input type="text" class="qty-input" name="from_fullname" id="from_fullname">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-0">
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>SENDER EMAIL</p>
                                <div class="quantity q-style1 me-4">
                                    <input type="text" class="qty-input" name="from_email" id="from_email">
                                </div>
                            </div>
                            <div class="origin-place mb-30">
                                <p>SENDER PHONE</p>
                                <div class="quantity q-style1 me-lg-5 me-4">
                                    <input type="text" class="qty-input" name="from_phone" id="from_phone" maxlength="11">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <h3 class="quotes-title">Destination Details (Receiver's Info)</h3>
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>DESTINATION COUNTRY</p>
                                <select name="to_country" id="to_country">
                                    <?php
                                    $cou = $user->list_distinct_country();
                                    if ($cou->num_rows > 0) {
                                    while ($country = $cou->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$country['loc_country'];?>"><?=$country['loc_country'];?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="origin-place mb-30">
                                <p>DESTINATION STATE</p>
                                <select name="to_state" id="to_state">
                                    <?php
                                    $sta = $user->list_distinct_state();
                                    if ($sta->num_rows > 0) {
                                    while ($state = $sta->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$state['loc_state'];?>"><?=$state['loc_state'];?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>DESTINATION AREA</p>
                                <select name="to_area" id="to_area">
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
                            <div class="origin-place mb-30">
                                <p>DESTINATION ADDRESS</p>
                                <div class="quantity q-style1 me-5">
                                    <input type="text" class="qty-input" name="to_address" id="to_address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <h3 class="quotes-title">Receiver Info. & Package Details</h3>
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>RECEIVER FIRST NAME</p>
                                <div class="quantity q-style1 me-5">
                                    <input type="text" class="qty-input" name="to_firstname" id="to_firstname">
                                </div>
                            </div>
                            <div class="origin-place mb-30">
                                <p>RECEIVER LAST NAME</p>
                                <div class="quantity q-style1 me-5">
                                    <input type="text" class="qty-input" name="to_lastname" id="to_lastname">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>RECEIVER EMAIL</p>
                                <div class="quantity q-style1 me-5">
                                    <input type="text" class="qty-input" name="to_email" id="to_email">
                                </div>
                            </div>
                            <div class="origin-place mb-30">
                                <p>RECEIVER PHONE</p>
                                <div class="quantity q-style1 me-5">
                                    <input type="text" class="qty-input" name="to_phone" id="to_phone" maxlength="11">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="from-place">
                            <div class="origin-place mb-30">
                                <p>PACKAGE WEIGHT</p>
                                <select name="p_weight" id="p_weight">
                                    <option value="1">1 Kg</option>
                                    <option value="2">2 Kg</option>
                                    <option value="3">3 Kg</option>
                                    <option value="4">4 Kg</option>
                                </select>
                            </div>
                            <input type="hidden" id="delivery_fee" name="delivery_fee" value="">
                            <input type="hidden" id="payment_ref" name="payment_ref" value="">
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="total-count-box mb-30 mt-30">
                            <h3 class="quotes-title">Total Cost: ₦ <span id="calculated_fee">0.00</span></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 text-md-end">
                        <div class="total-count-box mb-30 mt-30 mr-40">
                            <button type="submit" class="theme_btn black-btn rounded-1 shadow-none border-0">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include_once("inc/footer.nav.php"); ?>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    $(document).ready(function () {
        $(document).on("change", "#from_area,#to_area", function (e) {
            var from_area = $("#from_area").val();
            var to_area = $("#to_area").val();

            var from_state = $("#from_state").val();
            var to_state = $("#to_state").val();

            $("#calculated_fee").html("<i class='fa fa-spinner fa-pulse'></i>");

            $.ajax({
                url: "calculate-shipping-fee.php", type: "POST",
                data: {from_area,to_area,from_state,to_state},
                success: function (data) {
                    $("#calculated_fee").html((data.resp).toLocaleString());
                    $("#delivery_fee").val(data.resp);
                },
                error: function (errData) {},
                complete: function (data) {
                    $("#calculated_fee").html((data.responseText.resp).toLocaleString());
                    $("#delivery_fee").val(data.responseText.resp);
                }
            });
        });
    });
</script>
