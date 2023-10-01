<?php 
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $cpf = $_POST["cpf"];  
    $diasALugado = $_POST["diasALugado"];
    $valorAluguel = $_POST["valoraluguel"];
    $id = $_POST["id"];
    $cat = $_POST["cat"];
    $filmeNome = $_POST["filme"];
    
    $data = "Jundiai, " .strftime('%e') ." de ". ucfirst(strftime('%B')) . " de " . strftime('%Y');    
    $informacoes = $cpf . ";" . $filmeNome . ";" . $id . ";" . $cat . ";" . $data . ";" . $valorAluguel . ";" . $diasALugado;

    $linhaEncontrada = false; 
    $filmesALugados = fopen('alugadoS.txt', 'r');
    if ($filmesALugados) {              
       
        while (($linha = fgets($filmesALugados)) !== false) {            
            $linha = trim($linha);          
           
            if ($linha === $informacoes) {
                $linhaEncontrada = true;
                break; 
            }
        }
        fclose($filmesALugados);       
    }

    if(!$linhaEncontrada){
        $filmesALugados = fopen('alugados.txt', 'a');
        fwrite($filmesALugados, "$informacoes\n");
        fclose($filmesALugados);
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugado - <?php echo $filmeNome; ?></title>
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
        include 'header.php';
    ?>
    <main class="main container">

        <h3 style="text-align:center; margin-top: 6rem;">OBRIGADO POR ALUGAR CONOSCO</h3>
        <div style="display: flex;justify-content: center;gap: 10%;margin-top: 2.5rem;">
            <div style="line-height: 4rem;">
                <h5>INFORMAÇÕES DO SEU FILME:</h5>
                <Ul>
                    <li><strong>Filme</strong>: <?php echo $filmeNome; ?></li>
                    <li><strong>Valor</strong>: <?php echo $valorAluguel; ?></li>
                    <li><strong>Data da locação</strong>: <?php $data = new DateTime(); echo strftime('%d') ."/". strftime('%m') . "/" . strftime('%Y'); ?></li>
                    </br>
                    
                    
                </Ul>
            </div>
            <div>
                    <?php 
                        include 'request-api.php';
                        $poster = alugarfilme($id, $cat, 1);
                        echo "<img class=\"img-alugar\" src='https://image.tmdb.org/t/p/w500" . $poster . "'alt='Poster do Filme'>";
                    ?>
            </div>            
        </div>
        <h6 style="text-align: center; margin-top: 2rem">Você tem até 
                <?php
                    $dataLimite = (24 * $diasALugado);
                    $data->add(new DateInterval("PT{$dataLimite}H"));                            
                    echo $data->format('d/m/y') . " as " . $data->format('H:i:s');
                ?> para iniciar a exibição do filme.</h6> 
    </main>
</body>
<script src="Js/main.js"></script>
</html>