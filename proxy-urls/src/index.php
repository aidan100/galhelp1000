<?php

include('functions.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
// include('urls.php');

// $file = 'urls.csv';

// if(!is_file($file)){
             
//     file_put_contents($file, $contents);     
// }




$input_text = $_REQUEST['input_text'];

// echo json_encode($input_text);
// $input_text = array('input_text' => $input_text);

$url = "http://127.0.0.1:81/" . "/?" . $input_text;
$url = urlencode($url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $URL );
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$curl_response = curl_exec($curl);
$response = json_decode($curl_response, true);
// pretty_var_dump($response);


$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// echo json_encode(curl_getinfo($curl));
$response_description = "";


if($response_code === '200'){
    $response_description = "URL active for container";
    response($response, $response_code, $response_description);
} else {
    $response_description = "URL inactive for container";
    response($response, $response_code, $response_description);
}

curl_close($curl);




?>