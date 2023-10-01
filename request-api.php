<?php
//Função para realizar pedidos a API do site The Movies DataBase

function requestApi($genero) {
  $caminho = "C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\";
  $curl = "";
  
  $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
  if ($genero === '') {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.themoviedb.org/3/trending/movie/week?api_key=" . $apiKey . "?language=pt-BR",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $apiKey,
        "accept: application/json"
      ],
    ]);

    $respostaApi = curl_exec($curl);

    $erroApi = curl_error($curl);
    $generoApiRequest = $genero . ".json";
    curl_close($curl);

    if (file_exists($caminho . $generoApiRequest)) {
    } else {
      $generoFilmes = $caminho . $generoApiRequest;
      file_put_contents($generoFilmes, $respostaApi);
    }
  } else {

    //Requisão da página de tendências do momento.
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=" . $genero . "&language=pt-BR",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer " . $apiKey,
        "accept: application/json"
      ],
    ]);
  }

  $respostaApi = curl_exec($curl);

  $generoApiRequest = $genero . ".json";

  curl_close($curl);

  if (!file_exists($caminho . $generoApiRequest)) {
    $generoFilmes = $caminho . $generoApiRequest;
    file_put_contents($generoFilmes, $respostaApi);
    adicionarPreco($generoFilmes, $genero);
  }

}

function alugarfilme($id, $cat, $onlyPoster = "0", $woverview = "0") {
  requestApi($cat);
  $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\'.$cat.'.json';
    
  $conteudoJson = file_get_contents($file);
  $filmes = json_decode($conteudoJson);

  foreach ($filmes->results as $filme) {
    if ($filme->id == $id) {
      if ($onlyPoster == 0) {
        echo "<div class=\"box-filme-alugar\">";
        $releaseYear = new DateTimeImmutable($filme->release_date);
        echo "<div class=\"box-poster-alugar\">";
        echo "<img class=\"img-alugar\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
        echo "<h6 class=\"box-informacoes-alugar\"><em>" . $filme->title . "</em><strong>" . $releaseYear->format('Y') . "</strong></h6>";
        if ($woverview == 0){
          echo "<p class=\"box-sinopse-alugar\"><em>" . $filme->overview . "</em></p>";
        }
        echo "</div>";
        echo "</br>";

        echo "</div>";

        return $filme->preco;
      } else {
        return $filme->poster_path;
      }
    }
  }
}

// Função para buscar o filme pelo nome inserido no input do menu do Header
function buscaPorNome($name) {
  $caminho = "C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\";
  echo "<h3 style=\"text-align: center; margin-bottom: 2rem;\">Mostrando opções para " . $name . "</h3>";
  $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?" . $apiKey . "&query=" . $name . "&language=pt-BR",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "Authorization: Bearer " . $apiKey,
      "accept: application/json"
    ],
  ]);

  $respostaApi = curl_exec($curl);
  curl_close($curl);

  $filmes = json_decode($respostaApi);
  echo "<div class=\"box-filme\">";
  foreach ($filmes->results as $filme) {    
    if(!empty($filme->genre_ids[0]) && $filme->poster_path != NULL) {
      $generoApiRequest = $filme->genre_ids[0] . ".json";
      $caminhoCompleto = $caminho . $generoApiRequest;
      if (file_exists($caminhoCompleto)) {
        $json = file_get_contents($caminhoCompleto);
        $dados = json_decode($json, true);

        $temId = false;
        $filmeId = $filme->id;
        
        foreach ($dados['results'] as &$resultado) {  
          if ($resultado['id'] == $filmeId) {
            $temId = true;
          }
        }

        if ($temId == false) {
          $dados['results'][] = $filme;
          
        }

        $jsonModificado = json_encode($dados, JSON_PRETTY_PRINT);
        file_put_contents($caminhoCompleto, $jsonModificado);
        adicionarPreco($caminhoCompleto, $filme->genre_ids[0]);

      }

      $releaseYear = new DateTimeImmutable($filme->release_date);
      if (isset($filme->genre_ids[0])) {
        echo "<div class=\"box-poster\"><a style=\"cursor: pointer;\" onclick=\"alugarFilme(" . $filme->id . ", " . $filme->genre_ids[0] . ")\">";
      }
      echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
      echo "<h6 class=\"box-informacoes\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
      echo "</a></div>";
      echo "</br>";
    }
  }
  echo "</div>";
}

// Função para Adicionar o preço em cada filme do arquivo do Json por categoria
function adicionarPreco($caminho, $genero) {
  $json = file_get_contents($caminho);
  
  $dados = json_decode($json, true);
  
  if ($dados === null) {
    throw new Exception("Falha ao decodificar o JSON");
  }

  $preco = 0;

  switch ($genero) {
    case "28":
      $preco = 0.30;
      break;
    case '878':
      $preco = 0.40;
      break;
    case '16':
      $preco = 0.35;
      break;
    case '35':
      $preco = 0.35;
      break;
    case '18':
      $preco = 0.20;
      break;
    case '10751':
      $preco = 0.50;
      break;
    case '27':
      $preco = 0.45;
      break;
    default:
      $preco = 0.25;
      break;

  }

  foreach ($dados['results'] as &$resultado) {
    if (!isset($resultado['preco'])) {
        $resultado['preco'] = $preco;
    } 
  }

  $jsonModificado = json_encode($dados, JSON_PRETTY_PRINT);

  
  if ($jsonModificado === false) {
    throw new Exception("Falha ao codificar os dados em JSON");
  }

  
  if (file_put_contents($caminho, $jsonModificado) === false) {
    throw new Exception("Falha ao escrever os dados de volta no arquivo");
  }
}

// Função para listar os filmes no index
function listaFilmes($cat) {
    $path = 'Json/' . $cat . '.json';
    $response = file_get_contents($path);
    $filmes = json_decode($response);
    echo "<div class=\"box-filme\">";
    foreach ($filmes->results as $filme) {
        $releaseYear = new DateTimeImmutable($filme->release_date);
        echo "<div class=\"box-poster\"><a style=\"cursor: pointer;\" onclick=\"alugarFilme(".$filme->id. ", ".$filme->genre_ids[0]. ", '".$filme->title."')\">";
        echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
        echo "<h6 class=\"box-informacoes\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
        echo "</a></div>";
        echo "</br>";
    }
    echo "</div>";
}

function buscarFilmesAlugados($cpf) {
  $ids = array();
  $cats = array();

  $alugados = fopen('alugados.txt', 'r');

  if ($alugados) {
    $qtdFilmes = 0;
    echo "<div style=\"display: flex; gap: 10%; justify-content: center; flex-wrap: wrap; flex-direction: row;\">";
    while (($linha = fgets($alugados)) !== false) {        
        $valores = explode(';', $linha);        
        
        if (isset($valores[0]) && $valores[0] == $cpf) {
          $qtdFilmes++;
          
          if ($qtdFilmes == 1) {
            echo "<h4 style=\"text-align: center;\">Aqui estão seus filmes alugados: </h4>";
          }

          echo "<div style=\"width: 300px\">";;
          alugarfilme($valores[2], $valores[3], "0", "1");
          echo "<strong>Valor</strong>: ". $valores[5];
          $dataMaxima = explode(',', $valores[4]);
          $dataMaxima = explode(' ', $dataMaxima[1]);
          $dataMaxima[2] = intval($dataMaxima[2]) + intval($valores[6]);
          $dataMaxima = implode(' ', $dataMaxima);
          echo "</br><p>Você tem até o dia ". $dataMaxima . " para assistir este filme.</p>";
          echo "</div>";                  
        }
        
    }
    echo "</div>";  
    fclose($alugados);

    if ($qtdFilmes == 0) {
      echo "<h4 style=\"text-align: center;\">Não foram encontrados filmes para este CPF.</br>Verifique se o CPF digitado está correto</h4>";
    }
    
  } else {
      echo 'Não foi possível abrir o arquivo.';
  }

}



?>