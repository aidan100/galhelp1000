<?php

include('functions.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
// include('urls.php');

// $file = 'urls.csv';

// if(!is_file($file)){

//     file_put_contents($file, $contents);
// }


$input_text = $_GET['input_text'];
$input_text = urlencode($input_text);
$url = 'http://average/?input_text=' . $input_text;

// _log($input_text);
// _log($url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$curl_response = curl_exec($curl);
$result = json_decode($curl_response, true);

$curl_response = curl_exec($curl);
$curl_error = curl_error($curl);
$response = json_decode($curl_response, true);
$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// _log($curl_error);
// _log($curl_response);
// _log($response);
curl_close($curl);

$response_description = "";


if ($response_code === '200') {
    $response_description = "URL active for container";
    response($response, $response_code, $response_description);
} else {
    $response_description = "URL inactive for container";
    response($response, $response_code, $response_description);
}
