<?php

namespace app\model;
use app\contract\ConnectionManager;
use app\service\Import;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Product extends ConnectionManager{
    
    /**
     * Get all products
     *  @return array
     */
    public function getAll(){
        $conn = $this->getConnection();
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $products = [];
        if ($result->num_rows > 0) {
            // var_dump($result->fetch_assoc());die;
            for($i = 0; $i < $result->num_rows; $i++){
                array_push($products, $result->fetch_assoc());
            }
        }
        $conn->close();
        return $products;
    }

     /**
      * Create a new product
        * @param array $data
      */

    public function create($data){
        $conn = $this->getConnection();
        $sql = "INSERT INTO products (name, price, description, type) VALUES ('".$data['name']."', '".$data['price']."', '".$data['description']."', '".$data['type']."')";
        $conn->query($sql);
        $conn->close();
    }

    /**
     * Import products from excel file
     * @param string $path
     */
    public function import($data){
        
        if(empty($data)) return;

        array_shift($data);

        foreach($data as $product){
            $this->create([
                'name' => $product[0],
                'price' => $product[1],
                'description' => $product[2],
                'type' => $product[3]
            ]);
        }
    }





}