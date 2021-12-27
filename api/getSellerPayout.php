<?php

require_once '../system/Authenticator.php';
require_once '../system/MerchantPayoutDetails.php';

if(isset($_GET['auk']))
{
    $apiKey = $_GET['auk'];
    $obj = new Authenticator();
    if($obj->keyIsValid($apiKey))
    {
        // Takes raw data from the request
        $json = file_get_contents('php://input');

        // Converts it into a PHP object
        $data = json_decode($json);

        if(count((array)$data)>0) {
            $merchObj = new MerchantPayoutDetails();
            $result = $merchObj->getMerchantsTotalPayoutDetails($data->company_id);
            if(!empty($result))
            {
                $op['code'] = 200;
                $op['msg'] = "Found";
                $op['details'] = $result;
                echo json_encode($op);
            }
            else 
            {
                $op['code'] = 200;
                $op['msg'] = "Not Payout Details exist for the merchant";
                $op['details'] = $result;
                echo json_encode($op);
            }
            
        }
        else 
        {
            $op['code'] = 404;
            $op['msg'] = "Not Found, Check Merchant Details";
            $op['details'] = array();
            echo json_encode($op);
        }
    }
}