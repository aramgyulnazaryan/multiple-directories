<?php

class Model
{
    protected $db;
    protected $table;
    protected $sql;

    public function __construct()
    {

    }

    public function getById($id)
    {
        $id = intval($id);
        if ($id) {
            $result = Db::getConnection()->query("SELECT * FROM $this->table WHERE id = '$id' ", PDO::FETCH_ASSOC);
            $data = $result->fetch();
            return $data;
        }
    }

    public function save($value = [])
    {
        $set = implode(" ,", array_keys($value));
        $value = implode("' ,'", array_values($value));

        $sql = "INSERT INTO $this->table ($set) VALUES ('$value')";

        $result = Db::getConnection()->query($sql);
        if ($result) {
            return TRUE;
        }
        return FALSE;

    }

    public function all()
    {
        $this->sql = "SELECT * FROM $this->table";
        return $this;
    }

    public function where($var1, $var2, $var3)
    {
        $this->sql = "SELECT * FROM $this->table WHERE $var1 $var2 '$var3' ";
        return $this;
    }

    public function get()
    {

        $result = Db::getConnection()->query($this->sql, PDO::FETCH_ASSOC);

        $result =  $result->fetchAll();
        return $result;
    }

}