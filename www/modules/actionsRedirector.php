<?php
$isAction = false;
$args = $_GET;
//var_dump($args);
if (count($args) > 0) {
    $action = array_keys($args)[0];

    if ($args[$action] == "") {
        $action_file = "modules/$action/action.php";
        if (file_exists($action_file)) {
            $isAction = true;
            include($action_file);
        } else {
            var_dump($action_file." not founded");
        }
    } else {
        $action_file = "modules/$action/$args[$action].php";
        if (file_exists($action_file)) {
            $isAction = true;
            include($action_file);
        } else {
            var_dump($action_file." not founded");
        }
    }
}
