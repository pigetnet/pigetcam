<?php
#$camurl="http://127.0.0.1:8080/?action=snapshot";
$camurl="http://192.168.0.79/media/?action=snapshot";
if (file_exists("../appSettings.inc.php")) {
    include_once '../appSettings.inc.php';
    include_once '../JsonSettings.class.php';
}

function grab_image($url) {
    //header('Content-type: image/jpeg');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $conf_file = "camera/password";
    //echo DIR.$conf_file.".json";
    if (file_exists(DIR.$conf_file.".json")) {
        $credentials_json = new JsonSettings($conf_file);
        if ($credentials_json->settings) {
           //var_dump($credentials_json);
            if (property_exists($credentials_json->settings, "c")) {
                $userpassword = $credentials_json->settings->c;
            }
        }
    }
    if (isset($userpassword)) {
        curl_setopt($ch, CURLOPT_USERPWD, $userpassword);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    }
    $raw=curl_exec($ch);
    echo $raw;
    //echo curl_error($ch);
    curl_close($ch);
}
grab_image($camurl);
