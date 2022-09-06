<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');

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
	$result = getSortedModules($input_text);
	if (!empty($result)) {
		foreach ($result as $module_marks) {
			$answer = $answer . $module_marks['module'] . ', ' . $module_marks['marks'] . 'newline';
		}
	} else {
		$output['error'] = False;
		$output['string'] = "Check function - sort array failing";
		$output['answer'] = NULL;
	}
	if (isset($answer)) {
		$output['error'] = False;
		$output['string'] = $input_text . "=" . $answer;
		$output['answer'] = $answer;
	} else {
		$output['error'] = True;
		$output['string'] = "Problem calculating - answer not numeric or unset. Check input text formatting and functions";
		$output['answer'] = NULL;
	}
}

echo json_encode($output);
exit();
