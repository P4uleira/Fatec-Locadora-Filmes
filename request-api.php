<?php

function teste() {
  $apiKey = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NmMyMThmMTYxNWI0MDJiNjJlOGIxMWRiYjIzZGE0YSIsInN1YiI6IjY1MDA2MzNkZmZjOWRlMGVkZWQ0MmY2MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ueh4Vo9sl3a7TMVPkKIsUBZce2PU0BwdGqGRFE54l70";

  $caminho = "C:\\xampp\\htdocs\\Fatec-Locadora-Filmes\\Json\\";

  //Tendency movie request
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
    
  curl_close($curl);

  if(file_exists($caminho . "tendency.json")){
  }else{
      $tendencyJson = $caminho . "tendency.json";
      file_put_contents($tendencyJson, $respostaApi);
  }


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
}
?>