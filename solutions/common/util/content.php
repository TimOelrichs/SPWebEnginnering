<?PHP
$file = dirname(__FILE__) . '/../data/data.json';
$preViewfile = dirname(__FILE__) . '/data/preview.json';

function getAllData()
{
    global $file;
    $contents = file_get_contents($file);
    $json = json_decode($contents, false);
    return $json;
}

function getPreviewData()
{
    global $preViewfile;
    $contents = file_get_contents($preViewfile);
    $json = json_decode($contents, false);
    return $json;
}

function publishData($data)
{
    global $file;
    return file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function savePreviewData($data)
{
    global $preViewfile;
    return file_put_contents($preViewfile, json_encode($data, JSON_UNESCAPED_UNICODE), LOCK_EX);
}
