<?php

function listaFilmes($cat)
{
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

?>