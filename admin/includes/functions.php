<?php

function classAutoLoader($class)
{
    $the_path = "includes/{$class}.php";
    if (is_file($the_path) && !class_exists($class)) {
        include_once $the_path;
    } else {
        die("The file name {$class}.php was not found.");
    }
}

spl_autoload_register('classAutoLoader');

function redirect($location)
{
    header("Location: {$location}");
}

//恒等関数(identity function)
//文字列中の静的プロパティ、関数などの式展開に使用
$i = function ($param) {
    return $param;
};
