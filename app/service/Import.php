<?php 

namespace app\service;

use PhpOffice\PhpSpreadsheet\IOFactory;

require '../vendor/autoload.php';

class Import{

  /**
   * Read excel file
   * 
   * @param string $path
   * @return array
  */
      
  public function readExcel(string $path){
    $createReader = IOFactory::createReader('Xlsx');
    $spreadsheet = $createReader->load($path);
    $sheetData = $spreadsheet->getActiveSheet();
    
    $data = [];
    foreach($sheetData->getRowIterator() as $row){
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        $rowData = [];
        foreach($cellIterator as $cell){
            array_push($rowData, $cell->getValue());
        }
        array_push($data, $rowData);
    }

    return $data;
  }
}