<?php

interface DbDriver
{
    public function showTables();
    public function insert_batch($table_name,$insert_columns,$insert_values);
    public function insert($table_name,$data);
}

?>