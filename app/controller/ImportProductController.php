<?php
namespace app\controller;
require '../vendor/autoload.php';

use app\model\Product;
use app\service\Import;

class ImportProductController{

    public function import($path){
        $import = new Import();
        $data = $import->readExcel($path);
        $product = new Product();
        $product->import($data);

        return header('Location: /public');
    }
}
