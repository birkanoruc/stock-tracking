<?php

namespace App\Models;

use Core\Model;
use PDO;

class Product extends Model
{
    protected $table = 'products';

    public function totalProduct()
    {
        return $this->query("SELECT * FROM $this->table")->rowCount();
    }

    public function search($name = null, $offset = null, $limit = null)
    {
        $query = "SELECT * FROM $this->table ";
        $params = [];

        if ($name === null) {
            $query .= "ORDER BY id DESC LIMIT 10";
        } else {
            $query .= "WHERE name LIKE :name ";
            $params[':name'] = '%' . $name . '%';
        }

        if ($offset !== null && $limit !== null) {
            $query .= " LIMIT $offset, $limit";
        }

        return $this->query($query, $params)->get();
    }

    public function create($name, $category_id, $attributes, $date)
    {
        return $this->query("INSERT INTO $this->table(name,category_id,attributes,date) VALUES (?,?,?,?)", [$name, $category_id, $attributes, $date]);
    }

    public function all()
    {
        return $this->query("SELECT * FROM $this->table")->get();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM $this->table WHERE id=:id", [":id" => $id])->first();
    }

    public function update($id, $name, $category_id, $attributes, $date)
    {
        return $this->query("UPDATE $this->table SET name=:name,category_id=:category_id,attributes=:attributes, date=:date WHERE id=:id", [":id" => $id, ":name" => $name, ":category_id" => $category_id, ":attributes" => $attributes, ":date" => $date]);
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
