<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Api;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;


/**
 *
 * Elasticsearch routing status
 *
 */
class ElasticsearchRoutingCommand extends Command implements InstanceModeInterface
{
    use ApiEndpointTrait;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('elastic:routing')
            ->setDescription('Show Elasticsearch index routing')
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this
            ->initApi($this->getApi())
            ->callApi('elasticSearchRouting')
        ;

        $table = new Table($output);
        $table->setHeaders(array('Module', 'Strategy', 'Write index', 'Read indices'));

        foreach ($result as $module => $entry) {
            $table->addRow(array(
                $module,
                $entry['strategy'],
                $entry['routing']['write_index'],
                implode(',', $entry['routing']['read_indices']),
            ));
        }

        $table->render();
    }

    /**
     * @return \AdministrationApi
     */
    protected function getApi()
    {
        return new \AdministrationApi();
    }
}
