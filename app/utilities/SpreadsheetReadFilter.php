<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $startRow = 0;
    private $endRow   = 0;
    private $columns  = [];

    /**  Set the list of rows that we want to read  */
    public function setRows($startRow, $chunk_size) {
        $this->startRow = $startRow;
        $this->endRow   = $startRow + $chunk_size;
    }

    /**  Get the list of rows and columns to read  */
    public function setColumns($columns) {
        $this->columns  = $columns;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Only read the heading row, and the configured rows
        if (($row == 1) || ($row >= $this->startRow && $row < $this->endRow)) {
            if (in_array($column,$this->columns)) {
                return true;
            }
        }
        return false;
    }
}

?>