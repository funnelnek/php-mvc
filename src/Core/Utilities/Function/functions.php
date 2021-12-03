<?php
$libs = glob(__DIR__ . "/**.php");
if (isset($libs)) {
    foreach ($libs as $file) {
        require_once $file;
    }
}
