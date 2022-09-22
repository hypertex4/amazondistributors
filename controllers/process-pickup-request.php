<?php
// include headers
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once('config/database.php');
include_once('classes/Customer.class.php');

//create object for db
$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $from_country = $_POST['from_country'];
    $from_state = $_POST['from_state'];
    $from_area = $_POST['from_area'];
    $from_address = $_POST['from_address'];
    $from_fullname = $_POST['from_fullname'];
    $from_email = $_POST['from_email'];
    $from_phone = $_POST['from_phone'];
    $to_country = $_POST['to_country'];
    $to_state = $_POST['to_state'];
    $to_area = $_POST['to_area'];
    $to_address = $_POST['to_address'];
    $to_firstname = $_POST['to_firstname'];
    $to_lastname = $_POST['to_lastname'];
    $to_email = $_POST['to_email'];
    $to_phone = $_POST['to_phone'];
    $p_weight = $_POST['p_weight'];
    $p_amt = 0;
    if (($from_state == $to_state) && ($from_area == $to_area)) {
        $p_amt = $user->get_delivery_fee_by_area($from_area,$to_area);
    } elseif(($from_state == $to_state) && ($from_area != $to_area)) {
        $p_amt = $user->get_delivery_fee_by_area($from_area,$to_area);
        $amt = $user->get_delivery_fee_by_area($from_area,$to_area);
        if ($amt != 0) {
            $p_amt = $amt;
        } else {
            $p_amt = 2000;
        }
    } else {
        $p_amt = 2000;
    }
    $pay_sta = "Paid";
    $pay_ref = $_POST['payment_ref'];
    $pickup_id = rand(100000000,999999999);
    $_date = date("d-m-Y H:i:s");
    if (!empty($from_country) && !empty($from_state) && !empty($from_area) && !empty($from_address) && !empty($from_fullname) && !empty($from_phone) &&
        !empty($to_country) && !empty($to_state) && !empty($to_area) && !empty($to_address) && !empty($to_firstname) && !empty($to_lastname) &&
        !empty($to_email) && !empty($to_phone) && !empty($p_weight) && !empty($from_email)) {
        if ($user->create_pickup_request(
            $pickup_id,$from_country,$from_state,$from_area,$from_address,$from_fullname,$from_email,$from_phone,$to_country,
            $to_state,$to_area,$to_address,$to_firstname,$to_lastname,$to_email,$to_phone,$p_weight,$p_amt,$pay_ref,
            $pay_sta,$_date
        )) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Your Pickup Request have been successfully booked. Our customer support reach out shortly."));
        } else {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Failed to schedule pickup request"));
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status" => 0, "message" => "One or more required field empty."));
    }
} else {
    http_response_code(200);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}