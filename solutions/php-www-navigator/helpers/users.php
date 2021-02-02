<?php

require "salter.php";

function userExists($data)
{
    $file = './data/users.csv';
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
    $file = './data/users.csv';
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
