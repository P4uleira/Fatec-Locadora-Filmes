<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/catalogo.css">

    
</head>
<body>
    <?php
    $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";
    $curl = curl_init();
    
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.themoviedb.org/3/authentication",
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
    
    $response = curl_exec($curl);
    
    $err = curl_error($curl);
    echo $err;
    curl_close($curl);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?language=pt-BR",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ". $apiKey,
            "accept: application/json"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);    

    $filmes = json_decode($response);
    echo "<pre>";
    foreach ($filmes->results as $filme) {
        echo "<div class=\"box-filme\">";
        echo "<img class=\"img\" src='https://image.tmdb.org/t/p/w500". $filme->poster_path . "'alt='Poster do Filme'>";
        echo $filme->title;
        echo "</div>";
        
        echo "</br>";
    }
    echo "</pre>";
    

    ?>
</body>
</html>