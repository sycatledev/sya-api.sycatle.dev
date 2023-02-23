<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$results = array();

try {
    $database = new PDO("mysql:host=127.0.0.1;dbname=sycatle_dev;charset=utf8", "root", "root");
    $statement = $database->prepare("SELECT `quote_text` , `quote_author` FROM `quotes` ORDER BY RAND() LIMIT 1");
    $statement->execute();

    $value = $statement->fetch();

    $results["status"] = 200;
    $results["message"] = "Success.";
    $results["response"] = $value;
} catch (Exception $e) {
    $results["status"] = 401;
    $results["message"] = "Error.";
} ?>
<?= json_encode($results) ?>