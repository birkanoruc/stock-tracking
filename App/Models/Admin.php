<?php

namespace App\Models;

use App\Helpers\Session;
use Core\Model;
use PDO;

class Admin extends Model
{
    protected $table = 'admins';

    public function create($name, $surname, $email, $password, $permissions, $date)
    {
        return $this->query("INSERT INTO $this->table(name, surname, email, password, permissions, date) VALUES (?,?,?,?,?,?)", [$name, $surname, $email, $password, $permissions, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $name, $surname, $email, $password, $permissions, $image, $date)
    {
        return $this->query("UPDATE $this->table SET name=? , surname=?, email=?, password=?, permissions=?,image=?, date=? where id=?", [$name, $surname, $email, $password, $permissions, $image, $date, $id]);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM $this->table WHERE id = :id", [":id" => $id]);
    }

    public function pagination($offset, $limit)
    {
        return $this->query("SELECT * FROM $this->table LIMIT $offset, $limit")->get();
    }

    public function control($email, $password)
    {
        return $this->query("SELECT * FROM $this->table WHERE email = ? AND password = ?", [$email, $password])->rowCount();
    }
}
