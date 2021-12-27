<?php

require 'MerchantPayoutDetailsDbModal.php';
class MerchantPayoutDetails
{
    private $payoutDbModal;

    public function __construct() {
        require_once 'includes.php';
        $this->payoutDbModal = new MerchantPayoutDetailsDbModal();    
    }

    public function getMerchantsTotalPayoutDetails($merch_id)
    {
        if(is_numeric($merch_id) && $merch_id>0)
        {
            $result = $this->payoutDbModal->getMerchantPayout($merch_id);
            if(count($result)>0)
            {
                return $result;
            }
            return array();
        }
        return array();
    }

}