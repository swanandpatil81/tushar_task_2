<?php 

class DbDriver_mysqli implements  DbDriver
{
    protected $mysqli ;
    public function DbDriver_mysqli($host,$user,$pass,$db)
    {
        $this->mysqli = new mysqli($host,$user,$pass,$db); 
    }
    public function connect($host,$user,$pass,$db)
    {

    }
    public function showTables()
    {
      //  echo "here I am ";exit;
     // $this->mysqli = new mysqli('localhost','root','','eximpo'); 
      $sql ="SHOW TABLES";
      $table_list = [];
      if ($result = $this->mysqli->query($sql)) {
            while($obj = $result->fetch_object()){
               //print_r($obj);
               $table_list[]=$obj->Tables_in_eximpo;
            }
        }

       return $table_list; 
    }
}


?>  