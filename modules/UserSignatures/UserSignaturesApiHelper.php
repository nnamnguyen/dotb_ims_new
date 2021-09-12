<?php


class UserSignaturesApiHelper extends DotbBeanApiHelper
{
    /**
     * {@inheritdoc}
     *
     * Adds the is_default flag based on user preference
     *
     * @param DotbBean $bean
     * @param array $fieldList
     * @param array $options
     * @return array
     */
    public function formatForApi(DotbBean $bean, array $fieldList = array(), array $options = array())
    {
        global $current_user;

        $data = parent::formatForApi($bean, $fieldList, $options);
        $defaultSignature = $current_user->getPreference('signature_default');
        $data['is_default'] = ($bean->id === $defaultSignature);
        return $data;
    }
}
