<?php

function alugarfilme($id, $cat) {
    switch ($cat) {
        case '28':
        $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\action.json';

        $conteudoJson = file_get_contents($file);           
        $filmes = json_decode($conteudoJson);
        break;
        
        default:
        # code...
        break;
    } 
  
    foreach ($filmes->results as $filme) {
        if ($filme->id == $id) {      
            
        $releaseYear = new DateTimeImmutable($filme->release_date);
        echo "<div class=\"box-filme\">";
        echo "<div class=\"box-poster\">";
        echo "<h6 style=\"text-align: center;\" class=\"box-informacoes\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
        echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
        echo "</div></br></div>";      

        break; 
        }
    }
}

function adicionarPreco($caminho, $genero) {
  $json = file_get_contents($caminho);
    
    // Decodifica o JSON em um array associativo
    $dados = json_decode($json, true);

    // Verifica se a decodificação foi bem-sucedida
    if ($dados === null) {
        throw new Exception("Falha ao decodificar o JSON");
    }

    $preco = 0;

    switch ($genero){
      case "action": 
  
        $preco = '0.30';      
        break;
      case 'fiction':        
        $preco = '0.40';      
        break;
      case 'animation': 
      
        $preco = '0.35';
        
        break;
      case 'comedy': 
            
        $preco = '0.35';
            
        break;
      case 'drama': 
              
        $preco = '0.20';
              
        break;
      case 'family': 
                
        $preco = '0.50';
                
        break;
      case 'horror': 
                  
        $preco = '0.45';
                  
        break;
        default:
          $preco = '0.25';
          break;

    }

    foreach ($dados['results'] as &$resultado) {
      $resultado["preco"] = $preco; // Substitua 'valor_do_atributo' pelo valor desejado
    }

    $jsonModificado = json_encode($dados, JSON_PRETTY_PRINT);

    // Verifica se a codificação foi bem-sucedida
    if ($jsonModificado === false) {
        throw new Exception("Falha ao codificar os dados em JSON");
    }

    // Escreve o JSON modificado de volta no arquivo
    if (file_put_contents($caminho, $jsonModificado) === false) {
        throw new Exception("Falha ao escrever os dados de volta no arquivo");
    }
}

?>