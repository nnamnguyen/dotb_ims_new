<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Elasticsearch;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic;
use Dotbcrm\Dotbcrm\SearchEngine\AdminSettings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;
use MetaDataManager;

/**
 *
 * Enable/disable module for global search
 *
 */
class ModuleCommand extends Command implements InstanceModeInterface
{
    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('search:module')
            ->setDescription('Enable/disable given module for search')
            ->addArgument(
                'module',
                InputArgument::REQUIRED,
                'Module name (i.e. Accounts)',
                null
            )
            ->addArgument(
                'action',
                InputArgument::REQUIRED,
                'enable or disable',
                null
            )
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $engine = SearchEngine::getInstance()->getEngine();

        if (!$engine instanceof Elastic) {
            throw new RuntimeException("Backend search engine is not Elastic");
        }

        $module = $input->getArgument('module');
        $action = $input->getArgument('action');

        if (!in_array($action, array('enable', 'disable'), true)) {
            throw new RuntimeException("Please specify a proper action: 'enable' or 'disable'");
        }

        $settings = new AdminSettings();
        list($enabled, $disabled) = $settings->getModules();

        if ($action === 'enable') {
            if (!in_array($module, $disabled)) {
                throw new RuntimeException("Module $module cannot be enabled");
            }
            $key =  array_search($module, $disabled);
            unset($disabled[$key]);
            $enabled[] = $module;
        } else {
            if (!in_array($module, $enabled)) {
                throw new RuntimeException("Module $module cannot be disabled");
            }
            $key =  array_search($module, $enabled);
            unset($enabled[$key]);
            $disabled[] = $module;
        }

        $settings->saveFTSModuleListSettings($enabled, $disabled);
        MetaDataManager::refreshSectionCache(array(MetaDataManager::MM_SERVERINFO, MetaDataManager::MM_MODULES));
    }
}
