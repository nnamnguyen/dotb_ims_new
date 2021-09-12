<?PHP


class OAuthTokensController extends DotbController
{
	protected function action_delete()
	{
	    global $current_user;
		//do any pre delete processing
		//if there is some custom logic for deletion.
		if(!empty($_REQUEST['record'])){
			if(!is_admin($current_user) && $this->bean->assigned_user_id != $current_user->id) {
                ACLController::displayNoAccess(true);
                dotb_cleanup(true);
			}
			$this->bean->mark_deleted($_REQUEST['record']);
        }else{
			dotb_die("A record number must be specified to delete");
		}
	}

	protected function post_delete()
	{
        if(!empty($_REQUEST['return_url'])){
            $_REQUEST['return_url'] =urldecode($_REQUEST['return_url']);
            $this->redirect_url = $_REQUEST['return_url'];
        } else {
            parent::post_delete();
        }
	}
}