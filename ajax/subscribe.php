<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sender\Recipient;
use Bitrix\Main\Mail\Event;

Loader::includeModule("sender");

//* на основе /bitrix/components/bitrix/sender.subscribe/component.php

$email = $_POST['email'];

if (!$email)
{
	echo json_encode(array(
		'status' => 'error',
		'message' => 'Не указан e-mail'
	));
	return;
}

$mailingList = \Bitrix\Sender\Subscription::getMailingList(array("SITE_ID" => SITE_ID));
$mailingIdList = array();
foreach ($mailingList as $mailing)
{
	$mailingIdList[] = $mailing['ID'];
}

if (count($mailingIdList) > 0)
{
	$arExistedSubscription = array();
	$subscriptionDb = \Bitrix\Sender\MailingSubscriptionTable::getSubscriptionList(array(
		'select' => array('*'),
		'filter' => array(
			'=CONTACT.TYPE_ID' => Recipient\Type::EMAIL,
			'=CONTACT.CODE' => mb_strtolower($email),
			'!MAILING.ID' => null
		),
	));
//	if (($subscription = $subscriptionDb->fetch()))
//	{
//		echo json_encode(array(
//			'status' => 'error',
//			'message' => 'На указанный e-mail уже отправлено'
//		));
//		return;
//	}

	$emailSubs = \Bitrix\Sender\Subscription::add($email, $mailingIdList);

	Event::send(array(
		"EVENT_NAME" => "NEW_SUBSCRIBE",
		"LID" => SITE_ID,
		"C_FIELDS" => array(
			"EMAIL" => $email
		),
	));

	echo json_encode(array(
		'status' => 'success',
		'message' => 'Письмо отправлено'
	));
	return;
} else
{
	echo json_encode(array(
		'status' => 'success',
		'message' => 'В данный момент невозможно выполнить'
	));
	return;
}