<?PHP

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/fte_UsageTracking/fte_UsageTracking_dotb.php');
class fte_UsageTracking extends fte_UsageTracking_dotb {

    public $config;

    public function __construct()
    {
        parent::__construct();
        $this->getConfig();
    }

    protected function getConfig(){
        $adminBean = BeanFactory::newBean("Administration");
        $this->config = $adminBean->getConfigForModule($this->module_name);
    }

    public function save($check_notify = false) {

        global $current_user;

        if(in_array($current_user->id, $this->config['non_tracked_users_ids'])){
            return;
        }

        if(!$this->config['tracking_enabled']){
            return;
        }

        $this->name = $this->action . " " . $GLOBALS['app_list_strings']['moduleListSingular'][$this->parent_type];
        $this->related_module_name = $this->parent_name ?? "";

        parent::save($check_notify);
    }
}