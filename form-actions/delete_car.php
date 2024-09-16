<?php
include '../database.php';
include '../functions.php';

if (!isset($_GET['id']) || intval($_GET['id']) === 0) {

    header("refresh:3; url=../list-car.php");
}

try {
    $id = $_GET['id'];
    $query = $conn->prepare('DELETE FROM car WHERE id = :id');
    $query->execute(['id' => $id]);
    redirect_by_path("list-car.php");
} catch (\Throwable $th) {
    echo '<div id="error-add">
        <h1>
            Une erreur est survenue !
        </h1>
        <img src="assets/images/error.svg" alt="error">
        <a href="index.php" >retour à la page d\'accueil</a>
        </div>';
}
