<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Authorization");
header('Content-type: application/json');

session_start();
$results = array();

if (!isset($_SESSION['user_token']))
{
    $results["status"] = 400;
    $results["message"] = "You are not connected.";
    $results["response"] = false;
} 
else 
{
    $token = $_SESSION['user_token'];

    $results["position"] = 1;

    require("../Config.php");

    try 
    {
        $database = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpassword);
        $results["position"] = 2;
    
        $statement = $database->prepare("SELECT `user_id` FROM `users` WHERE `user_id` = :user_id");
        $statement->execute(['user_id' => $token]);

        $results["position"] = 3;
    
        $row = $statement->fetch();
    
        if ($row > 0) 
        {
            $results["status"] = 200;
            $results["message"] = "Your session matched to a user in the database. Welcome back.";
            $results["response"] = true;
        }
        else
        {
            $results["status"] = 400;
            $results["message"] = "Your access token is no longer valid.";
            $results["response"] = false;
        }
        $results["position"] = 4;
    } 
    catch (PDOException $exception)
    {
        $results["status"] = 500;
        $results["message"] = "Error while trying to connect to the database.";
        $results["response"] = false;
    }
}
?>
<?= json_encode($results) ?>