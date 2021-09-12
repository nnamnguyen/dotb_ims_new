<?php


class DotbACLOpi extends DotbACLStrategy
{
    protected static $syncingViews = array(
        'edit',
        'delete',
    );

    protected static $platformSourceMap = array(
        'base' => 'Dotb',
        'portal' => 'Dotb',
        'mobile' => 'Dotb',
        'opi' => 'Outlook',
        'lpi' => 'LotusNotes'
    );

    /**
     * Check recurring source to determine edit
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context)
    {
        $bean = self::loadBean($module, $context);

        // if there is no bean we have nothing to check
        if ($bean === false) {
            return true;
        }

        // if the recurring source is Dotb allow modifications
        if (in_array($view, self::$syncingViews)
            && !empty($bean->recurring_source)
            && !empty($bean->fetched_row['recurring_source'])
            && $bean->recurring_source == 'Dotb'
            && $bean->recurring_source == $bean->fetched_row['recurring_source']) {
            return true;
        }

        $view = DotbACLStrategy::fixUpActionName($view);

        if (in_array($view, self::$syncingViews)
            && isset($_SESSION['platform'])
            && isset(self::$platformSourceMap[$_SESSION['platform']])
            && !empty($bean->recurring_source) && !empty($bean->fetched_row['recurring_source'])
            && $bean->fetched_row['recurring_source'] != self::$platformSourceMap[$_SESSION['platform']]
            && $bean->recurring_source != self::$platformSourceMap[$_SESSION['platform']]) {
            return false;
        }

        return true;
    }

    /**
     * Load bean from context
     * @static
     * @param string $module
     * @param array $context
     * @return DotbBean
     */
    protected static function loadBean($module, $context = array())
    {
        if (isset($context['bean']) && $context['bean'] instanceof DotbBean
            && $context['bean']->module_dir == $module) {
            $bean = $context['bean'];
        } else {
            $bean = false;
        }
        return $bean;
    }

}
