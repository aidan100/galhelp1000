<?php

include_once('config.php');
include_once('functions.php');
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

$url = $_SERVER['HTTP_REFERER'];
echo $url;

$port = $_SERVER['SERVER_PORT'];
echo $port;

$conn = new mysqli($host, $user, $pass, $mydatabase);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}


$email = $_POST['email'];
$password = $_POST['password'];

$poststring = '?email' . '=' . $email . '&password=' . $password;

$post_request = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];
echo $poststring;

$prev_url = $_SERVER['HTTP_REFERER'];

if ($prev_url === 'http://127.0.0.1:90/') {
    $container = 'api';
} else {
    $container = 'signup_api';
}

_log('Container : ' . $container);

$url = 'http://' . $container . '/?email=' . $email . '&password=' . $password;
_log('URL : ' . $url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$curl_response = curl_exec($curl);
$result = json_decode($curl_response, true);

$curl_response = curl_exec($curl);
$curl_error = curl_error($curl);
_log('Curl error : ' . $curl);
$response = json_decode($curl_response, true);
$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
_log($curl_error);
_log('Curl Response :' . $curl_response);
_log('Response : ' . $response);
curl_close($curl);
