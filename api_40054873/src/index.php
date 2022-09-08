<?php

// return api results
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");


include_once('functions.php');
include_once('config.php');


$conn = new mysqli($host, $user, $pass, $mydatabase, $port);
if ($conn->connect_error) {
    _log("Connection error : " . $conn->connect_error);
} else {
    _log("Connected to MySQL server successfully!");
}


$email = $_GET['email'];
$signin_password = $_GET['password'];


$select_query = "SELECT user_password, user_id, user_email, user_status FROM MYSQL_DATABASE.user_login WHERE user_login.user_email = ?";
_log("SQL Query : " . $select_query);

// $result = mysqli_query($conn, $select_query);
// $result = $conn->query($select_query);
$select_query = $conn->prepare($select_query);
$select_query->bind_param("s", $email);
$select_query->execute();
$result = $select_query->get_result()->fetch_all(MYSQLI_ASSOC);

_log("Result 1 : " . $result);
// $result = $result[0];
// $email_returned = $result['user_email'];
// $password_returned = $result['user_password'];
// _log("Result data : " . $email_returned);
// _log("Result data : " . $password_returned);


if (isset($result)) {
    _log('z');
    if (isset($result[0])) {
        $result = $result[0];
        _log('x');
        if (isset($result['user_password']) && $result['user_password']) {
            _log("a");
            if ($result['user_password']) {
                _log("b");
                _log($result['user_status']);
                _log($result['user_id']);
                if (isset($result['user_status']) && $result['user_status'] === 1 && isset($result['user_id'])) {
                    _log("c");
                    $_SESSION['loggedIn'] = $result['user_status'];
                    response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
                } elseif (isset($result['user_status']) && $result['user_status'] === 2 && isset($result['user_id'])) {
                    _log("d");
                    $_SESSION['loggedIn'] = $result['user_status'];
                    response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
                }
            } else {
                $_SESSION['loggedIn'] = false;
                response('N/A', 401, 'Password incorrect');
                _log("e");
            }
        }
    } else {
        response('N/A', 401, 'Email address not found');
    }
}






// if (isset($result)) {
//     if (isset($result[0])) {
//         $result = $result[0];
//         _log("a");
//         if (isset($result['user_password']) && $result['user_password']) {
//             if ($result['user_password']) {
//                 if (isset($result['user_status']) && $result['user_status'] === "1" && isset($result['user_id'])) {
//                     $_SESSION['loggedIn'] = $result['user_status'];
//                     $response = response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
//                     _log('b');
//                 } elseif (isset($result['user_status']) && $result['user_status'] === "2" && isset($result['user_id'])) {
//                     $_SESSION['loggedIn'] = $result['user_status'];
//                     response(['user_id' => $result['user_id'], 'session' => $result['user_status']], 200, 'Sign in successful');
//                     _log('c');
//                 }
//             } else {
//                 $_SESSION['loggedIn'] = false;
//                 response('N/A', 401, 'Password incorrect');
//                 _log('d');
//             }
//         }
//     } else {
//         response('N/A', 401, 'Email address not found');
//     }

//     _log(response($data, $response_code, $response_desc));
// }
