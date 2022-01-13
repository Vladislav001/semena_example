<?
/**
 * Запись лога в файл
 *
 * @param $data
 * @param string $file
 */
function logToFile($data, $file = '__bx_log.log')
{
	$tempFile = fopen($_SERVER['DOCUMENT_ROOT'] . '/log/' . $file, 'a');
	fwrite($tempFile, _FILE_ . ':' . _LINE_ . PHP_EOL . '(' . date('Y-m-d H:i:s') . ')' . PHP_EOL . print_r($data, TRUE) . PHP_EOL . PHP_EOL);
	fclose($tempFile);
}
/**
 * Вернуть преобразованную цену
 *
 * @param $price
 * @return string
 */
function getPrice($price)
{
	$price = number_format($price, 2, '.', ' ');
	$priceExplode = explode('.', $price);

	if ($priceExplode[1] == '00')
	{
		return $priceExplode[0];
	} else
	{
		return $price;
	}
}

/**
 * Функция для определения по переданной цифре варианта окончания слова для русского языка.
 * examples
 *   declOfNum(1, ["день", "дня", "дней"]); - 1 день
 *   declOfNum(1, ["день", "дня", "дней"]); - 2 дня
 *   declOfNum(1, ["день", "дня", "дней"]); - 5 дней
 *
 * @param {integer} $number цифра к которой будет подбираться заголовок
 * @param {array[string]} $titles массив заголовок подбираемые к цифре
 *
 * @return string
 */
function declOfNum($number, $titles)
{
	$cases = [2, 0, 1, 1, 1, 2];
	return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[($number % 10 < 5) ? $number % 10 : 5]];
}

/**
 * Получить строку между строк
 * @param $string
 * @param $start
 * @param $end
 * @return false|string
 */
function getStringBetween($string, $start, $end)
{
	$string = ' ' . $string;
	$ini = strpos($string, $start);
	if ($ini == 0) return '';
	$ini += strlen($start);
	$len = strpos($string, $end, $ini) - $ini;
	return substr($string, $ini, $len);
}

/**
 * Вся информация о городе и стране (если используется база SxGeo Country)
 * @return array
 */
function getGeoInfoByIp()
{
	include($_SERVER['DOCUMENT_ROOT'] . "/local/app/classes/SxGeo.php");
	$SxGeo = new SxGeo($_SERVER['DOCUMENT_ROOT'] . '/local/app/classes/SxGeoCity.dat');

	$client = $_SERVER['HTTP_CLIENT_IP'];
	$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	else
	{
		if (filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
	}

	$geoInfo = $SxGeo->getCityFull($ip);
	$result = is_array($geoInfo) && !empty($geoInfo) ? $geoInfo : [];

	return $result;
}

/**
 * Установить в $_SESSION geo-инфу о юзере
 */
function setCityByGeoInfo()
{
	if (!$_SESSION['USER_GEO_INFO']['CITY_ID'])
	{
		$geoInfo = getGeoInfoByIp();

		// т.к город может иметь одинаковое название, то подятнем страну, регион
		$resLocations = CSaleLocation::GetList(array(
			"SORT" => "ASC"
		), array(
			"COUNTRY_SHORT_NAME" => $geoInfo['country']['iso'],
			"REGION_NAME" => $geoInfo['region']['name_ru'],
			"CITY_NAME" => $geoInfo['city']['name_ru'],
			"COUNTRY_LID" => "ru",
			"REGION_LID" => "ru",
			"CITY_LID" => "ru",
		), false, ["nTopCount" => 1], array());

		$cityInfoDb = $resLocations->Fetch();

		$_SESSION['USER_GEO_INFO'] = array(
			'CITY_ID' => $cityInfoDb['CITY_ID'],
			'CITY_NAME' => $cityInfoDb['CITY_NAME'],
			'REGION_ID' => $cityInfoDb['REGION_ID'],
			'REGION_NAME' => $cityInfoDb['REGION_NAME'],
			'COUNTRY_ID' => $cityInfoDb['COUNTRY_ID'],
			'COUNTRY_NAME' => $cityInfoDb['COUNTRY_NAME'],
		);
	}
}