<!DOCTYPE html>
<html lang="en">

<?php include 'functions.php' ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>CDPI test</title>
</head>

<body>
    <?php include 'components/nav-bar.php' ?>
    <?php if (isset($_GET['status'])): ?>
        <div id="msg-container">
        <?php renderErrorMsg($_GET['status']) ?>
        </div>
    <?php else: ?>
        <main>
            <h1>Ajouter une voiture</h1>
            <!-- form add car model -->
            <form action="form-actions/add_car.php" method="post">
                <label for="model">Nom de la marque</label>
                <input type="text" name="brand_name" id="brand_name">
                <label for="price">Prix</label>
                <input type="number" name="price" id="price">
                <button type="submit">Ajouter</button>
            </form>
        </main>
    <?php endif; ?>

</body>

</html>