<?PHP
include("./response.php");
require("./cors.php");
define("LOG_DIR", "../logs/");

$file = "./data/data.json";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $raw_data = file_get_contents('php://input');
    $postJson = json_decode($raw_data, false, 512, JSON_UNESCAPED_UNICODE);
    $solutions = json_decode(file_get_contents($file), false, 512, JSON_UNESCAPED_UNICODE);


    switch ($postJson->action) {
        case "incView":
            for ($i = 0; $i < count($solutions); ++$i) {
                if ($solutions[$i]->id == $postJson->id) {
                    $solutions[$i]->view++;
                    if (file_put_contents($file, json_encode($solutions, JSON_UNESCAPED_UNICODE), LOCK_EX)) {
                        die("{ 'status': 'success'}");
                    }
                }
            }
            break;
        case "incLike":
            for ($i = 0; $i < count($solutions); ++$i) {
                if ($solutions[$i]->id == $postJson->id) {
                    $solutions[$i]->likes++;
                    if (file_put_contents($file, json_encode($solutions, JSON_UNESCAPED_UNICODE), LOCK_EX)) {
                        die("success");
                    }
                }
            }
            break;
        case "decLike":
            for ($i = 0; $i < count($solutions); ++$i) {
                if ($solutions[$i]->id == $postJson->id) {
                    $solutions[$i]->likes--;
                    if (file_put_contents($file, json_encode($solutions, JSON_UNESCAPED_UNICODE), LOCK_EX)) {
                        die("success");
                    }
                }
            }
            break;
        case "postComment":
            for ($i = 0; $i < count($solutions); ++$i) {
                if ($solutions[$i]->id == $postJson->id) {
                    array_push($solutions[$i]->comments, $postJson->comment);
                    if (file_put_contents($file, json_encode($solutions, JSON_UNESCAPED_UNICODE), LOCK_EX)) {
                        die("success");
                    }
                }
            }
            break;
    }

    $solutions = json_decode(file_get_contents($file), false, 512, JSON_UNESCAPED_UNICODE);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $file = "./data/data.json";
    $solutions = json_decode(file_get_contents($file), false, 512, JSON_UNESCAPED_UNICODE);

    response($solutions);
}
