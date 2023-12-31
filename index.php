<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora-Fatec</title>
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/catalogo.css">
    <link rel="stylesheet" href="./style/header-tablet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>

<body>

    <?php
    include 'request-api.php';
    if (!isset($_GET['cat'])) {

        $genero = "tendency";
        requestApi($genero);

    }

    include 'header.php';
    ?>

    
    <main class="main">
        <section class="chamada">
            <p>Aqui você encontra os filmes mais poggers do momento, Aproveite!!!</p>
        </section>

        <?php       

            if (isset($_GET['cat'])) {
                $genero = $_GET['cat'];
                $cat = $_GET['cat'];
                requestApi($genero);
                listaFilmes($cat);
            } else if (isset($_GET['name'])) {
                $name = $_GET['name'];
                buscaPorNome($name);
            } else {
                $cat = 'tendency';
                listaFilmes($cat);
            }
        ?>

    </main>
    <script src="Js/main.js"></script>
</body>

</html>