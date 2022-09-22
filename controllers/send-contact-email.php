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
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $date = date("d-m-Y H:i:s");
    if (!empty($fname) &&!empty($phone) &&!empty($email) &&!empty($message) &&!empty($date)) {
        if ($user->send_contact_us_mail($fname,$phone,$email,$message,$date)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Feedback well received, our customer support will get back to you shortly."));
        } else {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Could not send contact mail."));
        }
    } else {
        http_response_code(200);
        echo json_encode(array("status" => 0, "message" => "Fill all required field"));
    }
} else {
    http_response_code(200);
    echo json_encode(array("status" => 0, "message" => "Access Denied"));
}