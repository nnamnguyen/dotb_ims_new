<?php


class DotbModule
{
    protected static $_instances = array();

    protected $_moduleName;

    public static function get(
        $moduleName
        )
    {
        if ( !isset(self::$_instances[$moduleName]) )
            self::$_instances[$moduleName] = new DotbModule($moduleName);

        return self::$_instances[$moduleName];
    }

    public function __construct(
        $moduleName
        )
    {
        $this->_moduleName = $moduleName;
    }

    /**
     * Returns true if the given module implements the indicated template
     *
     * @param  string $template
     * @return bool
     */
    public function moduleImplements(
        $template
        )
    {
        $focus = self::loadBean();

        if ( !$focus )
            return false;

        return is_a($focus,$template);
    }

    /**
     * Returns the bean object of the given module
     *
     * @return object
     */
    public function loadBean($beanList = null, $beanFiles = null, $returnObject = true)
    {
        return BeanFactory::newBean($this->_moduleName);
    }
}
