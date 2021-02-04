<?PHP

session_start();

$file = '../data/data.json';

function getAllData()
{
    $file = '../data/data.json';
    $contents = file_get_contents($file);
    $json = json_decode($contents, false, 512, JSON_UNESCAPED_UNICODE);
    return $json;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die(getAllData());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    $raw_data = file_get_contents('php://input');
    if (file_put_contents($file, json_encode($raw_data, JSON_UNESCAPED_UNICODE), LOCK_EX)) {
        die("success");
    }
};
