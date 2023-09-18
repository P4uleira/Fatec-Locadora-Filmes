<?php
function adicionarPreco($caminho, $genero) {
  $json = file_get_contents($caminho);
    
    // Decodifica o JSON em um array associativo
    $dados = json_decode($json, true);

    // Verifica se a decodificação foi bem-sucedida
    if ($dados === null) {
        throw new Exception("Falha ao decodificar o JSON");
    }

    $preco;

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


function requestApi($genero) {
  $generoId;
  $caminho = "C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\";
  $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
  switch($genero){
    case "action": 
  
        $generoId = '28';
      
      break;
      case 'fiction': 
        
          $generoId = '878';
      
        break;
        case 'animation': 
        
            $generoId = '16';
          
          break;
          case 'comedy': 
            
              $generoId = '35';
            
            break;
            case 'drama': 
              
                $generoId = '18';
              
              break;
              case 'family': 
                
                  $generoId = '10751';
                
                break;
                case 'horror': 
                  
                    $generoId = '27';
                  
                  break;
                  default:
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
                
                  if(file_exists($caminho . $generoApiRequest)){
                  }else{
                      $generoFilmes = $caminho . $generoApiRequest;
                      file_put_contents($generoFilmes, $respostaApi);
                  }
                  break;
  }

  

  //Tendency movie request
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $generoId ."&language=pt-BR",
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

  $generoApiRequest = $genero . ".json";
    
  curl_close($curl);

  if(!file_exists($caminho . $generoApiRequest)){
    $generoFilmes = $caminho . $generoApiRequest;
    file_put_contents($generoFilmes, $respostaApi);
    adicionarPreco($generoFilmes, $genero);
  }

/*
  //Action movie request
  $curl = curl_init();

  $action_id = '28';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $action_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "action.json")){
  }else{
      $actionJson = $caminho . "action.json";
      file_put_contents($actionJson, $respostaApi);
  }


  //Fiction movie request
  $curl = curl_init();

  $fiction_id = '878';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $fiction_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "fiction.json")){
  }else{
      $fictionJson = $caminho . "fiction.json";
      file_put_contents($fictionJson, $respostaApi);
  }


  //Animation movie request
  $curl = curl_init();

  $animation_id = '16';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $animation_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "animation.json")){
  }else{
      $animationJson = $caminho . "animation.json";
      file_put_contents($animationJson, $respostaApi);
  }


  //Comedy movie request
  $curl = curl_init();

  $comedy_id = '35';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $comedy_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "comedy.json")){
  }else{
      $comedyJson = $caminho . "comedy.json";
      file_put_contents($comedyJson, $respostaApi);
  }


  //Drama movie request
  $curl = curl_init();

  $drama_id = '18';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $drama_id."&language=pt-BR",
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
    
  curl_close($curl);
  
  if(file_exists($caminho . "drama.json")){
  }else{
      $dramaJson = $caminho . "drama.json";
      file_put_contents($dramaJson, $respostaApi);
  }

  //Family movie request
  $curl = curl_init();

  $family_id = '10751';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $family_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "family.json")){
  }else{
      $familyJson = $caminho . "family.json";
      file_put_contents($familyJson, $respostaApi);
  }


  //Horror movie request
  $curl = curl_init();

  $horror_id = '27';

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=". $horror_id."&language=pt-BR",
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
    
  curl_close($curl);

  if(file_exists($caminho . "horror.json")){
  }else{
      $horrorJson = $caminho . "horror.json";
      file_put_contents($horrorJson, $respostaApi);
  }
  */
}

function buscaPorNome($name)
{

    echo "Mostrando opções para ". $name;
    $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?".$apiKey."&query=".$name."&language=pt-BR",
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
        $releaseYear = new DateTimeImmutable($filme->release_date);
        echo "<div class=\"box-poster\"><a onclick=\"alugarFilme(".$filme->id. ", ".$filme->genre_ids[0].")\">";
        echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
        echo "<h6 class=\"box-informacoes\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
        echo "</a></div>";
        echo "</br>";
    }
    echo "</div>";


}

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
?>