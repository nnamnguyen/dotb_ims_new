<?php


class DotbUpgradeDropUnusedPmseTables extends UpgradeScript
{
    public $order = 2200;
    public $type = self::UPGRADE_DB;

    /**
     * List of tables to be removed on upgrade
     * @var array
     */
    protected $tablesToDrop = [
        // ABS-754
        'pmse_bpm_case_data',
        // ICE-83
        'pmse_bpm_access_management',
    ];

    public function run()
    {
        // Upgrades to 7.9+ should always drop these tables... loop and drop
        foreach ($this->tablesToDrop as $table) {
            // If the table exists, drop it
            if ($this->db->tableExists($table)) {
                // Set a log message
                $m = "Attempting to drop `$table` table: ";

                // Try to drop the table now
                $m .= $this->db->dropTableName($table) ? 'Table was dropped' : 'Failed to drop table';
            } else {
                // Nothing to do, log it as such
                $m = "Table `$table` does not exist on this instance... skipping drop";
            }

            // Handle logging
            $this->log($m);
        }
    }
}
