<?php
include 'request-api.php';
function alugarfilme($id, $cat)
{
  switch ($cat) {
    case '28':
      requestApi('action');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\28.json';
      break;
    case '878':
      requestApi('fiction');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\878.json';
      break;
    case '16':
      requestApi('animation');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\16.json';
      break;
    case '35':
      requestApi('comedy');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\35.json';
      break;
    case '18':
      requestApi('drama');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\18.json';
      break;
    case '10751':
      requestApi('family');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\10751.json';
      break;
    case '27':
      requestApi('horror');
      $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\27.json';
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
      echo "<p class=\"box-sinopse-alugar\"><em>" . $filme->overview . "</p>";
      echo "</div>";
      echo "</br>";

      echo "</div>";
    }
  }
}


?>