<?php namespace App\Model;

class DocModel extends Model
{
    public $sql_create = "CREATE TABLE IF NOT EXISTS doc (id INTEGER PRIMARY KEY, title VARCHAR(50), message TEXT);";
    public $sql_insert = "INSERT INTO doc (id, title, message) VALUES (:id, :title, :message)";
    public $sql_delete = "DELETE FROM doc WHERE id = :id";
    public $columns = ['title' => 'str', 'message' => 'str'];

    public function __construct()
    {
        parent::__construct();
        $this->name = 'doc';        
    }
}