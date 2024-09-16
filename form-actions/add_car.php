<?php

include '../database.php';

function redirect_by_path($path)
{
    $dir = explode('/', $_SERVER['REQUEST_URI']);
    $redirect = '/'. $dir[1] . '/' . $path;
    header("location: $redirect");
    exit;
}

if((isset($_POST['brand_name']) && !empty($_POST['brand_name'])) && (isset($_POST['price']) && !empty($_POST['price']))) {
   try {
       $model = $_POST['brand_name'];
       $price = $_POST['price'];
       $query = $conn->prepare('INSERT INTO car (brand_name, price) VALUES (:brand_name, :price)');
       $query->execute(['brand_name' => $model, 'price' => $price]);
       redirect_by_path('index.php?status=success');
   } catch (\Throwable $th) {

    redirect_by_path('index.php?status=error');
   }
}else{
    redirect_by_path('index.php?status=fields-missing');
}
