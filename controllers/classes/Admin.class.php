<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/database.php');
require $filepath.'/../vendor/autoload.php';
use \Mailjet\Resources;


class Admin
{
    public $conn;
    private $tbl_admin;

    //constructor
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
        $this->tbl_admin = "tbl_admin_users";
    }

    public function create_admin_user($a_username,$a_password){
        $admin_query = "SELECT * FROM tbl_admin_users WHERE admin_username='$a_username'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            $data = $admin_obj->get_result()->num_rows;
            if ($data > 0){
                return false;
            } else {
                $pass = md5($a_password);
                $admin_query = "INSERT INTO tbl_admin_users SET admin_username='$a_username',admin_password='$pass'";
                $admin_obj = $this->conn->prepare($admin_query);
                if ($admin_obj->execute()){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function list_admin_users(){
        $adm_query = "SELECT * FROM tbl_admin_users";
        $adm_obj = $this->conn->prepare($adm_query);
        if ($adm_obj->execute()) {
            return $adm_obj->get_result();
        }
        return array();
    }

    public function delete_admin_user($adm_id){
        $del_query = "DELETE FROM tbl_admin_users WHERE admin_id=$adm_id";
        $del_obj = $this->conn->prepare($del_query);
        if ($del_obj->execute()){
            if ($del_obj->affected_rows > 0){ return true; }
            return false;
        }
        return false;
    }

    public function update_admin_user($user,$admin_id){
        $product_query = "UPDATE tbl_admin_users SET admin_username='$user' WHERE admin_id=$admin_id";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function list_news_subscribers(){
        $news_query = "SELECT * FROM tbl_newsletters";
        $news_obj = $this->conn->prepare($news_query);
        if ($news_obj->execute()) {
            return $news_obj->get_result();
        }
        return array();
    }

    public function list_location_areas(){
        $news_query = "SELECT * FROM tbl_locations";
        $news_obj = $this->conn->prepare($news_query);
        if ($news_obj->execute()) {
            return $news_obj->get_result();
        }
        return array();
    }

    public function add_area_location($area,$area_dest,$s,$c,$amt,$date){
        $admin_query = "INSERT INTO tbl_locations SET loc_area='$area',loc_area_dest='$area_dest',loc_state='$s',loc_country='$c',loc_amount='$amt',loc_created_on='$date'";
        $admin_obj = $this->conn->prepare($admin_query);
        if ($admin_obj->execute()){
            return true;
        }
        return false;
    }

    public function update_area_location($loc_id,$area,$area_dest,$s,$c,$amt){
        $product_query = "UPDATE tbl_locations SET loc_area='$area',loc_area_dest='$area_dest',loc_state='$s',loc_country='$c',loc_amount='$amt' WHERE loc_id=$loc_id";
        $product_obj = $this->conn->prepare($product_query);
        if ($product_obj->execute()){
            if ($product_obj->affected_rows > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function delete_area_location($loc_id){
        $del_query = "DELETE FROM tbl_locations WHERE loc_id=$loc_id";
        $del_obj = $this->conn->prepare($del_query);
        if ($del_obj->execute()){
            if ($del_obj->affected_rows > 0){ return true; }
            return false;
        }
        return false;
    }

    public function count_all_pickup(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_pickup_request"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function today_booking_amt(){
        $amt_query = "SELECT SUM(p_amount) as myAmt FROM tbl_pickup_request WHERE p_created_on > DATE_SUB(NOW(), INTERVAL 1 DAY)";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return 0;
    }

    public function month_booking_amt(){
        $amt_query = "SELECT SUM(p_amount) as myAmt FROM tbl_pickup_request WHERE p_created_on > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return 0;
    }

    public function total_booking_amt(){
        $amt_query = "SELECT SUM(p_amount) as myAmt FROM tbl_pickup_request";
        $amt_obj = $this->conn->prepare($amt_query);
        if ($amt_obj->execute()) {
            $data= $amt_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return 0;
    }

    public function list_latest_five_pickup_request(){
        $order_query = "SELECT * FROM tbl_pickup_request ORDER BY pickup_sno DESC LIMIT 10";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function list_pickup_request(){
        $order_query = "SELECT * FROM tbl_pickup_request r INNER JOIN tbl_payments p ON p.pickup_id = r.pickup_id ORDER BY r.pickup_sno DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function update_order_status($pickup_id,$p_status,$s_email,$s_name){
        $order_query = "UPDATE tbl_pickup_request SET pickup_status='$p_status' WHERE pickup_id='$pickup_id'";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            if ($this->send_pickup_status_update($pickup_id,$p_status,$s_email,$s_name)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function pickup_request_by_id($order_id){
        $order_query = "SELECT * FROM tbl_pickup_request WHERE pickup_id=?";
        $order_obj = $this->conn->prepare($order_query);
        $order_obj->bind_param("i",$order_id);
        if ($order_obj->execute()) {
            $data = $order_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function payments(){
        $order_query = "SELECT * FROM tbl_payments p INNER JOIN tbl_pickup_request o ON o.pickup_id=p.pickup_id ORDER by p.payment_id DESC";
        $order_obj = $this->conn->prepare($order_query);
        if ($order_obj->execute()) {
            return $order_obj->get_result();
        }
        return array();
    }

    public function count_new_pickup(){
        $cnt = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM tbl_pickup_request WHERE pickup_status='New Pickup'"));
        if ($cnt > 0) return $cnt;
        return 0;
    }

    public function send_pickup_status_update($pickup_id,$status,$s_email,$s_name){
        $mj = new \Mailjet\Client('c5f68cf9bcf61e4f7cd2fef54daab915','e0b0aa2db5fe85065fd74095924f1942',true,['version' => 'v3.1']);
        $body = ['Messages' => [[
            'From' => ['Email' => "support@amazondistributors.com.ng", 'Name' => "Amazon Distributors"],
            'To' => [
                [
                    'Email' => $s_email,
                    'Name' => $s_name
                ]
            ],
            'Subject' => "Amazon Distributors - Pickup Receipt",
            'HTMLPart' => "
                <!DOCTYPE html>
                <html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
                <head>
                    <title></title>
                    <meta charset='utf-8'/>
                    <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
                    <style>
                        * {box-sizing: border-box;}
                        body {margin: 0;padding: 0;}
                        a[x-apple-data-detectors] {color: inherit !important;text-decoration: inherit !important;}
                        #MessageViewBody a {color: inherit;text-decoration: none;}
                        p {line-height: inherit}
                        @media (max-width:660px) {
                            .icons-inner {text-align: center;}
                            .icons-inner td {margin: 0 auto;}
                            .row-content {width: 100% !important;}
                            .stack .column {width: 100%;display: block;}
                        }
                    </style>
                </head>
                <body style='background-color: #f8f8f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
                <table border='0' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9;' width='100%'>
                    <tbody>
                    <tr>
                        <td>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1aa19c;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1aa19c; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #fba405;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:25px;padding-top:22px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                <div align='center' style='line-height:10px'><img alt='Logo' src='https://i.ibb.co/1J1MSnV/header-logo-one.png' style='display: block; height: auto; border: 0; width: 100px; max-width: 100%;' title='Logo' width='100'/></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-3' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='20' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-4' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:12px;padding-top:30px;'>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                <div style='font-family: sans-serif'>
                                                                    <div style='font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                        <p style='margin: 0; font-size: 16px; text-align: center;'><span style='font-size:30px;color:#2b303a;'><strong>Order Number: #".$pickup_id."</strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                <div style='font-family: sans-serif'>
                                                                    <div style='font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 18px; color: #555555; line-height: 1.5;'>
                                                                        <p style='margin: 0; font-size: 14px; text-align: center;'>
                                                                            Hello ".$s_name.", 
                                                                        </p>
                                                                        <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'>
                                                                            We're happy to let you know that we’ve received your shipment and is now <b style='color:#1aa19c;'>".$status."</b>.
                                                                        </p>
                                                                        <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'>
                                                                            If you have any questions, contact us or call us on 08078191642
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                   
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-top:50px;'>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                           
                           
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-6' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:12px;padding-top:10px;'>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-7' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='20' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-8' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #2b303a; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 4px solid #fba405;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='social_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:28px;text-align:center;'>
                                                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='social-table' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='104px'>
                                                                    <tr>
                                                                        <td style='padding:0 10px 0 10px;'><a href='https://www.facebook.com/AMZDistributors' target='_blank'><img alt='Facebook' height='32' src='https://i.ibb.co/JcxsdJ3/facebook2x.png' style='display: block; height: auto; border: 0;' title='Facebook' width='32'/></a></td>
                                                                        <td style='padding:0 10px 0 10px;'><a href='https://twitter.com/AmzDistributors' target='_blank'><img alt='Twitter' height='32' src='https://i.ibb.co/cxjFVNH/twitter2x.png' style='display: block; height: auto; border: 0;' title='Twitter' width='32'/></a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='divider_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                <div align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #555961;'><span> </span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:30px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                                                                <div style='font-family: sans-serif'>
                                                                    <div style='font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;'>
                                                                        <p style='margin: 0; font-size: 14px; text-align: left;'><span style='color:#95979c;font-size:12px;'>Amazon Distributors Copyright © 2021</span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-9' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='icons_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                        <tr>
                                                            <td style='color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;'>
                                                                <table cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                                    <tr>
                                                                        <td style='text-align:center;'>
                                                                            <table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </body>
                </html>",
        ]]];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        if ($response->success()){
            return true;
        }
        return false;
    }

}

$admin = new Admin();
?>