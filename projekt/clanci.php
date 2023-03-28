<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Projekt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>



<body class="tijelo">
    
 
<?php
    include 'connect.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM clanci WHERE id = '" . $id. "' LIMIT 1";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<header class="container-lg">
        <div class="clanakLeft row">
            <h3 class="col-12">' . $row['kategorija'] . '</h3>
        </div>
        <hr class="crta">

    </header>
        <section class="container-lg w-75">
        <div class="row clanakCentrirano">

            <h2 class="col-12 naslovClanka">' . $row['naslov'] . '</h2>

        </div>

    </section>

    <section class="container-lg w-25 p-3">
        <div class="row clanakCentrirano">

            <p class="col-12 ">' . $row['sazetak'] . '</p>

        </div>

    </section>
    <!--SLIKA-->
    <section class="container-lg w-50 p-3">
        <div class="row clanakCentrirano">
            <img src="' . $row['slika'] . '">
           
        </div>

    </section>

    <!--Tekst-->
    <section class="container-lg w-25 p-3">
        <div class="row">
            <p class="clanakLeft col-12">' . $row['datum'] . '</p>
            <br>
            <article class="clanakCentrirano text-start col-12">
                <p>' . $row['tekst'] . '</p>
            </article>
            <br>
        </div>
    </section>';
    }


    ?>


    <footer class="container-lg">
        <div class="row malaSlova">
            <p class="col-4">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
        </div>

    </footer>

</body>

</html>