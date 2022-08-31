<?php

include_once('config.php');
include_once('functions.php');

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

if($url == 'http://localhost:90/'){
    $postRequest = [
        'email' => $_POST['email'],
        'password' => $_POST['password']
        ];

        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://127.0.0.1:86');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_PORT, 86);

        $query .= '?';
        if($postRequest!==NULL){
            $query.=http_build_query($postRequest);
        }

        echo $query;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($curl_response, true);

        pretty_var_dump($response);
        
} else {
    echo "didnt work";
}



?>