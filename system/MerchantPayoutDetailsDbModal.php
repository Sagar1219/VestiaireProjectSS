<?php
require_once 'DBConnect.php';

class MerchantPayoutDetailsDbModal extends DBConnect
{
    private $merchDbObj;
    public function __construct() {
        $this->merchDbObj = $this->getPDO();
    }

    public function getMerchantPayout($merchantId)
    {
        $sql = "SELECT 
                    SUM(total_price) AS total,
                    vo.item_id,
                    vi.item_name,
                    vc.currency_name,
                    linked_by_seller_ref
                FROM
                    vest_orders vo
                        INNER JOIN
                    vest_items vi ON vo.item_id = vi.item_id
                        INNER JOIN
                    vest_currencies vc ON vc.id = vi.price_currency
                WHERE
                    linked_by_seller_ref = :merchant_id
                GROUP BY vo.item_id;";
        $stmt = $this->merchDbObj->prepare($sql);
        $stmt->bindParam(":merchant_id",$merchantId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}