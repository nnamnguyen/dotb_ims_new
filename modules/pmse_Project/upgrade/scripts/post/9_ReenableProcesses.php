<?php


use Dotbcrm\Dotbcrm\ProcessManager\Registry;

class DotbUpgradeReenableProcesses extends UpgradeScript
{
    public $order = 9999;
    public $type = self::UPGRADE_CUSTOM;

    public function run()
    {
        $this->log('Reenabling processes at the end of the upgrade run');
        Registry\Registry::getInstance()->drop('upgrade:disable_processes');
    }
}
