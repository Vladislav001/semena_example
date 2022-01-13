<?
use Bitrix\Main\Mail\Event;

class CSendOrderPass {

	private static $newUserLogin = false;
	private static $newUserPass = false;

	public static function OnBeforeUserAddHandler($arFields) {
		$event = Event::send(array(
			"EVENT_NAME" => "NEW_USER_REGISTER",
			"LID" => "s1",
			"C_FIELDS" => array(
				"EMAIL" => $arFields['EMAIL'],
				"NAME" => $arFields['NAME'],
				"LAST_NAME" => $arFields['LAST_NAME'],
				"PERSONAL_PHONE" => $arFields['PERSONAL_PHONE'],
				"LOGIN" => $arFields['LOGIN'],
				"PASSWORD" => $arFields['PASSWORD'],
			),
		));
	}
}