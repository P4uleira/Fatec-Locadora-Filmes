<?php
include 'request-api.php';
function alugarfilme($id, $cat) {
    switch ($cat) {
        case '28':
          requestApi('action');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\action.json';         
        break;
        case '878':
          requestApi('fiction');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\fiction.json';
        break;
        case '16':
          requestApi('animation');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\animation.json';
        break;
        case '35':
          requestApi('comedy');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\comedy.json';
        break;
        case '18':
          requestApi('drama');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\drama.json';
        break;
        case '10751':
          requestApi('family');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\family.json';
        break;
        case '27':
          requestApi('horror');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\horror.json';
        break;        
        default:
          requestApi('tendency');
          $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\tendecy.json';
        break;
    }
    $conteudoJson = file_get_contents($file);           
    $filmes = json_decode($conteudoJson); 
  
    foreach ($filmes->results as $filme) {
        if ($filme->id == $id) {      
            
          echo "<div class=\"box-filme-alugar\">";          
              $releaseYear = new DateTimeImmutable($filme->release_date);
              echo "<div class=\"box-poster-alugar\">";
              echo "<img class=\"img-alugar\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
              echo "<h6 class=\"box-informacoes-alugar\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
              echo "<p class=\"box-sinopse-alugar\"><em>" .$filme -> overview . "</p>";
              echo "</div>";
              echo "</br>";
          
          echo "</div>";
        }
    }
}

function adicionarPreco($caminho, $genero)
{
  $json = file_get_contents($caminho);

  // Decodifica o JSON em um array associativo
  $dados = json_decode($json, true);

  // Verifica se a decodificação foi bem-sucedida
  if ($dados === null) {
    throw new Exception("Falha ao decodificar o JSON");
  }

  $preco = 0;

  switch ($genero) {
    case "28":

      $preco = '0.30';
      break;
    case '878':
      $preco = '0.40';
      break;
    case '16':

      $preco = '0.35';

      break;
    case '35':

      $preco = '0.35';

      break;
    case '18':

      $preco = '0.20';

      break;
    case '10751':

      $preco = '0.50';

      break;
    case '27':

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