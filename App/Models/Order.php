<?php

namespace App\Models;

use Core\Model;
use PDO;

class Order extends Model
{
    protected $table = 'orders';

    public function create($customer_id, $company_name, $order_date, $products, $admin_id, $date)
    {
        return $this->query("INSERT INTO $this->table(customer_id,company_name,order_date,products,admin_id,date) VALUES (?,?,?,?,?,?)", [$customer_id, $company_name, $order_date, $products, $admin_id, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $customer_id, $company_name, $order_date, $products, $admin_id, $date)
    {
        return $this->query("UPDATE $this->table SET customer_id = :customer_id, company_name = :company_name, order_date = :order_date, products = :products, admin_id = :admin_id, date = :date WHERE id = :id", [':id' => $id, ':customer_id' => $customer_id, ':company_name' => $company_name, ':order_date' => $order_date, ':products' => $products, ':admin_id' => $admin_id, ':date' => $date]);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM $this->table WHERE id = ?", [$id]);
    }

    public function pagination($offset, $limit)
    {
        return $this->query("SELECT * FROM $this->table LIMIT $offset, $limit")->get();
    }
}
