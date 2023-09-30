<?php
include 'request-api.php';
function alugarfilme($id, $cat)
{
  requestApi($cat);
  $file = 'C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\'.$cat.'.json';
    
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