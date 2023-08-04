<?php
// Retrieve keyword data sent with AJAX
$keyword = $_POST['keyword']; 
// Load view.php
ob_start();
include "view.php";
// Put the contents of view.php into the $html variable
$html = ob_get_contents(); 
ob_end_clean();
// Create an array with the result index and its value $html
// Then convert to JSON
echo json_encode(array('result'=>$html));
?>