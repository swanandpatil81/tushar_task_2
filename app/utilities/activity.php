<?php 


class activity implements notify
{
    private $activity_table_name = 'tbl_activity';

    function send($info)
    {
        include APPPATH."config/database.php";
        $db_obj = new database(new DbDriver_mysqli($database_host,$database_user,$database_password,$database_dbname,$database_port));

        if(!$db_obj->insert($this->activity_table_name,$info))
            return false;

        return true; 
    }
}

?>