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

//if($url == 'http://localhost:90/'){
    
        $email = $_POST['email'];
        $password = $_POST['password'];

        $poststring = '?email' . '=' . $email . '&password=' . $password; 

        $post_request = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
            ];
        echo $poststring;
            
        // $data = http_build_query($postRequest);
        //$data = '{"email":"'.$email.'", "password":"'.$password.'"}';
        $post = array('email'=>$email, 'password'=>$password);
        $headers = array(
            "Content-Type: application/json",
            "Accept: application/json",
         );
        
        $request = array();
        $request[] = "Host: http://127.0.0.1:86";
        $request[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $request[] = "User-Agent: MOT-V9mm/00.62 UP.Browser/6.2.3.4.c.1.123 (GUI) MMP/2.0";
        $request[] = "Accept-Language: en-US,en;q=0.5";
        $request[] = "Connection: keep-alive";
        $request[] = "Cache-Control: no-cache";
        $request[] = "Pragma: no-cache";

         
        $curl = curl_init("http://127.0.0.1:86");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        $curl_response = curl_exec($curl);
        var_dump($curl_response);
        curl_close($curl);
        
        $response = json_decode($curl_response, true);

        pretty_var_dump($response);
        
//} else {
//    echo "didnt work";
// }



?>