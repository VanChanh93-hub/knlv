<?php
require_once "Database.php";
class OrderModel {
    private $order;

    function __construct()
    {
        $this->order = new Database;
    }

    public function getOrder($id_user)
    {
        $sql = "SELECT 
                    o.id AS order_id,
                    o.orderdate,
                    o.totalprice,
                    o.status,
                    o.note,
                    o.address,
                    od.id_product,
                    od.price AS product_price,
                    od.quantity AS product_quantity,
                    p.image,
                    p.name
                FROM `orders` o
                INNER JOIN orders_detail od ON o.id = od.order_id
                INNER JOIN products p ON p.id = od.id_product
                WHERE o.id_user = ?
                ORDER BY o.orderdate DESC";

        return $this->order->getAll($sql, $id_user);
    }

    public function updateAddress($order_id, $new_address)
    {
        $sql = "UPDATE orders SET address = ? WHERE id = ?";
        return $this->order->update($sql, $new_address, $order_id);
    }

    public function updateStatus($order_id, $new_status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        return $this->order->update($sql, $new_status, $order_id);
    }
}

?>
