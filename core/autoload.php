<?php
/**
 * @param $classname
 * @throws Exception
 */
function __autoload( $classname ) {
    $filename = ROOT_DIR.str_replace('\\', '/', $classname).".php";
    include_once($filename);
}

