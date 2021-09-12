<?php


/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */


class pmse_BpmRelatedDependency extends pmse_BpmRelatedDependency_dotb {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * @inheritDoc
	 */
	public function ACLAccess($view, $context = null)
	{
		switch ($view) {
			case 'list':
				if (is_array($context)
					&& isset($context['source'])
					&& $context['source'] === 'filter_api') {
					return false;
				}
				break;
			case 'edit':
			case 'view':
				if (is_array($context)
					&& isset($context['source'])
					&& $context['source'] === 'module_api') {
					return false;
				}
				break;
		}
		return parent::ACLAccess($view, $context);
	}

    /**
     * @inheritdoc
     */
    public function mark_deleted($id)
    {
        parent::mark_deleted($id);
        PMSEEngineUtils::resetActiveProcessesModulesCache();
    }

    /**
     * @inheritdoc
     */
    public function save($check_notify = false)
    {
        $result = parent::save($check_notify);
        PMSEEngineUtils::resetActiveProcessesModulesCache();
        return $result;
    }
}
