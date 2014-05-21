<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 26/04/14
 * Time: 20:23
 */
require_once "textConverter.php";
$obj = new textConverter();

$handle = @fopen('myTexts.txt','r');
$myV = $obj->readTextFile($handle);
echo $myV;