<?php



/**
 * Imports a record of encrypted file.
 *
 * This class extends the class ADAMImporter to import
 * records to an encrypted file BPMRuleSet table.
 * @package PMSE
 * @codeCoverageIgnore
 */
class PMSEBusinessRuleImporter extends PMSEImporter
{

    public function __construct()
    {
        $this->bean = BeanFactory::newBean('pmse_Business_Rules'); //new BpmRuleSet();
        $this->name = 'name';
        $this->id = 'rst_id';
        $this->suffix = 'rst_';
        $this->extension = 'pbr';
        $this->module = 'rst_module';
    }
}
