<?php



class CategoriesApiHelper extends DotbBeanApiHelper
{
    /**
     * {@inheritdoc}
     */
    public function formatForApi(DotbBean $bean, array $fieldList = array(), array $options = array())
    {
        $action = (!empty($options['action']) && $options['action'] == 'list') ? 'list' : 'view';
        $hasAccess = empty($bean->deleted) && $bean->ACLAccess($action);
        $data = parent::formatForApi($bean, $fieldList, $options);
        if (!$hasAccess) {
            if ($this->api->action == 'view') {
                $data['name'] = $bean->name;
                $data['_acl'] = $this->getBeanAcl($bean, $fieldList);
            }
        }
        return $data;
    }
}
