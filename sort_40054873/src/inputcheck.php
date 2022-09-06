<?php
function check($input_text)
{
    $lines = explode("newline", $input_text);
    $module_marks = array();
    foreach ($lines as $line) {
        $line_array = explode(",", $line);
        $module_marks_array = array("module" => $line_array[0], "marks" => $line_array[1]);
        array_push($module_marks, $module_marks_array);
        if (empty($line_array[0])) {
            $check = "One of the module names is empty";
        } elseif (empty($line_array[1])){
            $check = "One of the module marks is empty";
        } elseif (($line_array[1] < 0) || ($line_array[1] > 100)) {
            $check = "number must be between 0-100";
        } elseif (!is_numeric($line_array[1])) {
            $check = "the grade must be numeric";
        } else {
        }
    }
    return $check;
}