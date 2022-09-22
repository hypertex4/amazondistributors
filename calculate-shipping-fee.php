<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once('controllers/config/database.php');
include_once('controllers/classes/Customer.class.php');

$db = new Database();
$connection = $db->connect();
$user = new Customer($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $from_state = $_POST['from_state'];
    $from_area = $_POST['from_area'];

    $to_state = $_POST['to_state'];
    $to_area = $_POST['to_area'];
    $amount = 0;

    if (!empty($from_state) && !empty($from_area) && !empty($to_state) && !empty($to_area)) {
        if (($from_state == $to_state) && ($from_area == $to_area)) {
            $amount = $user->get_delivery_fee_by_area($from_area,$to_area);
        } elseif(($from_state == $to_state) && ($from_area != $to_area)) {
            $amt = $user->get_delivery_fee_by_area($from_area,$to_area);
            if ($amt != 0) {
                $amount = $amt;
            } else {
                $amount = 2000;
            }
        } else {
          $amount = 2000;
        }

        http_response_code(200);
        echo json_encode(array("status"=>0,"resp"=>$amount,"message"=>"retrieved"));
    } else {
        http_response_code(200);
        echo json_encode(array("status"=>0,"resp"=>$amount,"message"=>"One or more required field empty."));
    }
}
?>