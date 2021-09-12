<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Api;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;


/**
 *
 * Elasticsearch index status
 *
 */
class ElasticsearchIndicesCommand extends Command implements InstanceModeInterface
{
    use ApiEndpointTrait;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('elastic:indices')
            ->setDescription('Show Elasticsearch index statistics')
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this
            ->initApi($this->getApi())
            ->callApi('elasticSearchIndices', array())
        ;

        $table = new Table($output);
        $table->setHeaders(array('Index', 'Docs', 'Size', 'Shards'));

        if ($result) {
            foreach ($result as $index => $status) {
                $docs = $status['indices'][$index]['total']['docs']['count'];
                $size = $status['indices'][$index]['total']['store']['size_in_bytes'];
                $shards = $status['_shards']['total'];
                $table->addRow(array($index, $docs, $size, $shards));
            }
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
