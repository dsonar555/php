<?php

$browser = get_browser(null,true);
// print_r($browser);
$browser = strtolower($browser['browser']);

if($browser == 'chrome') {
    echo 'You are using google chrome.<br>';
} else if($browser == 'firefox') {
    echo 'You are using Mozilla Firefox.<br>';
} else if($browser == 'edge') {
    echo 'You are using Internet Explorer.<br>';
}

?>