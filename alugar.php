<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar - 
        <?php 
            if (isset($_GET['filme'])) {
                $filme = $_GET['filme'];
                printf($filme);
            }else {
                printf("Teste");
            }      
        
        ?>

    </title>
    <link rel="stylesheet" href="./style/reset.css">
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
    <header>
        <div class="header">
            <h2 style="text-align: center;" class="display">
                <a class="tituloPrincipal" href="index.php">
                    <span style="cursor:pointer">Locadora Poggers</span>
                </a>
            </h2>
        </div>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
        </label>
        <div id="sidebarMenu">
            <ul class="sidebarMenuInner">
                <li>
                    <div class="input-group mb-3">
                        <input id="titulo" type="text" class="form-control" placeholder="Buscar Filme"
                            aria-label="Buscar" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <a onclick="informaNome()" class="btn btn-outline-secondary" type="button">a</a>
                        </div>
                    </div>
                </li>
                <li><a style="color: #F0F0F0;" href="#">Meus Filmes ALugados</a></li>
                <br>
                <li><a style="color: #F0F0F0;" href="index.php?cat=action">Ação</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=fiction">Ficção</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=animation">Animação</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=comedy">Comedia</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=drama">Drama</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=family">Familia</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=horror">Terror</a></li>
            </ul>
        </div>
    </header>
    <main class="main container">
        <form action="">
            <?php 
                include 'request-api.php';
                include 'apiFilmes.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $cat = $_GET['cat'];
                    alugarfilme($id, $cat);
                } 
            
            ?>
            
             
            <div class="form-group">
                <label for="inputCPF">CPF</label>
                <input type="text" class="form-control" id="inputCPF" placeholder="Insira seu CPF">
            </div>            
            <div class="form-group">
                <label for="exampleFormControlSelect1">Alugar por quantos dias?</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>1 Dia</option>
                    <option>2 Dias</option>
                    <option>3 Dias</option>
                    <option>4 Dias</option>
                    <option>5 Dias</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputCPF">Valor do Filme</label>
                <?php
                    echo "<input type=\"text\" disabled class=\"form-control\" id=\"inputCPF\" placeholder=\"R$\">";
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Alugar</button>
        </form>
    </main>
</body>
</html>