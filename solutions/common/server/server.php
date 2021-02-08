<?PHP

require "../util/content.php";
require "cors.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die(json_encode(getAllData(), JSON_UNESCAPED_UNICODE));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION["login"]) && $_SESSION["login"] == 1) {

    $raw_data = file_get_contents('php://input');
    $postJson = json_decode($raw_data, false, 512, JSON_UNESCAPED_UNICODE);

    switch ($postJson->action) {
        case "publish":
            if (publishData($postJson->data)) {
                die("success");
            }
            break;
    }
};
