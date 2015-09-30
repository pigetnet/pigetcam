<?php

class JsonSettings
{
    public $settings = false;
    
    public function __construct($file = false)
    {

        if ($file) {
            $this->settings = $this->fileToJson(DIR.$file.".json");
        } else {
            foreach (glob(DIR.APP."*.json") as $file) {
                $json = $this->fileToJson($file);
                //var_dump($json);
                if ($json) {
                    $this->settings[basename($file, ".json")] = $json;
                }
            }
        }

    }

    private static function fileToJson($file)
    {
        if (file_exists($file)) {
            $json_raw = file_get_contents($file);
            $setting = json_decode($json_raw);
            $setting->file = basename($file, ".json");
            return $setting;
        } else {
            return false;
        }
    }
}
