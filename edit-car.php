<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Detail </title>
</head>

<body>
    <?php
    include 'components/nav-bar.php';
    include 'functions.php';
    ?>
    <h4>
        <a href="list-car.php">
            Retour à la liste
        </a>
    </h4>

    <?php
    checkIsIdValid() ? header("location: list-car.php") : null;
    $car = getCarById($conn, $_GET['id']); ?>
    <form action="form-actions/edit_car.php?id=<?php echo $_GET['id'] ?>" method="post">
        <label for="model">Nom de la marque</label>
        <input type="text" name="brand_name" id="brand_name" value="<?php echo $car['brand_name'] ?>">
        <label for="price">Prix</label>
        <input type="number" name="price" id="price" value="<?php echo $car['price'] ?>">
        <button type="submit">Modifier</button>
    </form>
    <?php if (isset($_GET['status']) && $_GET['status']): ?>
        <?php $bg =  $_GET['status'] === 'success' ? "#68de68" : "#e34444";   ?>
        <div id="msg" style="background:<?php echo $bg; ?>; display: flex; align-items: center; justify-content: center; margin: 10px 59px; color:white;">
            <?php renderError($_GET['status']);
               header("refresh:1; url=list-car.php");
            ?>
        </div>
        <!-- <div  id="closeContainer">
            <button id="closeBtn" style="background: #cacaca; border:none;" > fermer </button>
        </div> -->
    <?php endif; ?>
</body>
<!-- <script>
    const closeBtn = document.querySelector("#closeBtn")
    if(closeBtn !== null ){
        closeBtn.style.cursor = "pointer"
        
        closeBtn.addEventListener("click", ()=>{
            const params= window.location.href.split("?")[1]
            const id = params.split("&")[0]
            window.location.href = "edit-car.php?"+id;
        })

    }

</script> -->

</html>