<?PHP

/**
 * finish php script and send message to client
 * in AJAX calls e.g. fetch requests
 * e.g. JSONP requests
 * @param $msg message
 */

function response($msg)
{
    // encode message to JSON
    $msg = json_encode($msg, JSON_UNESCAPED_UNICODE);
    // filter received dynamic function name (jsonp)
    $callback = filter_input(INPUT_GET, 'callback', FILTER_SANITIZE_STRING);
    // is cross domain request?
    if (isset($callback)) {
        // padding message in function call (jsonp)
        $msg = $callback . '(' . $msg . ');';
    }
    // send message to client
    die($msg);
}
