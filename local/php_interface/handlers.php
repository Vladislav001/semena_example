<?

use Bitrix\Main\Loader;
use Bitrix\Iblock\PropertyTable;

include "classes/BlogCustom.php";
include "classes/SaleCustom.php";
include "classes/CSendOrderPass.php";

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('blog', 'OnBeforeCommentAdd', ['BlogCustom','OnBeforeCommentAdd']);
$eventManager->addEventHandler('sale', 'OnSaleOrderBeforeSaved', ['SaleCustom','OnSaleOrderBeforeSaved']);

$eventManager->addEventHandler('main', 'OnBeforeUserAdd', array('CSendOrderPass', 'OnBeforeUserAddHandler'));
