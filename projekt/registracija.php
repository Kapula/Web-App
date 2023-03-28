<!DOCTYPE html>
<html>

<?php
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
            </ul>
        </nav>

    </header>
    <?php
    $registriranKorisnik = false;
    $msg = "";
    if (isset($_POST['slanje'])) {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $username = $_POST['username'];
        $lozinka = $_POST['pass'];
        $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
        $razina = 0;
        $registriranKorisnik = '';
        //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
        $sql = "SELECT korisnickoIme FROM korisnik WHERE korisnickoIme = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika u bazi pazeći na SQL injection
            $sql = "INSERT INTO korisnik (ime, prezime, korisnickoIme, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    'ssssd',
                    $ime,
                    $prezime,
                    $username,
                    $hashed_password,
                    $razina
                );
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
        }
        mysqli_close($dbc);
    }
    //Registracija je prošla uspješno
    if ($registriranKorisnik == true) {
        echo '<a href="administracija.php"></a>';
    } else {
        //registracija nije protekla uspješno ili je korisnik prvi put došao na stranicu
    }

    ?>

    <section role="main">
        <div class="container-lg w-50">
            <hr class="crta">
            <div class="row">
                <form class="col-12 clanakCentrirano" enctype="multipart/form-data" action="" method="POST">
                    <div class="">
                        <span id="porukaIme" class="bojaPoruke"></span>
                        <label for="title">Ime: </label>
                        <div>
                            <input type="text" name="ime" id="ime">
                        </div>
                    </div>
                    <div>
                        <span id="porukaPrezime" class="bojaPoruke"></span>
                        <label for="about">Prezime: </label>
                        <div class="form-field">
                            <input type="text" name="prezime" id="prezime">
                        </div>
                    </div>
                    <div>
                        <span id="porukaUsername" class="bojaPoruke"></span>

                        <label for="content">Korisničko ime:</label>
                        <!-- Ispis poruke nakon provjere korisničkog imena u bazi -->
                        <?php echo '<br><span class="bojaPoruke">' . $msg . '</span>'; ?>
                        <div class="form-field">
                            <input type="text" name="username" id="username">
                        </div>
                    </div>
                    <div>
                        <span id="porukaPass" class="bojaPoruke"></span>
                        <label for="pphoto">Lozinka: </label>
                        <div class="form-field">

                            <input type="password" name="pass" id="pass">
                        </div>
                    </div>
                    <div>
                        <span id="porukaPassRep" class="bojaPoruke"></span>
                        <label for="pphoto">Ponovite lozinku: </label>
                        <div class="form-field">
                            <input type="password" name="passRep" id="passRep">
                        </div>
                    </div>

                    <div><br>
                        <button type="submit" class="butt" value="Prijava" name="slanje" id="slanje">Registriraj se</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        document.getElementById("slanje").onclick = function(event) {

            var slanjeForme = true;

            // Ime korisnika mora biti uneseno
            var poljeIme = document.getElementById("ime");
            var ime = document.getElementById("ime").value;
            if (ime.length == 0) {
                slanjeForme = false;
                poljeIme.style.border = "1px dashed red";
                document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
            } else {
                poljeIme.style.border = "1px solid green";
                document.getElementById("porukaIme").innerHTML = "";
            }
            // Prezime korisnika mora biti uneseno
            var poljePrezime = document.getElementById("prezime");
            var prezime = document.getElementById("prezime").value;
            if (prezime.length == 0) {
                slanjeForme = false;

                poljePrezime.style.border = "1px dashed red";

                document.getElementById("porukaPrezime").innerHTML = "<br>Unesite Prezime!<br>";
            } else {
                poljePrezime.style.border = "1px solid green";
                document.getElementById("porukaPrezime").innerHTML = "";
            }

            // Korisničko ime mora biti uneseno
            var poljeUsername = document.getElementById("username");
            var username = document.getElementById("username").value;
            if (username.length == 0) {
                slanjeForme = false;
                poljeUsername.style.border = "1px dashed red";

                document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime! <br> ";
            } else {
                poljeUsername.style.border = "1px solid green";
                document.getElementById("porukaUsername").innerHTML = "";
            }

            // Provjera podudaranja lozinki
            var poljePass = document.getElementById("pass");
            var pass = document.getElementById("pass").value;
            var poljePassRep = document.getElementById("passRep");
            var passRep = document.getElementById("passRep").value;
            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                slanjeForme = false;
                poljePass.style.border = "1px dashed red";
                poljePassRep.style.border = "1px dashed red";
                document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste! < br > ";

                document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
            } else {
                poljePass.style.border = "1px solid green";
                poljePassRep.style.border = "1px solid green";
                document.getElementById("porukaPass").innerHTML = "";
                document.getElementById("porukaPassRep").innerHTML = "";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }

        };
    </script>

    <footer class="container">
        <hr class="crta">
        <div class="row malaSlova centriranje">
            <p class="col-lg-4 col-md-6 col-sm-12">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
        </div>

    </footer>
</body>


</html>
