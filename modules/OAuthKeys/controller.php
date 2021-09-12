<?PHP


class OAuthKeysController extends DotbController
{
	public function process() {
		if(!is_admin($GLOBALS['current_user'])) {
			$this->hasAccess = false;
		}
		parent::process();
	}
}