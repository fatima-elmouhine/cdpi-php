<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de voiture </title>
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
    <?php include 'components/nav-bar.php' ?>
    <?php include 'functions.php' ?>
    <?php
    $listCar = getCarList($conn);
    ?>
    <main>
        <h1>Liste des voitures</h1>
        <table class="rwd-table">
            <tbody>
                <thead>

                    <tr>
                        <th>Marque du modele</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach ($listCar as $key => $car) { ?>

                <tr>
                    <td data-th="Supplier Code">
                    <?php echo $car['brand_name'] ?>
                    </td>
                    <td data-th="Net Amount">
                        $<?php echo $car['price'] ?>
                    </td>
                    <td data-th="Actions">
                        <a href="edit-car.php?id=<?php echo $car['id'] ?>" class="edit">Modifier</a>
                        <a href="form-actions/delete_car.php?id=<?php echo $car['id'] ?>" class="delete">Supprimer</a>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </main>
</body>

</html>