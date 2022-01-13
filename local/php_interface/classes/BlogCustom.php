<?

class BlogCustom
{
	function OnBeforeCommentAdd(&$arFields)
	{
		$arFields['PUBLISH_STATUS'] = BLOG_PUBLISH_STATUS_READY;
	}
}