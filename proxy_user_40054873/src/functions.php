<?php

$url = 'http://localhost:90';


// error log in wordpad for those links/pages without an output visual
function _log($input)
{
  error_log(print_r($input, TRUE));
}

// make object arrays easier to read
function pretty_var_dump($var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

// api response formatting
function response($data, $response_code, $response_desc)
{
  $response['data'] = $data;
  $response['response_code'] = $response_code;
  $response['response_desc'] = $response_desc;

  $json_response = json_encode($response);

  echo $json_response;
}


?>