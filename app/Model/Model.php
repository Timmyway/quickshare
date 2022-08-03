<?php namespace App\Model;

class Model
{
    public $name;
    public $sql_create;
    public $sql_insert;
    public $sql_delete;
    public $columns;
    private $_types;

    public function __construct()
    {        
        $this->name = get_class($this);
        $this->_types = [
            'bool' => \PDO::PARAM_BOOL,
            'null' => \PDO::PARAM_NULL,
            'int' => \PDO::PARAM_INT,
            'str' => \PDO::PARAM_STR,
        ];

        try {
            /* Create a prepared statement */
            // echo '====> creation of table doc ' . $this->sql_create . '<====';
            $stmt = Connection::getInstance()->db()->prepare($this->sql_create);
            
            /* execute the query */
            $stmt -> execute();            
        } catch (PDOExecption $e){
            echo $e->getMessage();
        }
    }

    public function all()
    {
        try {
            /* Create a prepared statement */
            $statement = Connection::getInstance()->db()->prepare("SELECT * from ".$this->name);
            
            /* execute the query */
            $statement->execute();
            
            /* fetch all results */
            $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
                    
            return $res;
        }
        catch (PDOExecption $e){
            return ['error' => $e];
        }
    }

    public function insert($data)
    {
        try {                    
            /* Create a prepared statement */
            $stmt = Connection::getInstance()->db()->prepare($this->sql_insert);
            
            /* bind params */            
            foreach ($this->columns as $column_name => $column_type) {                
                $stmt->bindParam(':'.$column_name, $this->_types[$column_type]);
            }
            
            /* execute the query */
            if ( $stmt->execute($data) ) {                
                return ['response' => 'Created'];
            }
        }
        catch (PDOExecption $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {        
        try {                    
            /* Create a prepared statement */
            $stmt = Connection::getInstance()->db()->prepare($this->sql_delete);
            
            /* bind params */            
            $stmt->bindValue(':id', $id );
            
            /* execute the query */
            if ( $stmt->execute() ) {
                return ['response' => $id.' was deleted'];
            }
        }
        catch (PDOExecption $e){
            echo $e->getMessage();
        }
    }
}