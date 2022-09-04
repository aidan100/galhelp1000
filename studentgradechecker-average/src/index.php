<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json, charset=utf-8");
include('functions.inc.php');

$output = array(
	"error" => false,
  "string" => "",
	"answer" => 0
);

$input_text = $_GET['input_text'];
echo json_encode($urlencode($input_text));
// $input_text = json_encode($input_text);

$answer=getAverage($input_text);

$output['string']=$input_text."=".$answer;
$output['answer']=$answer;

echo json_encode($output);
exit();