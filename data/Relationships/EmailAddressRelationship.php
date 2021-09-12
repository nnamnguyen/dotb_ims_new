<?php


/**
 * Represents a many to many relationship that is table based.
 * @api
 */
class EmailAddressRelationship extends M2MRelationship
{
    /**
     * For Email Addresses, there is only a link from the left side, so we need a new add function that ignores rhs
     * @param  $lhs DotbBean left side bean to add to the relationship.
     * @param  $rhs DotbBean right side bean to add to the relationship.
     * @param  $additionalFields key=>value pairs of fields to save on the relationship
     * @return boolean true if successful
     */
    public function add($lhs, $rhs, $additionalFields = array())
    {
        $lhsLinkName = $this->lhsLink;

        if (empty($lhs->$lhsLinkName) && !$lhs->load_relationship($lhsLinkName))
        {
            $lhsClass = get_class($lhs);
            $GLOBALS['log']->fatal("could not load LHS $lhsLinkName in $lhsClass");
            return false;
        }

        if ((empty($_SESSION['disable_workflow']) || $_SESSION['disable_workflow'] != "Yes"))
        {
            $lhs->$lhsLinkName->resetLoaded();
            $this->callBeforeAdd($lhs, $rhs, $lhsLinkName);
        }

        //Many to many has no additional logic, so just add a new row to the table and notify the beans.
        $dataToInsert = $this->getRowToInsert($lhs, $rhs, $additionalFields);

        $this->addRow($dataToInsert);
        $this->addSelfReferencing($lhs, $rhs, $additionalFields);

        if ((empty($_SESSION['disable_workflow']) || $_SESSION['disable_workflow'] != "Yes"))
        {
            $lhs->$lhsLinkName->resetLoaded();
            $this->callAfterAdd($lhs, $rhs, $lhsLinkName);
        }

        return true;
    }

    public function remove($lhs, $rhs)
    {
        $lhsLinkName = $this->lhsLink;

        if (!($lhs instanceof DotbBean)) {
            $GLOBALS['log']->fatal("LHS is not a DotbBean object");
            return false;
        }
        if (!($rhs instanceof DotbBean)) {
            $GLOBALS['log']->fatal("RHS is not a DotbBean object");
            return false;
        }
        if (empty($lhs->$lhsLinkName) && !$lhs->load_relationship($lhsLinkName))
        {
            $GLOBALS['log']->fatal("could not load LHS $lhsLinkName");
            return false;
        }

        if (empty($_SESSION['disable_workflow']) || $_SESSION['disable_workflow'] != "Yes")
        {
            if (!empty($lhs->$lhsLinkName))
            {
                $lhs->$lhsLinkName->load();
                $this->callBeforeDelete($lhs, $rhs, $lhsLinkName);
            }
        }

        $dataToRemove = array(
            $this->def['join_key_lhs'] => $lhs->id,
            $this->def['join_key_rhs'] => $rhs->id
        );

        $this->removeRow($dataToRemove);

        if ($this->self_referencing) {
            $this->removeSelfReferencing($lhs, $rhs);
        }

        if (empty($_SESSION['disable_workflow']) || $_SESSION['disable_workflow'] != "Yes")
        {
            if (!empty($lhs->$lhsLinkName))
            {
                $lhs->$lhsLinkName->load();
                $this->callAfterDelete($lhs, $rhs, $lhsLinkName);
            }
        }

        return true;
    }
}
