<?php



use Doctrine\DBAL\DriverManager as DoctrineDriverManager;
use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Log\LoggerInterface;
use Dotbcrm\Dotbcrm\Dbal\Connection;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Dotbcrm\Dotbcrm\Logger\Factory as LoggerFactory;

/**
 * Database driver factory
 * @api
 * Instantiates and configures appropriate DB drivers
 */
class DBManagerFactory
{
    /**
     * @var DBManager[]
     */
    static $instances = array();

    /** @var SQLLogger instance of Doctrine Dbal logger class */
    protected static $dbalLogger;

    /**
     * Returns a reference to the DB object of specific type
     *
     * @param  string $type DB type
     * @param array $config DB configuration
     * @return DBManager
     */
    public static function getTypeInstance($type, $config = array())
    {
        if(empty($config['db_manager'])) {
            $my_db_manager = self::getManagerByType($type, false);

            if (!$my_db_manager) {
                display_stack_trace();
                static::getLogger()->alert("unable to load DB manager for: $type");
                dotb_die("Cannot load DB manager");
            }
        } else {
            $my_db_manager = $config['db_manager'];
        }

        // sanitize the name
        $my_db_manager = preg_replace("/[^A-Za-z0-9_-]/", "", $my_db_manager);

        if(!empty($config['db_manager_class'])){
            $my_db_manager = $config['db_manager_class'];
        } else {
            DotbAutoLoader::requireWithCustom("include/database/{$my_db_manager}.php");
        }

        if(class_exists($my_db_manager)) {
            return static::createInstance($my_db_manager);
        } else {
            return null;
        }
    }

    /**
	 * Returns a reference to the DB object for instance $instanceName, or the default
     * instance if one is not specified
     *
     * @param  string $instanceName optional, name of the instance
     * @return DBManager Database instance
     */
	public static function getInstance($instanceName = '')
    {
        global $dotb_config;
        static $count = 0, $old_count = 0;
        if(empty($dotb_config['dbconfig'])) {
            return false;
        }
        //fall back to the default instance name
        if(empty($dotb_config['db'][$instanceName])){
        	$instanceName = '';
        }
        if(!isset(self::$instances[$instanceName])){
            $config = $dotb_config['dbconfig'];
            $count++;
            if(!empty($instanceName)){
                $config = $dotb_config['db'][$instanceName];
                //trace the parent dbs until we get a real db
                $parentInstanceName = '';
                while(!empty($config['parent_db'])){
                    if(empty($dotb_config['db'][$config['parent_db']])){
                        $config = $dotb_config['dbconfig'];
                        $parentInstanceName = '';
                        break;
                    }
                    else{
                        $parentInstanceName = $config['parent_db'];
                        $config = $dotb_config['db'][$config['parent_db']];
                    }
                }
            }


            if(!empty($parentInstanceName) && !empty(self::$instances[$parentInstanceName])){
                self::$instances[$instanceName] = self::$instances[$parentInstanceName];
                $old_count++;
                self::$instances[$parentInstanceName]->references = $old_count;
                self::$instances[$parentInstanceName]->children[] = $instanceName;
            }
            else{
                self::$instances[$instanceName] = self::getTypeInstance($config['db_type'], $config);
                if(!empty($dotb_config['dbconfigoption'])) {
                    self::$instances[$instanceName]->setOptions($dotb_config['dbconfigoption']);
                }
                self::$instances[$instanceName]->connect($config, true);
                self::$instances[$instanceName]->count_id = $count;
                self::$instances[$instanceName]->references = 0;
                if (empty($instanceName) && empty($GLOBALS['db'])) {
                    $GLOBALS['db'] = self::$instances[$instanceName];
                }
                if (empty($instanceName) && !empty($GLOBALS['system_config']) && $GLOBALS['system_config'] instanceof Administration && empty($GLOBALS['system_config']->db)) {
                    $GLOBALS['system_config']->db = self::$instances[$instanceName];
                }
            }
        } else {
            $old_count++;
            self::$instances[$instanceName]->references = $old_count;
        }
        return self::$instances[$instanceName];
    }

    /**
     * Returns Doctrine connection for the given database instance
     *
     * @param string $instanceName Name of the instance
     * @return \Dotbcrm\Dotbcrm\Dbal\Connection
     */
    public static function getConnection($instanceName = '')
    {
        return self::getInstance($instanceName)->getConnection();
    }

    /**
     * Creates Doctrine connection for the given database instance
     *
     * @param DBManager $instance Database instance
     * @return Doctrine\DBAL\Connection
     * @throws Exception
     * @throws Doctrine\DBAL\DBALException
     */
    public static function createConnection(DBManager $instance)
    {
        static $driverMap = array(
            'mysqli' => 'Dotbcrm\Dotbcrm\Dbal\Mysqli\Driver',
            'sqlsrv' => 'Dotbcrm\Dotbcrm\Dbal\SqlSrv\Driver',
            'oci8' => 'Dotbcrm\Dotbcrm\Dbal\Oci8\Driver',
            'ibm_db2' => 'Dotbcrm\Dotbcrm\Dbal\IbmDb2\Driver',
        );

        if (!isset($driverMap[$instance->variant])) {
            throw new Exception('Unsupported DB driver ' . $instance->variant);
        }

        $params = array(
            'wrapperClass' => Connection::class,
            'driverClass' => $driverMap[$instance->variant],
            'connection' => $instance->getDatabase(),
        );

        // we only need the to fix case on Oracle and IBM DB2, and we do not on SQL Server,
        // as its built-in stored procedures produce upper-cased keys which SqlSrvManager expects and can handle
        if ($instance->variant === 'oci8' || $instance->variant === 'ibm_db2') {
            $params = array_merge($params, array(
                'portability' => Connection::PORTABILITY_FIX_CASE,
                'fetch_case' => PDO::CASE_LOWER,
            ));
        }

        $conn = DoctrineDriverManager::getConnection($params);

        $logger = self::getDbalLogger();
        $conn->getConfiguration()->setSQLLogger($logger);

        return $conn;
    }

    private static function getLogger() : LoggerInterface
    {
        return LoggerFactory::getLogger('db');
    }

    /**
     * Get DbalLogger instance
     *
     * @return SQLLogger
     */
    public static function getDbalLogger()
    {
        if (!self::$dbalLogger) {
            self::$dbalLogger = Container::getInstance()->get(SQLLogger::class);
        }

        return self::$dbalLogger;
    }

    /**
     * Set Dbal logger instance for DBManagerFactory class
     *
     * @param SQLLogger $logger
     */
    public static function setDbalLogger(SQLLogger $logger)
    {
        self::$dbalLogger = $logger;
    }


    /**
     * Disconnect all DB connections in the system
     */
    public static function disconnectAll()
    {
        foreach(self::$instances as $instance) {
            $instance->disconnect();
        }
        self::$instances = array();
        BeanFactory::clearCache();
        $GLOBALS['db'] = null;
        if (!empty($GLOBALS['system_config']) && $GLOBALS['system_config'] instanceof Administration) {
            $GLOBALS['system_config']->db = null;
        }
    }


    /**
     * Get DB manager class name by type name
     *
     * For use in install
     * @param string $type
     * @param bool $validate Return only valid drivers or any?
     * @return string
     */
    public static function getManagerByType($type, $validate = true)
    {
        $drivers = self::getDbDrivers($validate);
        if(!empty($drivers[$type])) {
            return get_class($drivers[$type]);
        }
        return false;
    }

    /**
     * Scan directory for valid DB drivers
     * @param string $dir
     * @param array $drivers
     * @param bool $validate Return only valid drivers or all of them?
     */
    protected static function scanDriverDir($dir, &$drivers, $validate = true)
    {
        if(!is_dir($dir)) return;
        $scandir = opendir($dir);
        if($scandir === false) return;
        while(($name = readdir($scandir)) !== false) {
            if(substr($name, -11) != "Manager.php") continue;
            if($name == "DBManager.php") continue;
            require_once("$dir/$name");
            $classname = substr($name, 0, -4);
            if(!class_exists($classname)) continue;
            $re = new ReflectionClass($classname);
            if ($re->isAbstract()) {
                continue;
            }
            $driver = static::createInstance($classname);
            if(!$validate || $driver->valid()) {
                if(empty($drivers[$driver->dbType])) {
                    $drivers[$driver->dbType]  = array();
                }
                $drivers[$driver->dbType][] = $driver;
            }
        }

    }

    /**
     * Compares two drivers by priority
     * @internal
     * @param object $a
     * @param object $b
     * @return int
     */
    public static function _compareDrivers($a, $b)
    {
        return $b->priority - $a->priority;
    }

    /**
     * Get list of all available DB drivers
     * @param bool $validate Return only valid drivers or all of them?
     * @return array List of Db drivers, key - variant (mysql, mysqli), value - driver type (mysql, mssql)
     */
    public static function getDbDrivers($validate = true)
    {
        $drivers = array();
        self::scanDriverDir("include/database", $drivers, $validate);
        self::scanDriverDir("custom/include/database", $drivers, $validate);

        $result = array();
        foreach($drivers as $type => $tdrivers) {
            if(empty($tdrivers)) continue;
            if(count($tdrivers) > 1) {
                usort($tdrivers, array(__CLASS__, "_compareDrivers"));
            }
            $result[$type] = $tdrivers[0];
        }
        return $result;
    }

    /**
     * Creates instance of database manager of the given class
     *
     * @param string $class
     * @return DBManager
     */
    private static function createInstance(string $class) : DBManager
    {
        /** @var DBManager $instance */
        $instance = new $class();

        $instance->setLogger(
            self::getLogger()
        );

        return $instance;
    }
}
