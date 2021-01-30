<?PHP

session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
    $file = '../data/data.json';
    $contents = file_get_contents($file);
    $json = json_decode($contents, false, 512, JSON_UNESCAPED_UNICODE);
    die($json);
}
