<?php


function sanitize($data)
{
    return trim(htmlspecialchars($_POST[$data]));
}


function required($data)
{
    if (empty($data)) {
        return true;
    }
    return false;
}

function email($data)
{
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function maxlength($data, $max)
{
    if (strlen($data) > $max) {
        return true;
    }
    return false;
}

function minlength($data, $min)
{
    if (strlen($data) < $min) {
        return true;
    }
    return false;
}
