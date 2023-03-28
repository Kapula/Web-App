<!DOCTYPE html>
<html>

<?php
session_start();
include 'connect.php';

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
                <?php
                    if(isset($_SESSION['$username'])){
                        echo '<li class="col-lg-1 col-md-6 col-sm-12">
                        <a href="logOut.php" class="">Odjava</a>
                    </li>';
                    }
                ?>
            </ul>
        </nav>

    </header>
    <?php



    $uspjesnaPrijava = false;
    $novi = false;
    $admin=false;
    // Provjera da li je korisnik došao s login forme
    if (isset($_POST['prijava'])) {
        // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
        $prijavaImeKorisnika = $_POST['korIme'];
        $prijavaLozinkaKorisnika = $_POST['sifra1'];
        $sql = "SELECT korisnickoIme, lozinka, razina FROM korisnik WHERE korisnickoIme = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        mysqli_stmt_bind_result(
            $stmt,
            $imeKorisnika,
            $lozinkaKorisnika,
            $levelKorisnika
        );
        mysqli_stmt_fetch($stmt);
        if ($imeKorisnika == null) {
            $uspjesnaPrijava = false;
            $novi = true;
        }
        //Provjera lozinke
        if (
            password_verify($_POST['sifra1'], $lozinkaKorisnika) &&
            mysqli_stmt_num_rows($stmt) > 0
        ) {
            $uspjesnaPrijava = true;

            // Provjera da li je admin

            if ($levelKorisnika == 1) {
                $admin = true;
            } else {
                $admin = false;
            }
            //postavljanje session varijabli
            $_SESSION['$username'] = $imeKorisnika;
            $_SESSION['$level'] = $levelKorisnika;
            header("Location: administracija.php");
        } else {
            $uspjesnaPrijava = false;
        }
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM clanci WHERE id=$id ";
        $result = mysqli_query($dbc, $query);
    }

    if (isset($_POST['update'])) {
        $picture = $_FILES['photo']['name'];
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        if (isset($_POST['archive'])) {
            $archive = 1;
        } else {
            $archive = 0;
        }
        if ($picture != "") {
            $target_dir = $picture;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir);
            $id = $_POST['id'];
            $query = "UPDATE clanci SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
        } else {
            $id = $_POST['id'];
            $query = "UPDATE clanci SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive' WHERE id=$id ";
            $result = mysqli_query($dbc, $query);
        }
    }



    // Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je

    if (($uspjesnaPrijava == true && $admin == true) ||
        (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1
    ) {
        $query = "SELECT * FROM clanci";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result)) {

            echo '<section>

                <div class="container-lg ">
                    <hr class="crta">
                    <div class="row">
                        <form class="col-lg-12" enctype="multipart/form-data" name="forma" method="post" action="">
                            <div>
                                <label class="lebelDizajn" for="title">Naslov vijesti</label>
                                <div>
                                    <input class="naslovVijesti" type="text" name="title" value="' . $row['naslov'] . '">
                                </div>
                            </div>
        
                            <div>
                                <label class="lebelDizajn" for="about">Kratki sadržaj vijesti (do 50
                                    znakova)</label>
                                <div>
                                    <textarea name="about" id="about" cols="30" rows="10">' . $row['sazetak'] . '</textarea>
                                </div>
                            </div>
                            <div>
                                <label class="lebelDizajn" for="content">Sadržaj vijesti</label>
                                <div>
                                    <textarea name="content" id="content" cols="30" rows="10">' . $row['tekst'] . '</textarea>
                                </div>
                            </div>
                            <div>
                                <label class="lebelDizajn" for="photo">Slika: </label>
                                <div>
                                    <input type="file" accept="image/jpg" id="photo" value="' . $row['slika'] . '" name="photo"/> <br><img src="' . $row['slika'] . '" width=100px>
                                </div>
                            </div>
                            <div>
                                <label class="lebelDizajn" for="category">Kategorija vijesti</label>
                                <select name="category" class="butt">
                                    <option value="Europa">Europa</option>
                                    <option value="Teknautas">Teknautas</option>
                                </select>
        
                            </div>
        
                            <div>
                                <label class="lebelDizajn" style="margin-top: auto;">Spremiti u arhivu: 
                                <div class="form-field">';

            if ($row['arhiva'] == 0) {
                echo '<input type="checkbox" name="archive" id="archive"/> 
                               Arhiviraj?';
            } else {
                echo '<input type="checkbox" name="archive" id="archive" 
                               checked/> Arhiviraj?';
            }

            echo '</div>
                                </label>
                                
        
                                </div>
                            </div>
                            <div>
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                <button class="butt" type="reset" value="Poništi">Poništi</button>
                                <button class="butt" name="update" type="submit" value="Izmjeni">Izmjeni</button>
                                <button class="butt" type="submit" name="delete" value="Izbriši">Izbriši</button>
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
        
            </section>';
        }
        // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
    } else if ($uspjesnaPrijava == true && $admin == false) {

        echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali 
niste administrator.</p>';
    } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {

        echo '<p>Bok ' . $_SESSION['$username'] . '! Uspješno ste 
prijavljeni, ali niste administrator.</p>';
    } else if ($uspjesnaPrijava == false) {
    ?>

        <section>

            <div class="container-lg w-50">
                <hr class="crta">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-12 clanakCentrirano" action="" name="prijava" method='POST' >

                        <label for="korIme">Korisničko ime:</label><br>
                        <input type="text" name="korIme" id="korIme" /><br>
                        <span id="porukaKorisniku" class="error"></span>
                        <br>
                        <label for="sifra1">Lozinka:</label><br>
                        <input type="password" name="sifra1" id="sifra1" /><br>
                        <span id="porukaSifri" class="error"></span>
                        <br>
                        <button class="butt" type="submit" id="gumb" name="prijava">Prijava</button><br>
                        <a href="registracija.php" class="butt" style="color:white; " type="submit" id="gumb">Registracija</a>


                    </form>

                </div>
            </div>
            <script type="text/javascript">
                document.getElementById("gumb").onclick = function(event) {
                    var slanje_forme = true;

                    var poljeIme = document.getElementById("korIme");
                    var korIme = document.getElementById("korIme").value;
                    if (korIme.length < 5) {
                        slanje_forme = false;
                        poljeIme.style.border = "1px dashed red";
                        document.getElementById("porukaKorisniku").innerHTML = "Korisničko ime ne smije biti manje od 5 znakova!<br>";
                    } else {
                        poljeIme.style.border = "1px solid green";
                        document.getElementById("porukaIme").innerHTML = "";
                    }
                    var poljesifra1 = document.getElementById("sifra1");
                  
                    var sifra1 = document.getElementById("sifra1").value;
                    

                    if (sifra1.length == 0) {
                        slanje_forme = false;
                        poljesifra1.style.border = "1px dashed red";
                        document.getElementById("porukaSifri").innerHTML = "Lozinka ne smije biti manja od 8 znakova!<br>";
                    } else {
                        poljesifra1.style.border = "1px solid green";
                        document.getElementById("porukaIme").innerHTML = "";
                    }

                    if (slanje_forme != true) {
                        event.preventDefault();
                    }
                }
            </script>


        <?php }


        ?>
        <footer class="container">
            <hr class="crta">
            <div class="row malaSlova centriranje">
                <p class="col-lg-4 col-md-6 col-sm-12">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
            </div>

        </footer>

</body>

</html> 