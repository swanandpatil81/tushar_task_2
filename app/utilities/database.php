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
}
?>