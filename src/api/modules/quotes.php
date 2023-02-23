<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$results = array();

require("../Config.php");

try {
    $database = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpassword);
    $statement = $database->prepare("SELECT `quote_text` , `quote_author` FROM `quotes` ORDER BY RAND() LIMIT 1");
    $statement->execute();

    $value = $statement->fetch();

    $results["status"] = 200;
    $results["message"] = "Success.";
    $results["response"] = $value;
} catch (PDOException $exception) {
    $results["status"] = 401;
    $results['message'] = $exception->getMessage();
} ?>
<?= json_encode($results) ?>