<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');
require('inputcheck.php');

$output = array(
	"error" => false,
  "string" => "",
	"answer" => 200
);

$input_text = $_GET['input_text'];

if ($input_text === NULL) {
	$output['error'] = true;
	$output['string'] = "Could not read input text";
	$output['answer'] = NULL;
} else {
	$answer = check($input_text);
	if (isset($answer) && is_numeric($answer)) {
		$answer  =
		$output['error'] = false;
		$output['string'] = $input_text . "=" . $answer;
		$output['answer'] = $answer;
	} else {
		$output['error'] = true;
		$output['string'] = "Problem calculating total - answer not numeric or unset. Check input text formatting and functions";
		$output['answer'] = NULL;
	}
}

echo json_encode($output);
exit();
