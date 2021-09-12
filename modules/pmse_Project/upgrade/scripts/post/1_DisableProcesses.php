<?php


use Dotbcrm\Dotbcrm\ProcessManager\Registry;

class DotbUpgradeDisableProcesses extends UpgradeScript
{
    public $order = 1000;
    public $type = self::UPGRADE_CUSTOM;

    public function run()
    {
        $this->log('Disabling processes for upgrade run');
        Registry\Registry::getInstance()->set('upgrade:disable_processes', true);
    }
}
