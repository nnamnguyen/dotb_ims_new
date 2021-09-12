<?php




class ext_eapm_lotuslive extends source {
	protected $_enable_in_wizard = false;
	protected $_enable_in_hover = false;
	protected $_has_testing_enabled = false;

    // DEPRECATED in favor of IBM SmartCloud
    protected $_enable_in_admin_display = false;
    protected $_enable_in_admin_properties = false;

	public function getItem($args=array(), $module=null){}
	public function getList($args=array(), $module=null) {}
}
