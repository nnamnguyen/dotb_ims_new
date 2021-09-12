<?php



/**
 * Stub class, exists only to allow Link class easily use the DotbEmailAddress class
 */
class EmailAddress extends DotbEmailAddress
{
	var $disable_row_level_security = true;

    /**
     * Called by DuplicateCheck api to remove email_addr_bean_rel records created in the process
     * @param string $id
     * @param string $module
     */
    public function deleteLinks($id, $module)
    {
        // Need to correct this to handle the Employee/User split
        $module = $this->getCorrectedModule($module);
        $query = "update email_addr_bean_rel set deleted = 1 WHERE bean_id = '".$this->db->quote($id)."' AND bean_module = '".$this->db->quote($module)."'";
        $this->db->query($query);
    }
}
