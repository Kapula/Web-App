<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Projekt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="tijelo">
    <header class="container-lg ">
        <div class="row">
            <h1 class="col-12 fontNaslova clanakLeft ">Unos</h1>
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

    <section>

        <div class="container-lg ">
            <hr class="crta">
            <div class="row">
                <form class="col-lg-12" enctype="multipart/form-data" name="forma" method="post" action="skripta.php">
                    <div>
                        <label class="lebelDizajn" for="title">Naslov vijesti</label>
                        <div>
                            <input class="naslovVijesti" id= "title" type="text" name="title">
                        </div>
                        <span id="porukaTitle" class="bojaPoruke"></span>
                    </div>
                    <div>
                        <label class="lebelDizajn" for="about">Kratki sadržaj vijesti (do 50
                            znakova)</label>
                        <div>
                            <textarea name="about" id="about" cols="30" rows="10"></textarea>
                        </div>
                        <span id="porukaAbout" class="bojaPoruke"></span>
                    </div>
                    <div>
                        <label class="lebelDizajn" for="content">Sadržaj vijesti</label>
                        <div>
                            <textarea name="content" id="content" cols="30" rows="10"></textarea>
                        </div>
                        <span id="porukaContent" class="bojaPoruke"></span>
                    </div>
                    <div>
                        <label class="lebelDizajn" for="photo">Slika: </label>
                        <div>
                            <input type="file" accept="image/jpg" name="photo" id="photo" />
                        </div>
                        <span id="porukaSlika" class="bojaPoruke"></span>
                    </div>
                    <div>
                        <label class="lebelDizajn" for="category ">Kategorija vijesti</label>
                        <div class="box">
                            <select name="category" id="category">
                                <option class="dropDown" value="" disabled selected>Odaberi</option>
                                <option value="Europa">Europa</option>
                                <option value="Teknautas">Teknautas</option>
                            </select>
                        </div>
                        <span id="porukaKategorija" class="bojaPoruke"></span>


                    </div>

                    <div>
                        <label class="lebelDizajn" style="margin-top: auto;">Spremiti u arhivu: </label>
                        <input type="checkbox" name="archive">


                    </div>
                    <div>
                        <button class="butt" type="reset" value="Poništi">Poništi</button>
                        <button class="butt" id="gumb" name="gumb" type="submit" value="Prihvati">Prihvati</button>
                    </div>
                </form>
                </form>
            </div>
        </div>

    </section>

    <footer class="container-lg">
        <hr class="crta">
        <div class="row malaSlova">
            <p class="col-4">@TITANIA COMPANIA EDITORIAL, S.L.2019. Espana. Todos los derechos reservados</p>
        </div>

    </footer>

   

    <script type="text/javascript">
        // Provjera forme prije slanja
        document.getElementById("gumb").onclick = function(event) {

            var slanjeForme = true;

            // Naslov vjesti (5-30 znakova)
            var poljeTitle = document.getElementById("title");
            var title = document.getElementById("title").value;
            if (title.length < 5 || title.length > 30) {
                slanjeForme = false;
                poljeTitle.style.border = "1px dashed red";
                document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
            } else {
                poljeTitle.style.border = "1px solid green";
                document.getElementById("porukaTitle").innerHTML = "";
            }

            // Kratki sadržaj (10-100 znakova)
            var poljeAbout = document.getElementById("about");
            var about = document.getElementById("about").value;
            if (about.length < 10 || about.length > 100) {
                slanjeForme = false;
                poljeAbout.style.border = "1px dashed red";
                document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
            } else {
                poljeAbout.style.border = "1px solid green";
                document.getElementById("porukaAbout").innerHTML = "";
            }
            // Sadržaj mora biti unesen
            var poljeContent = document.getElementById("content");
            var content = document.getElementById("content").value;
            if (content.length == 0) {
                slanjeForme = false;
                poljeContent.style.border = "1px dashed red";
                document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
            } else {
                poljeContent.style.border = "1px solid green";

                document.getElementById("porukaContent").innerHTML = "";
            }
            // Slika mora biti unesena
            var poljeSlika = document.getElementById("photo");
            var photo = document.getElementById("photo").value;
            if (photo.length == 0) {
                slanjeForme = false;
                poljeSlika.style.border = "1px dashed red";
                document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
            } else {
                poljeSlika.style.border = "1px solid green";
                document.getElementById("porukaSlika").innerHTML = "";
            }
            // Kategorija mora biti odabrana
            var poljeCategory = document.getElementById("category");
            if (document.getElementById("category").selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border = "1px dashed red";

                document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
            } else {
                poljeCategory.style.border = "1px solid green";
                document.getElementById("porukaKategorija").innerHTML = "";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }

        };
    </script>

</body>


</html>