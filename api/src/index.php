<?php

// return api results
header('Content-Type: application/json; charset=utf-8');

include_once('functions.php');
include_once('config.php');


$conn = new mysqli($host, $user, $pass, $mydatabase);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}


$email = $_POST['email'];
$signin_password = $_POST['password'];

var_dump($_POST);




$select_query = "SELECT user_password, user_id, user_email, user_status FROM user_login WHERE user_email = '{$email}'";

echo $select_query;
$result = $conn->query($select_query);


if (isset($result)) {
    $result = $result->fetch_all(MYSQLI_ASSOC);
    pretty_var_dump($result);
    if (isset($result[0])) {
        $result = $result[0];

        if (isset($result['user_password']) && $result['user_password']) {
            if ($result['user_password']) {
                if (isset($result['user_status']) && $result['user_status'] === "1" && isset($result['user_id'])) {
                    $_SESSION['loggedIn'] = $result['user_status'];
                    response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
                } elseif (isset($result['user_status']) && $result['user_status'] === "2" && isset($result['user_id'])) {
                    $_SESSION['loggedIn'] = $result['user_status'];
                    response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
                }
            } else {
                $_SESSION['loggedIn'] = false;
                response('N/A', 401, 'Password incorrect');
            }
        }
    } else {
        response('N/A', 401, 'Email address not found');
    }
}
