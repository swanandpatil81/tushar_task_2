<?php 

class DbDriver_mysqli implements  DbDriver
{
    protected $mysqli ;
    public function DbDriver_mysqli($host,$user,$pass,$db)
    {
        $this->mysqli = new mysqli($host,$user,$pass,$db); 
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
    public function insert_batch($table_name,$insert_columns,$insert_values)
    {
        $sql = 'INSERT INTO '.$table_name.' ('.implode(', ', $insert_columns).') VALUES '.implode(', ', $insert_values);
        return $this->mysqli->query($sql);
    }
    public function insert($table_name,$data)
    {
        $table_column_names = array_keys($data);
        $sql = 'INSERT INTO '.$table_name.' ('.implode(', ', $table_column_names).') VALUES (\''.implode('\', \'', $data).'\') ';
        return $this->mysqli->query($sql);
    }
}


?>  