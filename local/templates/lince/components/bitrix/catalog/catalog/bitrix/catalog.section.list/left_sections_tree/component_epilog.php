<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$currentUrl = $APPLICATION->GetCurPage(false);
$currentUrl = explode('filter/', $currentUrl);
$currentUrl = $currentUrl[0];
$currentSection = $arResult['SECTIONS_DATA'][$currentUrl];

$parentSections = getAllParentSectionIDs($arResult['SECTIONS_DATA'], $currentSection);
$parentSections = tree2array($parentSections);
$branchUrls[] = $currentUrl;

foreach ($parentSections as $section)
{
	$branchUrls[] = $section['SECTION_PAGE_URL'];
}

$branchUrlsJson = json_encode($branchUrls);

// найти все родительские
function getAllParentSectionIDs($sections, $childSection)
{
	$result = array();

	foreach ($sections as $key => $section)
	{
		if ($childSection['IBLOCK_SECTION_ID'] == $section['ID'])
		{
			// удаляем этот элемент из общего массива
			unset($sections[$key]);

			$childSection = $section;

			$result[$section['ID']] = array(
				'ID' => $section['ID'],
				'SECTION_PAGE_URL' => $section['SECTION_PAGE_URL'],
				'PARENT' => getAllParentSectionIDs($sections, $childSection)
			);
		}
	}

	return $result;
}

// развернуть дерево
function tree2array($tree)
{
	$result = array();

	if (is_array($tree))
	{
		foreach ($tree as $key => $node)
		{
			array_push($result, [
				'SECTION_PAGE_URL' => $node['SECTION_PAGE_URL']
			]);

			if (isset($node['PARENT']))
			{
				$result = array_merge($result, tree2array($node['PARENT']));
			}
		}
	}

	return $result;
}
?>

<script>
    $(document).ready(function ()
    {
        $('.catalog-section__block').prev().addClass('arrow');

        let branchUrls = <?=$branchUrlsJson?>;

        $('.catalog-section__link').each(function ()
        {
            let href = $(this).attr('href');

            if (branchUrls.includes(href))
            {
                $(this).closest('.catalog-section__item.arrow').next('.catalog-section__block').slideToggle();
                $(this).next().toggleClass('_active');
                $(this).addClass('_bold');
            }
        });
    });
</script>
