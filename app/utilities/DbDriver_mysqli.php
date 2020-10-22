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
      $sql ="SHOW TABLES";
      $table_list = [];
      $show_table_statement = $this->mysqli->prepare($sql);
      
      $show_table_statement->execute(); 

      if ($result =  $show_table_statement->get_result()) {
            while($obj = $result->fetch_object()){
               //print_r($obj);
               $table_list[]=$obj->Tables_in_eximpo;
            }
        }

        $show_table_statement->close();
        return $table_list; 
    }
    public function insert_batch($table_name,$insert_columns,$insert_values)
    {
        $question_mark_arr = array_fill(0, count($insert_columns), "?");
        $question_mark_str = implode(',',$question_mark_arr);
    echo    $sql = 'INSERT INTO '.$table_name.' ('.implode(', ', $insert_columns).') VALUES '.implode(', ', array_fill(0, count($insert_values), '('.$question_mark_str.')'));
        
        $insert_statement = $this->mysqli->prepare($sql);
      
        foreach ($insert_values as $single_row) {

            $insert_statement->bind_param('sss', $single_row);

        }
        
        return    $insert_statement->execute();

     //   $insert_statement->execute();     
        
      //  return $this->mysqli->query($sql);
    }
    public function insert($table_name,$data)
    {
        $table_column_names = array_keys($data);
        $sql = 'INSERT INTO '.$table_name.' ('.implode(', ', $table_column_names).') VALUES (\''.implode('\', \'', $data).'\') ';

        //$insert_statement = $this->mysqli->prepare($sql);
        //$insert_statement->execute();  

        return $this->mysqli->query($sql);
    }
}


?>  