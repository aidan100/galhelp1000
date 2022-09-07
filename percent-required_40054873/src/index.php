<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');
require('inputchecker.php');

$output = array(
	"error" => false,
	"string" => "",
	"answer" => 0
);

$input_text = $_REQUEST['input_text'];

$percent_required = check($input_text);

if ($percent_required) {
	$answer = check($input_text);
	$output['string'] = $answer;
	$output['answer'] = $answer;
} elseif ($input_text) {
	$answer = getPercentRequired($input_text);
}
$output['string'] = $input_text . "=" . $answer;
$output['answer'] = $answer;

echo json_encode($output);
exit();
