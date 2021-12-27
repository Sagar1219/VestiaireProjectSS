<?php

require_once 'AuthenticatorDbModal.php';

class Authenticator
{
    private $dbClassObj;
    public function __construct() {
        require_once 'includes.php';
        $this->dbClassObj = new AuthenticatorDbModal();
    }

    public function keyIsValid($key)
    {
        if(!empty($key) || $key != '')
        {
            $result = $this->dbClassObj->checkIfTheKeyIsValid($key);
            if($result)
            {
                return true;
            }
            return false;
        }
        else 
        {
            return false;
        }
    }
}