<?php
date_default_timezone_set('Asia/Hong_Kong');
spl_autoload_register('myAutoLoad');
function myAutoLoad($ClassName){
    require_once(dirname(__FILE__)."/../services/".$ClassName.".php");
}
