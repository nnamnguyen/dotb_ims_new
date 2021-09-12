<?php


class DotbWidgetFieldImage extends DotbWidgetFieldVarchar
{

	function displayListPlain($layout_def) {
		$value = $this->_get_list_value($layout_def);
		return "<a href=\"javascript:DOTB.image.lightbox('index.php?entryPoint=download&id=$value&type=DotbFieldImage&isTempFile=1')\">"
		       . translate("LBL_VIEW_IMAGE") . '</a>';
	}
}