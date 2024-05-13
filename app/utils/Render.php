<?php 
namespace app\utils;
require '../vendor/autoload.php';

class Render {

    /**
     * Render a view
     * 
     * @param string $view
     * @param array $data
     * @return void
     */

    public static function view(string $view, array $data = []){

        foreach($data as $key => $value){
            $$key = $value;
        }
        include '../app/views/'.$view.'.php';

    }

}