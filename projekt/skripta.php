<!DOCTYPE html>
<html>
<?php

include 'connect.php';
if (isset($_POST['submit'])) {
    $photo = $_FILES['photo']['name'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $date = date('d.m.Y.');
    if (isset($_POST['archive'])) {
        $archive = 1;
    } else {
        $archive = 0;
    }
    $target_dir = $photo;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir);

    $query = "INSERT INTO clanci (datum, naslov, sazetak, tekst, slika, kategorija, arhiva ) 
    VALUES ('$date', '$title', '$about', '$content', '$photo', '$category', '$archive')";

    $result = mysqli_query($dbc, $query) or die('Error querying databese.');
    mysqli_close($dbc);
}
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Projekt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="tijelo">
    <header class="container-lg">
        <div class="clanakLeft row">
            <h3 class="col-12"><?php
                                echo $category;
                                ?></h3>
        </div>
        <hr class="crta">

    </header>
    <!--Naslov-->

    <section class="container-lg w-75">
        <div class="row clanakCentrirano">

            <h2 class="col-12 naslovClanka"><?php
                                            echo $title;
                                            ?></h2>

        </div>

    </section>

    <section class="container-lg w-25 p-3">
        <div class="row clanakCentrirano">

            <p class="col-12 "><?php
                                echo $about;
                                ?>
            </p>

        </div>

    </section>
    <!--SLIKA-->
    <section class="container-lg w-50 p-3">
        <div class="row clanakCentrirano">
            <?php
            echo '<img src=" '. $photo . '">';
            ?>
        </div>

    </section>

    <!--Tekst-->
    <section class="container-lg w-25 p-3">
        <div class="row">
            <p class="clanakLeft col-12"><?php echo $date ?></p>
            <br>
            <article class="clanakCentrirano text-start col-12">
                <p><?php
                    echo $content;
                    ?>
            </article>
            <br>
        </div>
    </section>

    <footer class="container-lg">
        <div class="row malaSlova">
            <p class="col-4">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
        </div>

    </footer>

</body>

</html>