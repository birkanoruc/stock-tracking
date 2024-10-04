<?php

namespace App\Models;

use Core\Model;
use PDO;

class Stock extends Model
{
    protected $table = 'stocks';

    public function totalInPrice()
    {
        return $this->query("SELECT SUM(price*quantity) FROM $this->table WHERE action_type=?", [0])->first();
    }

    public function totalOutPrice()
    {
        return $this->query("SELECT SUM(price*quantity) FROM $this->table WHERE action_type=?", [1])->first();
    }

    public function cashInStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE cash_id=? AND action_type=?", [$id, 0])->first();
    }

    public function cashOutStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE cash_id=? AND action_type=?", [$id, 1])->first();
    }

    public function productInStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE product_id=? AND action_type=?", [$id, 0])->first();
    }

    public function productOutStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE product_id=? AND action_type=?", [$id, 1])->first();
    }

    public function customerInStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE customer_id=? AND action_type=?", [$id, 0])->first();
    }

    public function customerOutStock($id)
    {
        return $this->query("SELECT SUM(price*quantity), SUM(price), SUM(quantity) FROM $this->table WHERE customer_id=? AND action_type=?", [$id, 1])->first();
    }

    public function create($product_id, $customer_id, $cash_id, $action_type, $quantity, $price, $date)
    {
        return $this->query("INSERT INTO $this->table(product_id,customer_id,cash_id,action_type,quantity,price,date) VALUES (?,?,?,?,?,?,?)", [$product_id, $customer_id, $cash_id, $action_type, $quantity, $price, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $product_id, $customer_id, $cash_id, $action_type, $quantity, $price, $date)
    {
        return $this->query("UPDATE $this->table SET product_id = :product_id, customer_id = :customer_id, cash_id = :cash_id, action_type = :action_type, quantity = :quantity, price = :price, date = :date WHERE id = :id", [':id' => $id, ':product_id' => $product_id, ':customer_id' => $customer_id, ':cash_id' => $cash_id, ':action_type' => $action_type, ':quantity' => $quantity, ':price' => $price, ':date' => $date]);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM $this->table WHERE id = ?", [$id]);
    }

    public function pagination($offset, $limit)
    {
        return $this->query("SELECT * FROM $this->table LIMIT $offset, $limit")->get();
    }

    public function filter($start_date, $end_date, $offset = null, $limit = null)
    {
        $query = "SELECT * FROM $this->table WHERE date BETWEEN :start_date AND :end_date GROUP BY product_id ";
        if ($offset !== null and $limit !== null) {
            $query .= "LIMIT $offset, $limit";
        }
        return $this->query($query, [":start_date" => $start_date, ":end_date" => $end_date])->get();
    }
}
