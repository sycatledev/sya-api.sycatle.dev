<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Authorization");
header('Content-type: application/json');

session_start();
$results = array();

require("../Config.php");

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data["identifier"]) && isset($data['password'])) {
    $identifier = $data['identifier'];
    $password = $data['password'];

    try {
        $database = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpassword);

        $statement = $database->prepare("SELECT `user_id` , `user_nickname`, `user_firstname`, `user_lastname`, `user_city`, `user_password`   FROM `users` WHERE `user_mail` = :identifier OR `user_nickname` = :identifier");
        $statement->execute(['identifier' => $identifier]);

        $row = $statement->fetch();

        if ($row) {
            if (password_verify($password, $row["user_password"])) {
                $results["status"] = 200;
                $results["message"] = "Successfully authenticated.";
                $results["user"] = [
                    "token" => $row['user_id'],
                    "username" => $row['user_nickname'],
                    "firstname" => $row['user_firstname'],
                    "lastname" => $row['user_lastname'],
                    "city" => $row['user_city'],
                ];

                $_SESSION["user_token"] = $row['user_id'];
            } else {
                $results['status'] = 401;
                $results["message"] = "Incorrect password.";
            }
        } else {
            $results['status'] = 401;
            $results["message"] = "Please provide valid credentials.";
        }
    } catch (PDOException $exception) {
        $results["status"] = 401;
        $results['message'] = $exception->getMessage();
    }
} else {
    $results["status"] = 401;
    $results["message"] = "Please provide credentials.";
} ?>
<?= json_encode($results) ?>