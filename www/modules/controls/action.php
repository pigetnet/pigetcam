<?php


//var_dump($_GET);
$args = $_GET;
unset($args["controls"]);
//var_dump($args);

foreach ($args as $key => $arg) {
    if (file_exists(DIR.APP.$key.".json")) {
        $module = new JsonSettings(APP.$key);

        if ($module->settings) {
            if (property_exists($module->settings, $arg)) {
                $command = $module->settings->$arg;
                if (file_exists($command)) {
                    exec("sudo ".$command, $out, $err);

                    $out = str_replace("\"", "", $out);
                    $output["out"] = implode(" ", $out);
                    if ($err == 1) {
                        $output["out"] = "Permissions error";
                    }
                    $output["err"] = $err;
                } else {
                    $output["out"] = "$command not founded";
                    $output["err"] = 127;
                }
            } else {
                $output["out"] = "$arg not defined in ".DIR.APP.$key.".json";
                $output["err"] = 1;
            }
        }
    } else {
        $output["out"] = DIR.APP.$key.".json not founded";
    }
}

if (!isset($output)) {
    foreach ($args as $key => $arg) {
        $output["out"][] = "There is an error in ".DIR.APP.$key.".json";
    }
    $output["out"] = implode("\n", $output["out"]);
    $output["err"] = 127;
}

echo json_encode($output);
