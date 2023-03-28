<!DOCTYPE html>
<html>

<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>





<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Projekt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="tijelo">
    <header class="container-fluid">
        <div class="row centriranje">
            <h1 class="col-12 fontNaslova">El Confidencial</h1>
            <p class="col-12">El diario de los lectores influyentes</p>
        </div>


        <nav class="container-lg">
            <ul class="row">
                <li class="col-lg-3">

                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">
                    <a href="index.php" class="">Početna</a>
                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">
                    <a href="kategorija.php?id=Europa" class="">Europa</a>
                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">

                    <a href="kategorija.php?id=Teknautas" class="">Teknautas</a>
                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">
                    <a href="administracija.php" class="">Administracija</a>
                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">
                    <a href="unos.php" class="">Unos</a>
                </li>
                <li class="col-lg-1 col-md-6 col-sm-12">
                    <a href="registracija.php" class="">Registracija</a>
                </li>
            </ul>
        </nav>

    </header>
    <section class="container-lg">
        <hr class="crta">
        <div class="row centriranje">

            <?php

            $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='Europa' ORDER BY id DESC";
            $result = mysqli_query($dbc, $query);
            echo '<h2 class="col-12 naslovi">Europa</h2>
            <div class="row">';
            while ($row = mysqli_fetch_array($result)) {
                echo '
                    <article class="col-lg-4 col-sm-12">
                        <a href= "clanci.php?id= '.$row['id'].'">

                            <img src="' . $row['slika'] . '" alt="" width="85%" >
                        </a>
                        <p class="centriranje col-12">' . $row['datum'] . '</p>
                        <p>' . $row['sazetak'] . '</p>
                    </article>';
            } ?>
        </div>
        </div>
        <hr class="crta">
    </section>

    <section class="container-lg">

        <div class="row centriranje">

            <?php

            $query = "SELECT * FROM clanci WHERE arhiva=0 AND kategorija='Teknautas' ORDER BY id DESC";
            $result = mysqli_query($dbc, $query);
            echo '<h2 class="col-12 naslovi">Teknautas</h2>
            <div class="row">';
            while ($row = mysqli_fetch_array($result)) {
                echo '
                    <article class="col-lg-4 col-sm-12">
                        <a href= "clanci.php?id= '.$row['id'].'">
                            <img src="' . $row['slika'] . '" alt="" width="200px" height="200px">
                        </a>
                        <p class="centriranje col-12">' . $row['datum'] . '</p>
                        <p>' . $row['sazetak'] . '</p>
                    </article>';
            } ?>
        </div>
        </div>
        <hr class="crta">
    </section>


    <footer class="container">
        <div class="row malaSlova centriranje">
            <p class="col-lg-4 col-md-6 col-sm-12">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
            <p class="col-lg-1 col-md-6 col-sm-12"><a href="#">Conditiones</a></p>
            <p class="col-lg-2 col-md-6 col-sm-12"><a href="#">Politica de Privacidad</a></p>
            <p class="col-lg-2 col-md-6 col-sm-12"><a href="#">Politica de Cookies</a></p>
            <p class="col-lg-1 col-md-6 col-sm-12"><a href="#">Transparencia</a></p>
            <p class="col-lg-2 col-md-6 col-sm-12"><a href="#">Auditado por ComScore</a></p>
        </div>

    </footer>

</body>

</html>