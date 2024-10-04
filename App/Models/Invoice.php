<?php

namespace App\Models;

use Core\Model;
use PDO;

class Invoice extends Model
{
    protected $table = 'invoices';

    public function customerInInvoice($id)
    {
        return $this->query("SELECT SUM(amount) FROM $this->table WHERE customer_id=? AND type=?", [$id, 0])->first();
    }

    public function customerOutInvoice($id)
    {
        return $this->query("SELECT SUM(amount) FROM $this->table WHERE customer_id=? AND type=?", [$id, 1])->first();
    }

    public function create($customer_id, $amount, $description, $type, $date)
    {
        return $this->query("INSERT INTO $this->table(customer_id,amount,description,type,date) VALUES (?,?,?,?,?)", [$customer_id, $amount, $description, $type, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $customer_id, $amount, $description, $type, $date)
    {
        return $this->query("UPDATE $this->table SET customer_id=?, amount=?, description=?, type=?, date=? WHERE id=?", [$customer_id, $amount, $description, $type, $date, $id]);
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
