<?php


/**
 * ACL Visiblity driven by a related module.
 * Only supports DotbQuery
 */
class ParentModuleVisibility extends ACLVisibility
{

    protected $parentLink = "";
    /**
     * @param DotbBean $bean
     */
    public function __construct($bean, $options)
    {
        if (!empty($options['parentLink'])) {
            $this->parentLink = $options['parentLink'];
        }

        return parent::__construct($bean);
    }

    /**
     * Add visibility clauses to the FROM part of the query
     *
     * @param string $query
     *
     * @return string
     */
    public function addVisibilityFromQuery(DotbQuery $query)
    {
        if (!empty($this->parentLink))
        {
            $linkName = $this->parentLink;
            $query->from->load_relationship($linkName);
            if(empty($query->from->$linkName)) {
                throw new DotbApiExceptionInvalidParameter("Invalid link $linkName for owner clause");
            }
            if($query->from->$linkName->getType() == "many") {
                throw new DotbApiExceptionInvalidParameter("Cannot serch for owners through multi-link $linkName");
            }
            $this->join = $query->join($linkName, array('joinType' => 'LEFT'));
        }

        return $query;
    }
}
