<?php 
// Load API Class
require_once('../landing/api.class.php');

// Create API requester
$api = new CascoAPI('your_login', 'your_password');

// Get parameters for script
$calculation_id = $_GET['calculation_id'];
$assurer_id = $_GET['assurer_id'];
$tarif = $_GET['tarif'];

$status = '';

if (($calculation_id != NULL) and ($assurer_id != NULL) and ($tarif != NULL)) {
    $calculation = $api->getCalculationResult($calculation_id);
    $result = $api->getCalculationResultForAssurer($calculation_id, $assurer_id);    
    if (($calculation != NULL) and ($result != NULL)) {
        $status = 'SUCCESS';    
        include('../landing/index.php');
    } else {
        $status = 'NULL_RESPONSE';
        include('../landing/error.php');
    }
} else {
    $status = 'WRONG_PARAMETERS';
    include('../landing/error.php');
}
?>


