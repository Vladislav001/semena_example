<?
if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/constants.php"))
{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/constants.php");
}

if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/functions.php"))
{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/functions.php");
}

if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/handlers.php"))
{
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/handlers.php");
}