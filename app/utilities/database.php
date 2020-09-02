<?php 

class database {

    protected $connection;

    public function database(DbDriver $connection) 
    {
        $this->connection = $connection;        
    }
    public function showTables()
    {
        return $this->connection->showTables();
    }
    public function insert_batch($table_name,$insert_columns,$insert_values)
    {
        return $this->connection->insert_batch($table_name,$insert_columns,$insert_values);
        
    }
    public function insert($table_name,$data)
    {
        return $this->connection->insert($table_name,$data);
    }

}
?>