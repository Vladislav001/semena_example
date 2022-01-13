<?
//Инфоблоки
define("IBLOCK_CATALOG", 6);
define("IBLOCK_FEEDBACK", 3);

const IMAGE_PARAMETERS = array(
	'advertising' => [
		'height' => '330',
		'width' => '225',
		'resize_type' => BX_RESIZE_IMAGE_EXACT
	],
	'catalog-section' => [
		'height' => '500',
		'width' => '500',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
	],
	'catalog-detail' => [
		'height' => '575',
		'width' => '575',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
    ],
	'catalog-swiper' => [
		'height' => '500',
		'width' => '500',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
	],
	'element-added2basket' => [
		'height' => '160',
		'width' => '160',
		'resize_type' => BX_RESIZE_IMAGE_EXACT
	],
	'element-search-title' => [
		'height' => '100',
		'width' => '100',
		'resize_type' => BX_RESIZE_IMAGE_EXACT
	],
	'blog-list' => [
		'height' => '500',
		'width' => '500',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
	],
	'blog-next-article' => [
		'height' => '100',
		'width' => '130',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
	],
	'blog-similar-article' => [
		'height' => '190',
		'width' => '190',
		'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL
	],
);