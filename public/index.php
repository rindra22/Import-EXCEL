<?php

require '../vendor/autoload.php';

if(isset($_GET['p'])){
    $p = $_GET['p'];
}else if(isset($_POST['import'])){
    $p = 'import';
}else{
    $p = 'home';
}


if($p === 'home'){
    $controller = new \app\controller\ProductController();
    $controller->index();
}else if($p === 'import'){
    $controller = new \app\controller\ImportProductController();
    if(isset($_FILES['file']))
        $controller->import($_FILES['file']['tmp_name']);
    else
        echo 'File not found';
}else{
    echo '404 Not Found';
}

?>



