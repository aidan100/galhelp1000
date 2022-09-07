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


if ($input_text === NULL) {
	$output['error'] = True;
	$output['string'] = "Could not read input text";
	$output['answer'] = NULL;
} else {
	$answer = getAverage($input_text);
	if (isset($answer) && is_numeric($answer)) {
		$output['error'] = False;
		$output['string'] = $input_text . "=" . $answer;
		$output['answer'] = $answer;
	} else {
		$output['error'] = True;
		$output['string'] = "Problem calculating - answer not numeric or unset. Check input text formatting and functions";
		$output['answer'] = $answer;
	}
}

echo json_encode($output);
exit();
