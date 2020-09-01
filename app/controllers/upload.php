<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class upload {

    function index()
    {
        $global_file_arr = $_FILES;
        $destination_dir = APPPATH.'/public/upload/' ;
        $inputFileName = $this->uploadExcel($global_file_arr,$destination_dir);
        $excel_file_path = $destination_dir.$inputFileName ;
        $list_worksheet_names = $this->getWorksheetlist($excel_file_path);

        $_SESSION['uploaded_file_name'] = $inputFileName;
        $response['worksheet_names'] =  $list_worksheet_names; 
        $response['status'] = true;
        $response['message'] = "File uploaded successfully.";

        echo json_encode($response);
    }
    private function getWorksheetlist($inputFileName)
    {
        /**  Identify the type of $inputFileName  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
          /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($inputFileName);
        return $reader->listWorksheetNames($inputFileName);
    }
    private function uploadExcel($global_file_arr,$destination_dir)
    {
        $path_parts = pathinfo($global_file_arr[0]["name"]);
        $target_file_name = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
        $target_file_path = $destination_dir.$target_file_name;
        if ( 0 < $global_file_arr[0]['error'] ) {
            echo 'Error: ' . $global_file_arr[0]['error'] . '<br>';
        }
        else {
            move_uploaded_file($global_file_arr[0]['tmp_name'],  $target_file_path);
        }
        return $target_file_name;
    }
}

?>