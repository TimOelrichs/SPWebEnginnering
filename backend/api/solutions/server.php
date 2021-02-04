<?PHP
include("./response.php");
include("../../cors.php");
define("LOG_DIR", "../logs/");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $file = "./data/data.json";
    $solutions = json_decode(file_get_contents($file), false, 512, JSON_UNESCAPED_UNICODE);

    response($solutions);
}
