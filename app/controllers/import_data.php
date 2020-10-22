<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class import_data extends eximpo {

    private $notify; 

    function index()
    {
        $selected_worksheet = $_POST['selected_worksheet'];
        $selected_worksheet_columns=explode(',',$_POST['selected_worksheet_columns']);
        $selected_db_table =  $_POST['selected_db_table'];   
        $uploaded_file_name = $_SESSION['uploaded_file_name'];   
        $total_rows=$_SESSION['highestRow'];
        $input_file_path = APPPATH.'/public/upload/'.$uploaded_file_name;  
        $import_status = $this->importSelectedWorksheetColumns($input_file_path,$selected_worksheet,$selected_worksheet_columns,$total_rows,$selected_db_table);  
        
        $meta_data['status'] = $response['status']= $import_status;
        $meta_data['records_imported'] = $total_rows; 
        $meta_data['uploaded_file_name'] = $uploaded_file_name; 
        $meta_data['selected_worksheet'] = $selected_worksheet; 
        $meta_data['selected_worksheet_columns'] = $selected_worksheet_columns; 
        $meta_data['selected_db_table'] = $selected_db_table; 

        $activity_info['name'] = 'import_data';
        $activity_info['meta_data'] = json_encode($meta_data) ;
        $this->notify->send($activity_info);        
        echo json_encode($response);
    }
    public function setNotify(notify $notify)
    {
        $this->notify = $notify;
    }
    private function importSelectedWorksheetColumns($input_file_path,$selected_worksheet,$selected_worksheet_columns,$total_rows,$selected_db_table)
    {
        $filterSubset = new SpreadsheetReadFilter();
        /**  Identify the type of $input_file_name  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($input_file_path);
          /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $input_file_name to a Spreadsheet Object  **/
        /**  Advise the Reader that we only want to load cell data  **/
        
        $reader->setReadFilter($filterSubset);
        $filterSubset->setColumns($selected_worksheet_columns);
        for ($startRow = 2; $startRow <= $total_rows; $startRow += $worksheet_read_chunk_size) {
            /**  Tell the Read Filter which rows we want this iteration  **/
            $reader->setLoadSheetsOnly($selected_worksheet);
            $reader->setReadDataOnly(TRUE);
            $filterSubset->setRows($startRow,$worksheet_read_chunk_size);
            /**  Load only the rows that match our filter  **/
            $spreadsheet = $reader->load($input_file_path);
            //    Do some processing here
            $worksheet = $spreadsheet->getActiveSheet();        
            $row_wise_data = [];
            $column_names_list = [];
            $row_counter= 0;
            foreach ($worksheet->getRowIterator() as $row) {        
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE); 
                $column_wise_data=[];
                foreach ($cellIterator as $cell) {

                    if($cell->getValue()!='')
                    {
                        if($row_counter == 0)
                            $column_names_list[] = $cell->getValue();
                        else
                            $column_wise_data[] = "'".$cell->getValue()."'" ;
                    }               
                }
                if(count($column_wise_data))
                        $row_wise_data[$row_counter] = ' '.implode(',',$column_wise_data).' ';
                $row_counter++;    

            }

            if(!$this->db->insert_batch($selected_db_table,$column_names_list,$row_wise_data))
                return false;

        }
        return true;
    }
    
}

?>