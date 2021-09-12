<?php


/**
 * Represents a relationship where part of the data is substituted by the current_user_id
 * @api
 */
class UserBasedRelationship extends One2MRelationship
{
    public $type = "user-based";
    
    public function __construct($def)
    {
        $this->userField = $def['user_field'];
        
        parent::__construct($def);
    }

    protected function buildDotbQueryRoleWhere($dotb_query, $table = "", $ignore_role_filter = false)
    {
        $dotb_query = parent::buildDotbQueryRoleWhere($dotb_query, $table, $ignore_role_filter);
        
        $dotb_query->join[$table]->on()->equals($table.'.'.$this->userField,$GLOBALS['current_user']->id);

        return $dotb_query;
    }

    /**
     * Don't delete existing relationships.
     * {@inheritdoc}
     */
    public function add($lhs, $rhs, $additionalFields = array())
    {
        $success = true;

        // Add relationship
        if (M2MRelationship::add($lhs, $rhs, $additionalFields) === false) {
            $success = false;
            LoggerManager::getLogger()->error("Warning: failed calling M2MRelationship::add() for relationship".
                " {$this->name} within UserBasedRelationship->add().");
        }

        return $success;
    }
}
