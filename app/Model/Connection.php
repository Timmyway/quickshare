<?php
namespace App\Model;

class Connection
{
    private $_db;
    private static $_instance = null;

    private function __construct()
    {
        $this->init();
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {            
            self::$_instance = new Connection();
        }
        return self::$_instance;
    }

    public function db()
    {
        return $this->_db;
    }

    private function init()
    {
        $path = 'sqlite:'.CONFIG['db_path'];
        $this->_db = new \PDO($path);
        $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->_db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);        
    }
}