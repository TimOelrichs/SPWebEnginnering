<?php
$file = '../common/data/users.csv';
require "salter.php";


function userExists($data)
{
    global $file;
    $lines = file($file);
    foreach ($lines as $line_num => $line) {
        list($user, $passwd) = explode(",", $line);
        if (salter($data['account']) == $user) {
            return true;
        }
    }
    return false;
}



function login($data)
{
    global $file;
    $lines = file($file);
    foreach ($lines as $line_num => $line) {
        list($user, $passwd) = explode(",", $line);
        if (salter($data['account']) == $user) {
            return salter($data['password'] === $passwd);
        }
    }
    return false;
}

function saveUser($data)
{
    return false;
}
