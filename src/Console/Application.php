<?php


namespace Dotbcrm\Dotbcrm\Console;

use Dotbcrm\Dotbcrm\Console\Command\Elasticsearch\ExplainCommand;
use Dotbcrm\Dotbcrm\Console\Command\Elasticsearch\SilentReindexMultiProcessCommand;
use Dotbcrm\Dotbcrm\Console\Command\Password\PasswordConfigCommand;
use Dotbcrm\Dotbcrm\Console\Command\Password\PasswordResetCommand;
use Dotbcrm\Dotbcrm\Console\Command\Password\WeakHashesCommand;
use Dotbcrm\Dotbcrm\Console\CommandRegistry\CommandRegistry;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchIndicesCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchQueueCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchRoutingCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchRefreshStatusCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchRefreshEnableCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchRefreshTriggerCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchReplicasStatusCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\ElasticsearchReplicasEnableCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\SearchFieldsCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\SearchReindexCommand;
use Dotbcrm\Dotbcrm\Console\Command\Api\SearchStatusCommand;
use Dotbcrm\Dotbcrm\Console\Command\Elasticsearch\CleanupQueueCommand;
use Dotbcrm\Dotbcrm\Console\Command\Elasticsearch\ModuleCommand;
use Dotbcrm\Dotbcrm\Console\Command\Elasticsearch\SilentReindexCommand;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Console\RebuildCommand;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Console\StatusCommand;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 *
 * Console application invoked using `bin/dotbcrm`
 *
 * The command line framework is primarily aimed at exposing administrative and
 * developer functionality to the platform on an installed DotBCRM instance.
 * However this framework also supports command execution without having an
 * installed DotBCRM instance. See the CommandRegistry for more details on the
 * different modes and interfaces which can be used.
 *
 * Do not extend existing stock commands if you want to customize a command.
 * The stock commands may be rearranged at any given time. It is also advised
 * to keep the amount of logic to the bare minimum and put your logic into a
 * different place. This will make your command more portable. Commands are
 * meant as CLI wrappers around existing functionality.
 *
 */
class Application extends BaseApplication
{
    /**
     * Execution mode
     * @see CommandRegistry
     * @var string
     */
    protected $mode = '';

    /**
     * Ctor
     */
    public function __construct()
    {
        parent::__construct('DotBCRM Console', $this->getDotbVersion());
    }

    /**
     * Factory to create core console application
     * @param string $mode
     * @return Application
     */
    public static function create($mode)
    {
        $container = Container::getInstance();

        $registry = CommandRegistry::getInstance();

        $registry->addCommands(array(
            // Elasticsearch specific
            new ElasticsearchIndicesCommand(),
            new ElasticsearchQueueCommand(),
            new ElasticsearchRoutingCommand(),
            new ExplainCommand(),
            new ElasticsearchRefreshStatusCommand(),
            new ElasticsearchRefreshEnableCommand(),
            new ElasticsearchRefreshTriggerCommand(),
            new ElasticsearchReplicasStatusCommand(),
            new ElasticsearchReplicasEnableCommand(),
            new CleanupQueueCommand(),
            new ModuleCommand(),
            new SilentReindexCommand(),
            new SilentReindexMultiProcessCommand(),

            // Genreric Search
            new SearchFieldsCommand(),
            new SearchReindexCommand(),
            new SearchStatusCommand(),

            // Password management
            new WeakHashesCommand(),
            new PasswordConfigCommand(),
            new PasswordResetCommand(),

            //Team Security
            new RebuildCommand(),
            new StatusCommand(),
        ));

        $app = new Application();
        $app->setMode($mode);
        $app->addCommands($registry->getCommands($mode));

        return $app;
    }

    /**
     * Set execution mode
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get execution mode
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultInputDefinition()
    {
        $definition = parent::getDefaultInputDefinition();

        // add --profile option
        $definition->addOption(new InputOption(
            '--profile',
            null,
            InputOption::VALUE_NONE,
            'Display timing and memory usage information'
        ));

        return $definition;
    }

    /**
     * {@inheritDoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        if ($input->hasParameterOption('--profile')) {
            $startTime = microtime(true);
        }

        $result = parent::doRun($input, $output);

        if (isset($startTime)) {
            $output->writeln(sprintf(
                PHP_EOL . 'Memory usage: %s MB (peak: %s MB), time: %ss',
                round(memory_get_usage() / 1024 / 1024, 2),
                round(memory_get_peak_usage() / 1024 / 1024, 2),
                round(microtime(true) - $startTime, 3)
            ));
        }

        return $result;
    }

    /**
     * Get dotb version
     * @return string
     */
    protected function getDotbVersion()
    {
        $default = "[standalone mode]";
        $dotbVersionFile = DOTB_BASE_DIR . '/dotb_version.php';
        if (file_exists($dotbVersionFile)) {
            include $dotbVersionFile;

            // sanity checks returning default
            if (empty($dotb_version) ||
                empty($dotb_flavor)  ||
                empty($dotb_build)   ||
                strpos($dotb_version, '6.5.22') === 0
            ) {
                return $default;
            }

            return "{$dotb_version}-{$dotb_flavor}-{$dotb_build}";
        }
        return $default;
    }
}
