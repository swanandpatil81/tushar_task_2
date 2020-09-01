<?php

interface DbDriver
{
    public function connect($host,$user,$pass,$db);
    public function showTables();
}

?>