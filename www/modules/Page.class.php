<?php
class Page
{
    private $jsFiles = [];

    public function __construct()
    {

    }

    public function add($file, $variables = false)
    {
        $php_file = "modules/$file/$file.php";
        $js_file = "modules/$file/$file.js";
        if (file_exists($php_file)) {
            include($php_file);
        } else {
            var_dump($php_file." not founded");
        }
        if (file_exists($js_file)) {
            $this->jsFiles[] = $js_file;
            #var_dump($this->jsFiles);
        } else {
            #var_dump($js_file." not founded");
        }
    }

    public function js()
    {
        return $this->jsFiles;
    }
}
