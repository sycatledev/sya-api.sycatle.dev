<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$results = array();

if (isset($_GET["city"])) {
    $fromCity = $_GET['city'];
    $fromCity = str_replace(" ", "%20", $fromCity);

    try {
        $value = json_decode(file_get_contents("https://api.weatherapi.com/v1/current.json?key=976b0a2104af409484a181816230202&q=$fromCity&aqi=no"));

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