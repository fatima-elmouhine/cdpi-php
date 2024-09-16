<?php
include '../database.php';
include '../functions.php';

define('EDIT_CAR_PATH', 'edit-car.php?id=');

if(empty($_GET['id'])){
    redirect_by_path('list-car.php');
}

if((isset($_POST['brand_name']) && !empty($_POST['brand_name'])) && (isset($_POST['price']) && !empty($_POST['price']))) {
    try {
        $model = $_POST['brand_name'];
        $price = $_POST['price'];
        $id = $_GET['id'];
        $query = $conn->prepare('UPDATE car SET brand_name = :brand_name, price = :price WHERE id = :id');
        $query->execute(['brand_name' => $model, 'price' => $price, 'id' => $id]);
        redirect_by_path(EDIT_CAR_PATH.$id.'&status=success');
    } catch (\Throwable $th) {
        redirect_by_path(EDIT_CAR_PATH.$id.'&status=error');
    }
}else{
    $id = $_GET['id'];
    // refresh the page with an error message
    echo '<div id="error-add">
            <h1>
            Tout les champs ne sont pas remplis
            </h1>
            <img src="assets/images/error.svg" alt="error">
            <a href="index.php" >retour à la page d\'accueil</a>
            </div>';
    redirect_by_path(EDIT_CAR_PATH.$id.'&status=fields-missing');
}
