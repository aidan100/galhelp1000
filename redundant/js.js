import {httpGet, getAverage} from '.functions.js';

var input_text = <?php echo json_encode($_POST['my_post'] ?? null) ?>;

average=getAverage(input_text);




