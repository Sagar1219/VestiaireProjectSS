<?php
require_once 'DBConnect.php';

class AuthenticatorDbModal extends DBConnect
{
    private $authDbObj;
    public function __construct() {
        $this->authDbObj = $this->getPDO();
    }

    public function checkIfTheKeyIsValid($key)
    {
        $sql    = "SELECT count(1) as count FROM vest_api_keys WHERE api_keys = :api_key LIMIT 1";
        $stmt   = $this->authDbObj->prepare($sql);
        $stmt->bindParam(":api_key",$key);
        $stmt->execute();
        //$stmt->debugDumpParams();
        return $stmt->fetchColumn();
    }
}