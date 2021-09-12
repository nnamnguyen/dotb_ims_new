<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Api;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;


/**
 *
 * Elasticsearch queue status
 *
 */
class ElasticsearchQueueCommand extends Command implements InstanceModeInterface
{
    use ApiEndpointTrait;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('elastic:queue')
            ->setDescription('Show Elasticsearch queue statistics')
        ;
    }

    /**
     * {inheritdoc}
     *
     * Return codes:
     * 0 = queue is empty
     * 1 = queue is not empty
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this
            ->initApi($this->getApi())
            ->callApi('elasticSearchQueue', array())
        ;

        $table = new Table($output);
        $table->setHeaders(array('Module', 'Count'));

        if (isset($result['queued'])) {
            foreach ($result['queued'] as $module => $count) {
                $table->addRow(array($module, $count));
            }
            $table->addRow(new TableSeparator());
        }

        $total = isset($result['total']) ? $result['total'] : 0;
        $table->addRow(array('Total', $total));
        $table->render();

        return $total > 0 ? 1 : 0;
    }

    /**
     * @return \AdministrationApi
     */
    protected function getApi()
    {
        return new \AdministrationApi();
    }
}
