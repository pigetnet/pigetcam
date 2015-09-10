<?php
$server = "localhost"; // camera server address
$port = 8080; // camera server port
$url = "/?action=stream"; // image url on server
set_time_limit(0);
$fp = fsockopen($server, $port, $errno, $errstr, 30);
@ini_set('implicit_flush', 1);
if (!$fp) {
        echo "$errstr ($errno)<br>\n";   // error handling
} else {
        header("Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0");
        header("Cache-Control: private");
        header("Pragma: no-cache");
        header("Expires: -1");
        header("Content-type: multipart/x-mixed-replace;");
        $urlstring = "GET ".$url." HTTP/1.0\r\n\r\n";
        fputs ($fp, $urlstring);
        while ($str = trim(fgets($fp, 4096)))
        header($str);
        fpassthru($fp);
        fclose($fp);
}
