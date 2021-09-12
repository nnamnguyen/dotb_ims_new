<?php


class DotbUpgradeDropFormActionCasDataFields extends UpgradeScript
{
    public $order = 2200;
    public $type = self::UPGRADE_DB;

    public function run()
    {
        // only run this when coming from a 7.6.x or 7.7.x upgrade
        if (!(version_compare($this->from_version, '7.6.0', ">=")
            && version_compare($this->from_version, '7.8.0.0RC1', "<"))
        ) {
            return;
        }

        $this->log('Droping `cas_pre_data` and `cas_data` columns from `pmse_bpm_form_action` table...');

        $query = $this->db->dropColumnSQL('pmse_bpm_form_action', array(
            array('name' => 'cas_pre_data'),
            array('name' => 'cas_data'),
        ));
        $this->log('Generated sql to drop columns: ' . $query);

        if ($this->db->query($query)) {
            $this->log('Columns were dropped');
        } else {
            $this->log('Failed to drop columns');
        }
    }
}
