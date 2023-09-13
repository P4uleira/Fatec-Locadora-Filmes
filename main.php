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

curl_close($curl);


curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie",
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
  
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $jsonFilePath = "response.json";
    file_put_contents($jsonFilePath, $response);

    echo "Os dados foram salvos em $jsonFilePath.";
}