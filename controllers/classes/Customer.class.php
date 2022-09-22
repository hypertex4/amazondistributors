<?php
$filepath = realpath(dirname(__FILE__));
require $filepath.'/../vendor/autoload.php';
use \Mailjet\Resources;

class Customer {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create_subscriber($email,$date) {
        $client_query = "INSERT INTO tbl_newsletters SET subscriber_email=?, subscriber_date=?";
        $client_obj = $this->conn->prepare($client_query);
        $client_obj->bind_param("ss",$email,$date);
        if ($client_obj->execute()){
            $this->send_newsletter_mail($email);
            return true;
        }
        return false;
    }

    public function check_news_subscriber_email($email){
        $email_query = "SELECT * FROM tbl_newsletters WHERE subscriber_email=?";
        $client_obj = $this->conn->prepare($email_query);
        $client_obj->bind_param("s", $email);
        if ($client_obj->execute()){
            $data = $client_obj->get_result();
            return $data->fetch_assoc();
        }
        return array();
    }

    public function send_newsletter_mail($email){
        $subject = "Amazon Distributors Newsletter";
        $content = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Newsletter</title>
    <style type='text/css'>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Saira+Extra+Condensed:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;padding-top: 0 !important;padding-bottom: 0 !important;margin:0 !important;width: 100% !important;
            -webkit-text-size-adjust: 100% !important;-ms-text-size-adjust: 100% !important;-webkit-font-smoothing: antialiased !important;
        }
        .tableContent img {border: 0 !important;display: block !important;outline: none !important;}
        a{color:#382F2E;}
        p, h1{color:#382F2E;margin:0;}
        p{text-align:left;color:#999999;font-size:14px;font-weight:normal;line-height:19px;}
        a.link1{color:#382F2E;}
        a.link2{font-size:16px;text-decoration:none;color:#ffffff;}
        h2{text-align:left;color:#222222;font-size:19px;font-weight:normal;}
        div,p,ul,h1{margin:0;}
        .bgBody{background: #ffffff;}
        .bgItem{background: #ffffff;}
        @media only screen and (max-width:480px) {
            table[class='MainContainer'], td[class='cell'] {
                width: 100% !important;height:auto !important;
            }
            td[class='specbundle'] {
                width:100% !important;float:left !important;font-size:13px !important;
                line-height:17px !important;display:block !important;padding-bottom:15px !important;
            }
            td[class='spechide'] {display:none !important;}
            img[class='banner'] {width: 100% !important;height: auto !important;}
            td[class='left_pad'] {padding-left:15px !important;padding-right:15px !important;}
        }
        @media only screen and (max-width:540px) {
            table[class='MainContainer'], td[class='cell'] {width: 100% !important;height:auto !important;}
            td[class='specbundle'] {
                width:100% !important;float:left !important;font-size:13px !important;
                line-height:17px !important;display:block !important;padding-bottom:15px !important;
            }
            td[class='spechide'] {display:none !important;}
            img[class='banner'] {width: 100% !important;height: auto !important;}
            .font {font-size:18px !important;line-height:22px !important;}
            .font1 {font-size:18px !important;line-height:22px !important;}
        }
    </style>
    <script type='colorScheme' class='swatch active'>
        {'name':'Default','bgBody':'ffffff','link':'382F2E','color':'999999','bgItem':'ffffff','title':'222222'}
    </script>
</head>
<body paddingwidth='0' paddingheight='0'   style='padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
<table bgcolor='#ffffff' width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent' align='center'  style='font-family:\"Poppins\", sans-serif;'>
    <tbody>
    <tr>
        <td><table width='600' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#ffffff' class='MainContainer'>
            <tbody>
            <tr>
                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                    <tbody>
                    <tr>
                        <td valign='top' width='40'>&nbsp;</td>
                        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tbody>
                            <tr><td height='75' class='spechide'></td></tr>
                            <tr>
                                <td class='movableContentContainer ' valign='top'>
                                    <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                            <tbody>
                                            <tr><td height='35'></td></tr>
                                            <tr>
                                                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                    <tbody>
                                                    <tr>
                                                        <td valign='top' align='center' class='specbundle'>
                                                            <div class='contentEditableContainer contentTextEditable'>
                                                                <div class='contentEditable'>
                                                                    <img src='https://i.ibb.co/1J1MSnV/header-logo-one.png' data-default='placeholder' data-max-width='560' alt='header-logo-one' border='0'>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                                            <tr><td height='20'></td></tr>
                                            <tr>
                                                <td align='left'>
                                                    <div class='contentEditableContainer contentTextEditable'>
                                                        <div class='contentEditable' align='center'>
                                                            <h2>Congratulations ! !!</h2>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr><td height='15'> </td></tr>
                                            <tr>
                                                <td align='left'>
                                                    <div class='contentEditableContainer contentTextEditable'>
                                                        <div class='contentEditable' align='center'>
                                                            <p >
                                                                Thanks for signing up to receive our latest news & updates. As a new member you'll enjoy:
                                                                <span style='font-style:italic;'>
                                                                    special offers and exclusive deals | Food delivery news | Global logistics news
                                                                </span>
                                                                <br><br><br><br>
                                                                Have questions? Get in touch with us via Facebook or Twitter, or email our support team.
                                                                <br><br>
                                                                Cheers,<br>
                                                                <span style='color:#222222;'>AmazonDistributors Team</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr><td height='30'></td></tr>
                                        </table>
                                    </div>
                                    <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                            <tbody>
                                            <tr><td height='65'></tr>
                                            <tr><td  style='border-bottom:1px solid #DDDDDD;'></td></tr>
                                            <tr><td height='25'></td></tr>
                                            <tr>
                                                <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                    <tbody>
                                                    <tr>
                                                        <td valign='top' class='specbundle'><div class='contentEditableContainer contentTextEditable'>
                                                            <div class='contentEditable' align='center'>
                                                                <p  style='text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;'>
                                                                    <span style='font-weight:bold;'>AMAZON DISTRIBUTORS</span>
                                                                    <br>
                                                                    13b Charles Ifeanyi street,<br>
                                                                    Off Adebayo Doherty (Road 14),<br>
                                                                    Lekki Phase 1, Lagos.
                                                                    <br>
                                                                </p>
                                                            </div>
                                                        </div></td>
                                                        <td valign='top' width='30' class='specbundle'>&nbsp;</td>
                                                        <td valign='top' class='specbundle'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                            <tbody>
                                                            <tr>
                                                                <td valign='top' width='52'>
                                                                    <div class='contentEditableContainer contentFacebookEditable'>
                                                                        <div class='contentEditable'>
                                                                            <a target='_blank' href='https://facebook.com/AMZDistributors'>
                                                                                <img src='https://i.ibb.co/64BBszG/facebook.png' border='0' width='52' height='53' alt='facebook icon'
                                                                                     data-default='placeholder' data-max-width='52' data-customIcon='true'>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td valign='top' width='1'>&nbsp;</td>
                                                                <td valign='top' width='52'>
                                                                    <div class='contentEditableContainer contentTwitterEditable'>
                                                                        <div class='contentEditable'>
                                                                            <a target='_blank' href='https://twitter.com/AmzDistributors'>
                                                                                <img src='https://i.ibb.co/q923P9Q/twitter.png'  border='0' width='52' height='53' alt='twitter icon'
                                                                                     data-default='placeholder' data-max-width='52' data-customIcon='true'>
                                                                            </a>
                                                                        </div>
                                                                    </div>
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
                                            <tr><td height='88'></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                        <td valign='top' width='40'>&nbsp;</td>
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
</html>
";
        $mailHeaders ="MIME-Version: 1.0"."\r\n";
        $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
        $mailHeaders .= "From: AmazonDistributors <".$email.">\r\n";
        if (mail($email, $subject, $content, $mailHeaders)) {
            return true;
        }
        return false;
    }

    public function send_contact_us_mail($fname,$phone,$email,$message,$date){
        $toEmail = 'amzdistributors@hotmail.com';
        $subject = "Amazon Distributors - Contact feedback";
        $content = "<html>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Amazon Distributors</title>
                            <style>
                                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Saira+Extra+Condensed:wght@400;500;600;700;800&display=swap');
                                body {font-family:  'Poppins', sans-serif;font-weight: 400}
                                .wrapper {max-width: 600px;margin: 0 auto}
                                .company-name {text-align: left}
                                table {width: 80%;}
                            </style>
                        </head>
                        <body>
                        <div class='wrapper'>
                            <table>
                                <thead>
                                    <tr><th class='table-head' colspan='4'><h1 class='company-name'>Amazon Distributors</h1></th></tr>
                                </thead>
                                <tbody>
                                    <div class='mt-3'>
                                        <p>Hi, Admin</p>
                                        <p>".$email."(".$fname.") with mobile number ".$phone.", send the following contact message: </p>
                                        <p>".$message."</p>
                                        <p>Date: ".$date."</p>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                        </body>
                        </html>";
        $mailHeaders ="MIME-Version: 1.0"."\r\n";
        $mailHeaders .="Content-type:text/html;charset=UTF-8"."\r\n";
        $mailHeaders .= "From: Amazon Distributors <".$email.">\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            return true;
        }
        return false;
    }

    public function send_pickup_request_mail(
        $from_area,$from_address,$from_fullname,$from_email,$to_area,$to_address,$to_firstname,
        $to_lastname,$to_email,$to_phone,$p_amt,$pay_ref,$pickup_id
    ){
        $mj = new \Mailjet\Client('c5f68cf9bcf61e4f7cd2fef54daab915','e0b0aa2db5fe85065fd74095924f1942',true,['version' => 'v3.1']);
        $body = ['Messages' => [[
            'From' => ['Email' => "support@amazondistributors.com.ng", 'Name' => "Amazon Distributors"],
            'To' => [
                [
                    'Email' => $from_email, 'Name' => $from_fullname
                ]
            ],
			//'Cc' => [
               // [
                  //  "Email" => "amzdistributors@hotmail.com",
                 //   "Name" => "Amazon Distributors Support"
               // ]
            //],
            'Subject' => "Amazon Distributors - Pickup Receipt",
            'HTMLPart' => "
                <!DOCTYPE html>
                    <html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
                    <head>
                        <title></title>
                        <meta charset='utf-8'/>
                        <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
                        <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
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
                                                        <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                            <tr>
                                                                <td style='padding-left:40px;padding-right:40px;width:100%;'>
                                                                    <div align='center' style='line-height:10px'><img alt='Success' src='https://i.ibb.co/WvHrQ3Q/check-mark-removebg-preview.png' style='display: block; height: auto; border: 0; width: 160px; max-width: 100%;' title='Sucess' width='160'/></div>
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
                                                        <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                            <tr>
                                                                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                    <div style='font-family: sans-serif'>
                                                                        <div style='font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                            <p style='margin: 0; font-size: 16px; text-align: center;'><span style='font-size:30px;color:#2b303a;'><strong>Thank you for the payment</strong></span></p>
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
                                                                            <p style='margin: 0; font-size: 14px; text-align: center;'>Hi ".$from_fullname.", this is a confirmation that we’ve just received your online payment for your delivery
                                                                                <span id='166c679c-c52f-47e0-ab65-2830067c661d' style=''>@ ".$to_address.", ".$to_area."</span>. Thank you for trusting us. Our esteem team will reach out to you shortly</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                            <tr>
                                                                <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                                                                    <div style='font-family: sans-serif'>
                                                                        <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 21px;'><span style='font-size:16px;'><span style='font-size:16px;'><strong>Delivery Details </strong></span></span></p>
                                                                            <p style='margin-bottom: 7px; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Pickup ID</strong>: #".$pickup_id."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Sender Name</strong>: ".$from_fullname."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Sender Address</strong>: ".$from_address.", ".$from_area."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Receiver Name</strong>: ".$to_firstname." ".$to_lastname."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Receiver Address</strong>: ".$to_address." ".$to_area."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Receiver Email</strong>: ".$to_email."</span></p>
                                                                            <p style='margin: 0; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:14px;'><strong>Receiver Phone</strong>: ".$to_phone."</span></p>
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
                                <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-5' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                                <tbody>
                                                <tr>
                                                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top;' width='50%'>
                                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                            <tr>
                                                                <td style='width:20px;background-color:#FFF'> </td>
                                                                <td style='background-color:#f3fafa;border-right:8px solid #FFF;border-top:0px;border-bottom:0px;width:300px;'>
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
                                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                        <tr>
                                                                            <td style='padding-bottom:40px;padding-left:5px;padding-right:5px;padding-top:35px;'>
                                                                                <div style='font-family: sans-serif'>
                                                                                    <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                                        <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 18px;'><span style='color:#a2a9ad;font-size:12px;'><strong>PAYMENT REFERENCE</strong></span></p>
                                                                                        <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 30px;'><span style='color:#2b303a;font-size:20px;'><strong>#".$pay_ref."</strong></span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top;' width='50%'>
                                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                                            <tr>
                                                                <td style='background-color:#f3fafa;border-left:8px solid #FFF;border-top:0px;border-bottom:0px;width:300px;'>
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
                                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                        <tr>
                                                                            <td style='padding-bottom:40px;padding-left:5px;padding-right:5px;padding-top:35px;'>
                                                                                <div style='font-family: sans-serif'>
                                                                                    <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                                        <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 18px;'><span style='color:#a2a9ad;font-size:12px;'><strong>TOTAL</strong></span></p>
                                                                                        <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 30px;'><span style='color:#2b303a;font-size:20px;'><strong>₦".number_format($p_amt,2)."</strong></span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td style='width:20px;background-color:#FFF'> </td>
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
                                                                <td style='padding-bottom:12px;padding-top:60px;'>
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

    public function send_pickup_request_mail_to_receiver(
        $from_area,$from_address,$from_fullname,$from_email,$to_area,$to_address,$to_firstname,
        $to_lastname,$to_email,$to_phone,$p_amt,$pay_ref,$pickup_id
    ){
        $mj = new \Mailjet\Client('c5f68cf9bcf61e4f7cd2fef54daab915','e0b0aa2db5fe85065fd74095924f1942',true,['version' => 'v3.1']);
        $body = ['Messages' => [[
            'From' => ['Email' => "support@amazondistributors.com.ng", 'Name' => "Amazon Distributors"],
            'To' => [
                [
                    'Email' => $to_email,
                    'Name' => $to_firstname." ".$to_lastname
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
                    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
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
                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;'>
                                                                <div style='font-family: sans-serif'>
                                                                    <div style='font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                        <p style='margin: 0; font-size: 16px; text-align: center;'><span style='font-size:30px;color:#2b303a;'><strong>Hi ".$to_firstname.",</strong></span></p>
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
                                                                        <p style='margin: 0; font-size: 14px; text-align: center;'>This is the confirmation that you have a pickup with Amazon Distributors, Our Dispatch team will reach out to you shortly. Below is the pickup Details</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                        <tr>
                                                            <td style='padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:20px;'>
                                                                <div style='font-family: sans-serif'>
                                                                    <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Sender Name</strong>: ".$from_fullname."</span></p>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Sender Address</strong>: ".$from_address.", ".$from_area."</span></p>
                                                                        <p style='margin-top: 10px; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'></p>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Receiver Name</strong>: ".$to_firstname." ".$to_lastname."</span></p>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Receiver Address</strong>: ".$to_address." ".$to_area."</span></p>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Receiver Email</strong>: ".$to_email."</span></p>
                                                                        <p style='margin: 0; font-size: 16px; text-align: left; mso-line-height-alt: 22.5px;'><span style='font-size:15px;'><strong>Receiver Phone</strong>: ".$to_phone."</span></p>
                                                                        <p style='margin-top: 15px; font-size: 15px; text-align: left; mso-line-height-alt: 22.5px;'>
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
                            <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-5' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                                <tbody>
                                <tr>
                                    <td>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;' width='640'>
                                            <tbody>
                                            <tr>
                                                <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top;' width='50%'>
                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;margin: 0 auto' width='60%';>
                                                        <tr>
                                                            <td style='width:20px;background-color:#FFF'> </td>
                                                            <td style='background-color:#f3fafa;border-right:8px solid #FFF;border-top:0px;border-bottom:0px;width:300px;'>
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
                                                                <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                                                                    <tr>
                                                                        <td style='padding-bottom:40px;padding-left:5px;padding-right:5px;padding-top:35px;'>
                                                                            <div style='font-family: sans-serif'>
                                                                                <div style='font-size: 12px; mso-line-height-alt: 18px; color: #555555; line-height: 1.5; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;'>
                                                                                    <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 18px;'><span style='color:#a2a9ad;font-size:12px;'><strong>PICKUP ID</strong></span></p>
                                                                                    <p style='margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 30px;'><span style='color:#2b303a;font-size:20px;'><strong>#".$pickup_id."</strong></span></p>
                                                                                </div>
                                                                            </div>
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
                                                            <td style='padding-bottom:12px;padding-top:60px;'>
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

    public function create_pickup_request(
        $pickup_id,$from_country,$from_state,$from_area,$from_address,$from_fullname,$from_email,$from_phone,$to_country,
        $to_state,$to_area,$to_address,$to_firstname,$to_lastname,$to_email,$to_phone,$p_weight,$p_amt,$pay_ref,$pay_sta,$_date
    ){
        $pick_query = "INSERT INTO tbl_pickup_request 
                        SET pickup_id=?,from_country=?,from_state=?,from_area=?,from_address=?,from_fullname=?,from_email=?,from_phone=?,to_country=?,
                        to_state=?,to_area=?,to_address=?,to_firstname=?,to_lastname=?,to_email=?,to_phone=?,p_weight=?,p_amount=?,p_created_on=?";
        $pick_obj = $this->conn->prepare($pick_query);
        $pick_obj->bind_param(
            "ssssssssssssssssids",
            $pickup_id,$from_country,$from_state,$from_area,$from_address,$from_fullname,$from_email,$from_phone,$to_country,
            $to_state,$to_area,$to_address,$to_firstname,$to_lastname,$to_email,$to_phone,$p_weight,$p_amt,$_date
            );
        if ($pick_obj->execute()){
            if ($this->create_pickup_payment($pickup_id,$p_amt,$pay_ref,$pay_sta)) {
                if(
					$this->send_pickup_request_mail(
						$from_area,$from_address,$from_fullname,$from_email,$to_area,$to_address,$to_firstname,$to_lastname,$to_email,$to_phone,
						$p_amt,$pay_ref,$pickup_id
					) && 
					$this->send_pickup_request_mail_to_receiver(
						$from_area,$from_address,$from_fullname,$from_email,$to_area,$to_address,$to_firstname,$to_lastname,$to_email,$to_phone,
						$p_amt,$pay_ref,$pickup_id
					)
				) {
					return true;
				}
				return false;
            }
            return false;
        }
        return false;
    }

    public function create_pickup_payment($pickup_id,$amount,$payment_ref,$payment_status){
        $query = "INSERT INTO tbl_payments SET pickup_id=?,payment_amount=?,payment_ref=?,payment_status=?";
        $inserted_obj = $this->conn->prepare($query);
        $inserted_obj->bind_param("sdss",$pickup_id,$amount,$payment_ref,$payment_status);
        $inserted_obj->execute();
        if ($inserted_obj->affected_rows > 0){
            return true;
        }
        return false;
    }

    public function list_distinct_country(){
        $c_query = "SELECT DISTINCT loc_country FROM tbl_locations";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()) {
            return $c_obj->get_result();
        }
        return array();
    }

    public function list_distinct_state(){
        $c_query = "SELECT DISTINCT loc_state FROM tbl_locations";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()) {
            return $c_obj->get_result();
        }
        return array();
    }

    public function list_distinct_area(){
        $c_query = "SELECT DISTINCT loc_area FROM tbl_locations";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()) {
            return $c_obj->get_result();
        }
        return array();
    }

    public function list_distinct_area_dest(){
        $c_query = "SELECT DISTINCT loc_area_dest FROM tbl_locations";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()) {
            return $c_obj->get_result();
        }
        return array();
    }

    public function get_delivery_fee_by_area($from_area,$to_area){
        $c_query = "SELECT loc_amount as myAmt FROM tbl_locations 
                    WHERE (loc_area='$from_area' AND loc_area_dest='$to_area') OR loc_area_dest='$from_area' AND loc_area='$to_area'";
        $c_obj = $this->conn->prepare($c_query);
        if ($c_obj->execute()) {
            $data = $c_obj->get_result()->fetch_assoc();
            return $data['myAmt'];
        }
        return 0;
    }

}

?>