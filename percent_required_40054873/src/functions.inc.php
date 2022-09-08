<?php
function getPercentRequired($input_text)
{
    $lines = explode("newline", $input_text);
    $module_marks=array();
    foreach ($lines as $line) {
       $line_array = explode(",", $line);
       $module_marks_array = array("module"=>$line_array[0], "marks" =>$line_array[1]);
       array_push($module_marks,$module_marks_array);
    }

   $total_marks = array_sum(array_column($module_marks, "marks"));
   $modules = 9-count($module_marks);
   $score_remaining = 540 - $total_marks;
   $percent_required = $score_remaining/$modules;

    return $percent_required;
}
