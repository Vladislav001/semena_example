<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
Loader::includeModule('sale');

class ChooseGeo
{
    public static function setGeo($cityId)
	{
		$resLocations = CSaleLocation::GetList(array(
			"SORT" => "ASC"
		), array(
			"CITY_ID" => $cityId,
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

	public static function getGeo()
	{
		$selectedCityId = $_SESSION['USER_GEO_INFO']['CITY_ID'];
		$cities = [];

		$resLocations = CSaleLocation::GetList(array(
			"SORT" => "ASC",
			"CITY_NAME" => "ASC",
		), array(
			"COUNTRY_LID" => "ru",
			"REGION_LID" => "ru",
			"CITY_LID" => "ru",
			"!CITY_NAME" => false,
		), false, ["nTopCount" => 9999], array());

		while($arLocation = $resLocations->fetch())
		{
			$cities[$arLocation['COUNTRY_NAME']][] = $arLocation;
		}

		$result = array(
			'CURRENT_CITY_ID' => $selectedCityId,
			'CITIES' => $cities,
		);

		return $result;
	}
}

if (isset($_POST['city_id']) && intval($_POST['city_id']) > 0)
{
	ChooseGeo::setGeo($_POST['city_id']);
	echo json_encode(array('success' => 1));
} else
{
	$geoData = ChooseGeo::getGeo();
}
?>

<?if($geoData):?>
	<div class="geo-choose-block">
		<div class="h1">Введите название города</div>
		<input class="js_input_geo" type="text"
			   maxlength="255"
			   placeholder="Начните вводить название...">
		<div class="geo-choose-scroll">
			<?php
			foreach ($geoData['CITIES'] as $countryName => $countryCities):?>
				<b><?=$countryName?></b>
				<? foreach ($countryCities as $cityInfo):?>
					<div class="<?= ($cityInfo['CITY_ID'] == $geoData['CURRENT_CITY_ID']) ? " selected" : ""; ?>"
                         data-name="<?= mb_strtolower ($cityInfo['CITY_NAME']) ?>">
						<span class="js_select_geo geo-item" data-id="<?= $cityInfo['CITY_ID'] ?>"><?= $cityInfo['CITY_NAME'] ?></span>
					</div>
				<? endforeach; ?>
			<? endforeach; ?>
		</div>
	</div>
	<style>
        .geo-choose-block{width:400px}
        .geo-choose-block input{
            display: block;
            width: 100%;
            height: 30px;
            border-radius: 5px;
            border: 1px solid #d0d0d0;
            -webkit-box-shadow: inset 0px 0px 4px 1px #d0d0d0;
            box-shadow: inset 0px 0px 4px 1px #d0d0d0;
            padding: 0px 15px;
            font-size: 14px;
            margin-bottom:20px;
        }
        .geo-choose-scroll{width:100%;max-height:100px;overflow-y:scroll;    cursor: pointer;}
        .hidden {
            display: none;
        }
        .geo-item{
            padding:5px 0;
            display:block;
            font-size:12px;
        }
	</style>
<?endif;?>
