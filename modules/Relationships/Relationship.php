<?php



class Relationship extends DotbBean
{

    public $table_name = "relationships";
    public $object_name = "Relationship";

    public function __construct()
    {
        parent::__construct();
    }

    /*returns true if the relationship is self referencing. equality check is performed for both table and
     * key names.
     */
    function is_self_referencing()
    {
        if (empty($this->_self_referencing)) {
            $this->_self_referencing = false;

            //is it self referencing, both table and key name from lhs and rhs should  be equal.
            if ($this->lhs_table == $this->rhs_table && $this->lhs_key == $this->rhs_key) {
                $this->_self_referencing = true;
            }
        }

        return $this->_self_referencing;
    }

    /**
     * Returns true if a relationship with provided name exists
     *
     * @param string $relationship_name The name of the relationship to check
     *
     * @deprecated Please use DotbRelationshipFactory::relationshipExists
     *
     * @return boolean
     */
    function exists($relationship_name)
    {
        return DotbRelationshipFactory::getInstance()->relationshipExists($relationship_name);
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    function delete($relationship_name, &$db)
    {

    }


    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    function get_other_module($relationship_name, $base_module)
    {
        $rel = DotbRelationshipFactory::getInstance()->getRelationship($relationship_name);
        return $base_module == $rel->getLHSModule() ? $rel->getRHSModule() : $rel->getLHSModule();
    }


    /**
     * @deprecated Please DotbBean::load_relationship
     *
     * Retrieving by modules is impossible as multiple relationships may exist between the same two modules.
     * Plese interact only through 'link' fields on DotbBean objects
     *
     */
    public function retrieve_by_sides($lhs_module, $rhs_module, $db)
    {
        $srf = DotbRelationshipFactory::getInstance();
        $rels = $srf->getRelationshipsBetweenModules($lhs_module, $rhs_module);
        if (!empty($rels)) {
            foreach($rels as $name) {
                $def = $srf->getRelationshipDef($name);
                if ($def['lhs_module'] == $lhs_module && $def['rhs_module'] == $rhs_module) {
                    return $srf->getRelationshipDef($rels[0]);
                }
            }
        }
    }

    /**
     * @deprecated Please DotbBean::load_relationship
     *
     * Retrieving by modules is impossible as multiple relationships may exist between the same two modules.
     * Plese interact only through 'link' fields on DotbBean objects
     */
    public static function retrieve_by_modules($lhs_module, $rhs_module, $db, $type = '')
    {
        $srf = DotbRelationshipFactory::getInstance();
        $rels = $srf->getRelationshipsBetweenModules($lhs_module, $rhs_module);
        if (!empty($rels)) {
            return $rels[0];
        }
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    function retrieve_by_name($relationship_name)
    {
        return DotbRelationshipFactory::getInstance()->getRelationship($relationship_name);
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    function load_relationship_meta()
    {
        //Contructing the relationship factory will load all metadata.
        DotbRelationshipFactory::getInstance();
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    public static function cache_file_dir()
    {
        return null;
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    public static function cache_file_name_only()
    {
        return null;
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    public static function delete_cache()
    {
        DotbRelationshipFactory::deleteCache();
    }

    /**
     * @deprecated Please use DotbRelationshipFactory
     */
    function trace_relationship_module($base_module, $rel_module1_name, $rel_module2_name = "")
    {
        return null;
    }

    public function rebuild_relationship_cache()
    {
        DotbRelationshipFactory::rebuildCache();
    }

    /**
     * @see DotbBean::bean_implements
     *
     * @param string $interface
     *
     * @return bool
     */
    function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }

        return false;
    }

    protected function cache_exists() {
        return file_exists(Relationship::cache_file_dir() . '/' . Relationship::cache_file_name_only());
    }
}
