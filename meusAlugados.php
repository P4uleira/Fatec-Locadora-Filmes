<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Alugados</title>
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/catalogo.css">
    <link rel="stylesheet" href="./style/header-tablet.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</head>
<body>
    <?php
    include 'header.php';
    ?>
    <main class="main container">
        <div class="mAlugados">
            <h5>Consulte aqui todos os seus filmes alugados</h5>            

            <div class="form-group">
                <label for="inputCPF"><strong>Digite seu cpf para buscar</strong></label>
                <input type="text" class="form-control" id="inputCPF" data-mask="000.000.000-00" placeholder="Insira seu CPF" name="cpf">
                </br><a class="btn btn-primary" onclick="buscarAlugados()">Buscar</a>
            </div>
        </div>
        <?php 
        if (isset($_GET['cpf'])) {
            $cpf = $_GET['cpf'];
            $cpf = str_replace(array(".", "-"), "", $cpf);

            include 'request-api.php';                      
            buscarFilmesAlugados($cpf);
             
        }        
        
    ?>

    </main>

    <script>
        function buscarAlugados() {
            var cpf = document.getElementById('inputCPF').value;

            window.location.href = "meusAlugados.php?cpf=" + cpf;
        }
    </script>

    
    <script src="Js/main.js"></script>
</body>
</html>