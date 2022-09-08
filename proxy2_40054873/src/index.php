<?php

include('functions.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

$data = $_GET['input_text'];
_log('Input text : ' . $data);
$data = explode("-", $data, 2);

$input_text= $data[0];
$input_text = urlencode($input_text);

$redirect = $data[1];
_log('Container : ' . $redirect);

$url = 'http://' . $redirect . '/?input_text=' . $input_text;

_log('URL : ' . $url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$curl_response = curl_exec($curl);
$curl_response = curl_exec($curl);

$curl_error = curl_error($curl);
_log('Curl error : ' . $curl);

$response = json_decode($curl_response, true);
$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
_log($curl_error);
_log('Curl Response :' . $curl_response);
_log('Response : ' . $response);

curl_close($curl);

$response_description = "";

if ($response_code === 200 && $response['error'] === False) {
    $response_description = "URL active for container";
    response($response, $response_code, $response_description);
} elseif ($response_code === 200 && $response['error'] === true) {
    $response_description = $response['string'];
    response($response, $response_code, $response_description);
} else {
    $response_description = "URL inactive for container";
    response($response, $response_code, $response_description);
}



    
?>