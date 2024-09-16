<?php

include 'database.php';

function redirect_by_path($path)
{
    $dir = explode('/', $_SERVER['REQUEST_URI']);
    $redirect = '/' . $dir[1] . '/' . $path;
    header("location: $redirect");
    exit;
}

function renderErrorMsg($msg)
{
    switch ($msg) {
        case 'fields-missing':
            echo '<div id="error-add">
            <h1>
            Tout les champs ne sont pas remplis
            </h1>
            <img src="assets/images/error.svg" alt="error">
            <a href="index.php" >retour à la page d\'accueil</a>
            </div>';
            break;

        case 'error':
            echo '<div id="error-add">
            <h1>
            Une erreur est survenue
            </h1>
            <img src="assets/images/error.svg" alt="error">
            <a href="index.php" >retour à la page d\'accueil</a>
            </div>';
            break;
        case 'success':
            echo '<div id="success-add">
            <h1>La voiture a bien été ajoutée</h1>
            <img src="assets/images/success.svg" alt="success">
            <p>Vous allez être redirigé vers la liste des voitures</p>
            </div>';
            header("refresh:3; url=list-car.php");
            break;
        default:
            header('Location: index.php');
            break;
    }
}

function getCarList($conn)
{
    $query = $conn->prepare('SELECT * FROM car');
    $query->execute();

    return $query->fetchAll();
}


function getCarById($conn, $id)
{
    $query = $conn->prepare('SELECT * FROM car WHERE id = ?');
    $query->execute([$id]);

    return $query->fetch();
}

function renderError($msg)
{
    switch ($msg) {
        case 'fields-missing':
            echo '<h4>Tout les champs ne sont pas remplis</h4>';
            break;
        case 'error':
            echo '<h4 >Une erreur est survenu </h4>';
            break;
        case 'success':
            echo '<h4>
                La voiture a bien été modifiée
                 </h4>';
            break;
        default:
            header('Location: list-car.php');
            break;
    }
}


function checkIsIdValid(){
    return !isset($_GET['id']) ||  intval($_GET['id']) === 0;
}