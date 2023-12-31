<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar -
        <?php
        if (isset($_GET['filme'])) {
            $filme = $_GET['filme'];
            printf($filme);
        } else {
            printf("Teste");
        }

        ?>

    </title>
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/global.css">
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
    <script src="./Js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>

<body>
    <?php 
        include 'header.php';
    ?>
    <main class="main container">
        <form style="padding-bottom: 3rem;" action="alugado.php" method="post" onsubmit="return validarFormulario()";>
            <?php
                include 'request-api.php';                
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $cat = $_GET['cat'];
                    $preco = alugarfilme($id, $cat);
                }

            ?>
            <div class="form-group">
                <label for="inputCPF">CPF</label>
                <input type="text" class="form-control" id="inputCPF" data-mask="000.000.000-00" placeholder="Insira seu CPF" name="cpf">
            </div>
            <div class="form-group">
                <label for="diasAlugar">Alugar por quantos dias?</label>
                <select name="diasALugado" class="form-control" id="diasAlugar" onchange="alteraValor()">
                    <option value="1">1 Dia</option>
                    <option value="2">2 Dias</option>
                    <option value="3">3 Dias</option>
                    <option value="4">4 Dias</option>
                    <option value="5">5 Dias</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputValor">Valor do Aluguel</label>
                <input readonly type="text" class="form-control" id="inputValor" value="R$ <?php echo $preco ?>" name="valoraluguel">
                <?php                    
                    echo "<input name=\"id\" type=\"text\" readonly class=\"d-none\" id=\"id\" value=\"" .$id."\"> ";
                    echo "<input name=\"cat\" type=\"text\" readonly class=\"d-none\" id=\"cat\" value=\"" .$cat."\"> ";
                    echo "<input name=\"filme\" type=\"text\" readonly class=\"d-none\" id=\"filme\" value=\"" .$filme."\"> ";
                    echo "<input type=\"text\" disabled class=\"d-none\" id=\"inputValorHide\" value=\"".$preco."\"> ";                 
                    
                ?>
                </br>
                <input style="margin-botton: 2rem;" type="submit" name="btnAlugar" value="Alugar" class="btn btn-primary">
            </div>
        </form>
    </main>

    <script>
        $(document).ready(function () {
            $('#inputCPF').inputmask('999.999.999-99', { removeMaskOnSubmit: true });
        });

        function alteraValor() {
            
            var dias = document.getElementById("diasAlugar").value;
            dias = parseInt(dias);     

            var valor = document.getElementById("inputValorHide").value;
            valor = parseFloat(valor);
            valor = (valor * dias).toFixed(2);        

            document.getElementById("inputValor").value = "R$ " + valor;
        }

        function validarFormulario() {            
            var cpf = document.getElementById('inputCPF').value;
            console.log(cpf.length)
            if (cpf.length !== 14) {
                alert("CPF inválido.");
                return false; 
            }                 
            return true;
        }
    </script>
    <script src="Js/main.js"></script>
</body>

</html>