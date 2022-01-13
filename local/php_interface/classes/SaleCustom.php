<?

use Bitrix\Sale\Location\LocationTable;

class SaleCustom
{
	function onSaleOrderBeforeSaved(\Bitrix\Main\Event $event)
	{
		$order = $event->getParameter("ENTITY");
		$paymentCollection = $order->getPaymentCollection();
		$deliveryList = $order->getDeliveryIdList();

		// при наложенном платеже изменить статус заказа
		$psCode = false;

		foreach ($paymentCollection as $payment)
		{
			$ps = $payment->getPaySystem();
			$psCode = $ps->getField('CODE');
			break;
		}

		if ($psCode == 'CASH_ON_DELIVERY_BOXBERRY' || $psCode == 'CASH_ON_DELIVERY_RUSSIAN_POST')
		{
			$order->setField('STATUS_ID', 'AS');
		}

		$arDeliveryData = \Bitrix\Sale\Delivery\Services\Table::getList(array(
			'filter' => array('ID' => $deliveryList[0]),
		))->fetch();

		// для Почты России и Курьерской доставки Boxberry -  сформировать кастомно Адрес доставки
		if ($arDeliveryData['XML_ID'] == 'POST_OFFICE' || $arDeliveryData['XML_ID'] == 'BOXBERRY_COURIER_DELIVERY')
		{
			$propertyCollection = $order->getPropertyCollection();
			$propertyArr = $propertyCollection->getArray();

			// получить данные по св-вам
			$propCodeData = array();

			foreach ($propertyArr['properties'] as $value)
			{
				$propCodeData[$value['CODE']] = array(
					'ID' => $value['ID'],
					'VALUE' => $value['VALUE']
				);
			}

			// получить город
			$arCityData = LocationTable::getList(array(
				'filter' => array(
					'=CODE' => $propCodeData['CITY']['VALUE'][0],
					'NAME.LANGUAGE_ID' => 'ru'
				),
				'limit' => 1,
				'select' => array(
					'*',
					'LNAME' => 'NAME.NAME'
				)
			))->fetch();

			// сформировать кастомно Адрес доставки
			$addressProp = $propertyCollection->getItemByOrderPropertyId($propCodeData['ADDRESS']['ID']);
			$addressVal = $arCityData['LNAME'] . '; ' . $propCodeData['ZIP']['VALUE'][0] . '; ' . $propCodeData['ADDRESS']['VALUE'][0] . '; ' . $propCodeData['HOUSE']['VALUE'][0] . '; ' . $propCodeData['APARTMENT']['VALUE'][0];
			$addressProp->setValue($addressVal);
		}
	}
}