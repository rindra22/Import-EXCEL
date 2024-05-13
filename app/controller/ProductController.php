<?php
namespace app\controller;
require '../vendor/autoload.php';

use app\model\Product;
use app\utils\Render;

class ProductController{
    
    public function index(){
        $product = new Product();
        $products = $product->getAll();
        
        return Render::view('product/index', ['products' => $products]);
    }

}
