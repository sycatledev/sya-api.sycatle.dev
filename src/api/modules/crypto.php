<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$results = array();

if (isset($_GET["from"]) && isset($_GET['to'])) {
    $fromCurrency = $_GET['from'];
    $toCurrency = $_GET['to'];

    try {
        $value = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/price?fsym=$fromCurrency&tsyms=$toCurrency"));

        $results["status"] = 200;
        $results["message"] = "Success.";
        $results["response"] = $value;
    } catch (Exception $e) {
        $results["status"] = 401;
        $results["message"] = "Error.";
    }
} else {
    $results["status"] = 401;
    $results["message"] = "Please provide arguments.";
} ?>
<?= json_encode($results) ?>