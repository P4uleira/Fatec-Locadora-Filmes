<?php
include 'alugar-api.php';

//Função para realizar pedidos a API do site The Movies DataBase
function requestApi($genero)
{
  $generoId = 'tendency';
  $caminho = "C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\";
  $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
  switch ($genero) {
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

      if (file_exists($caminho . $generoApiRequest)) {
      } else {
        $generoFilmes = $caminho . $generoApiRequest;
        file_put_contents($generoFilmes, $respostaApi);
      }
      break;
  }



  //Requisão da página de tendências do momento.
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?with_genres=" . $generoId . "&language=pt-BR",
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

  if (!file_exists($caminho . $generoApiRequest)) {
    $generoFilmes = $caminho . $generoApiRequest;
    file_put_contents($generoFilmes, $respostaApi);
    //adicionarPreco($generoFilmes, $genero);
  }

}

//Busca por nome do filme, o mesmo retorna do site todos os filmes com o mesmo nome buscado.
function buscaPorNome($name)
{

  echo "Mostrando opções para " . $name;
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
    $releaseYear = new DateTimeImmutable($filme->release_date);
    if (isset($filme->genre_ids[0])) {
      echo "<div class=\"box-poster\"><a onclick=\"alugarFilme(" . $filme->id . ", " . $filme->genre_ids[0] . ")\">";
    }
    echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500" . $filme->poster_path . "'alt='Poster do Filme'>";
    echo "<h6 class=\"box-informacoes\"><em>" . $filme->title . "</em><br><strong>" . $releaseYear->format('Y') . "</strong></h6>";
    echo "</a></div>";
    echo "</br>";
  }
  echo "</div>";


}

?>