<?php

namespace App\Models;

use Core\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function totalCustomer()
    {
        return $this->query("SELECT * FROM $this->table")->rowCount();
    }

    public function create($name, $surname, $email, $phone, $address, $note, $company, $date)
    {
        return $this->query("INSERT INTO $this->table(name,surname,email,phone,address,note,company,date) VALUES (?,?,?,?,?,?,?,?)", [$name, $surname, $email, $phone, $address, $note, $company, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $name, $surname, $email, $phone, $address, $note, $company, $date)
    {
        return $this->query("UPDATE $this->table SET name=?,surname=?,email=?,phone=?,address=?,note=?,company=?,date=? WHERE id=?", [$name, $surname, $email, $phone, $address, $note, $company, $date, $id]);
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
