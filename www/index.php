<?php
require 'vendor/autoload.php';
require 'modules/appSettings.inc.php';
require 'modules/JsonSettings.class.php';
require 'modules/actionsRedirector.php';

if (!$isAction) {
    require 'modules/Page.class.php';
    $page = new Page;
    $page->add("header");
    $page->add("camera");
    $page->add("controls");
    $page->add("footer", $page->js());
}
