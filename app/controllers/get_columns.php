<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class get_columns {

    function index()
    {
        $selected_worksheet = $_POST['selected_worksheet'];
        $uploaded_file_name = $_SESSION['uploaded_file_name'];
        
        $table_list=$this->getDbTablesList();
        $response['db_column_names'] =  $this->getWorksheetColumns($uploaded_file_name,$selected_worksheet) ; 

        $response['table_list'] = $table_list;
        $response['status'] = true;
        $response['message'] = "Column list and Table List retrieved successfully.";

        echo json_encode($response);
    }

    private function getDbTablesList()
    {
        include APPPATH."config/database.php";
        $db_obj = new database(new DbDriver_mysqli($database_host,$database_user,$database_password,$database_dbname));
        return $db_obj->showTables();
    }
    private function getWorksheetColumns($uploaded_file_name,$selected_worksheet)
    {
        $input_file_name = APPPATH.'/public/upload/'.$uploaded_file_name;
        /**  Identify the type of $input_file_name  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($input_file_name);
          /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $input_file_name to a Spreadsheet Object  **/
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setLoadSheetsOnly($selected_worksheet);
        $reader->setReadDataOnly(TRUE);

        $spreadsheet = $reader->load($input_file_name);

        $worksheet = $spreadsheet->getActiveSheet();        
        $found_header_row = [];
        foreach ($worksheet->getRowIterator() as $row) {
        
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); 
            foreach ($cellIterator as $cell) {
             if($cell->getValue()!='')
                    $found_header_row['db_column_names'][] = $cell->getValue() ;
            }
            if(count($found_header_row) == 1) 
                    break;

        }
        return $found_header_row['db_column_names'];
    }
}

?>