<?php

namespace App\Models;

use Core\Model;
use PDO;

class Cash extends Model
{
    protected $table = 'cashs';

    public function create($name, $date)
    {
        return $this->query("insert into $this->table(name,date) values (?,?)", [$name, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $name, $date)
    {
        return $this->query("UPDATE $this->table SET name=?, date=? WHERE id=?", [$name, $date, $id]);
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
