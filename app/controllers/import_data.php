<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class import_data {

    function index()
    {
        print_r($_POST);
        exit;
        $selected_worksheet = $_POST['selected_worksheet'];
        $selected_worksheet_columns=$_POST['selected_worksheet_columns'];
        $selected_db_table =  $_POST['selected_db_table'];
        
        $this->importSelectedWorksheetColumns();
       
    }

    private function importSelectedWorksheetColumns()
    {
        include APPPATH."config/database.php";
        $db_obj = new database(new DbDriver_mysqli($database_host,$database_user,$database_password,$database_dbname));
        return $db_obj->showTables();
    }
    
}

?>