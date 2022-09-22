<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");
include_once('../controllers/classes/Admin.class.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (trim($data->action_code) == '401' && !empty(trim($data->username))) {
        if ($admin->create_admin_user($data->username,$data->password)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin User successfully created."));
        } else  {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to Create User."));
        }
    }

    if (trim($data->action_code) == '402' && !empty(trim($data->admin_id))) {
        if ($admin->delete_admin_user($data->admin_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin user deleted successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to delete user."));
        }
    }

    if (trim($data->action_code) == '403' && !empty(trim($data->edit_adm_username))) {
        if ($admin->update_admin_user($data->edit_adm_username,$data->edit_adm_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Admin user updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update user."));
        }
    }

    if (trim($data->action_code) == '604') {
        if ($admin->update_product_status($data->pid,$data->status)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Product status updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update product status."));
        }
    }

    if (trim($data->action_code) == '902') {
        $date = date("d/m/Y H:i:s");
        if ($admin->add_area_location($data->loc_area,$data->loc_area_dest,$data->loc_state,$data->loc_country,$data->loc_amt,$date)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Location (Area) added successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to add location."));
        }
    }
    if (trim($data->action_code) == '901') {
        if ($admin->update_area_location($data->edit_loc_id,$data->edit_loc_area,$data->edit_loc_area_dest,$data->edit_loc_state,$data->edit_loc_country,$data->edit_loc_amt)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Location (Area) updated successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to update location."));
        }
    }
    if (trim($data->action_code) == '903') {
        if ($admin->delete_area_location($data->loc_id)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Location (Area) deleted successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("status" => 0, "message" => "Unable to delete location."));
        }
    }
    if (trim($data->action_code) == '905') {
        if ($admin->update_order_status($data->pickup_id,$data->status,$data->s_email,$data->s_name)) {
            http_response_code(200);
            echo json_encode(array("status" => 1, "message" => "Pickup status updated successfully."));
        } else {
            http_response_code(200);
            echo json_encode(array("status" => 0, "message" => "Unable to update pickup status."));
        }
    }

}