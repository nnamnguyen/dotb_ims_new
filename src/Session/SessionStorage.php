<?php


namespace Dotbcrm\Dotbcrm\Session;

use Dotbcrm\Dotbcrm\Util\Arrays\TrackableArray\TrackableArray;
use Dotbcrm\Dotbcrm\Logger\LoggerTransition;


/**
 * Class SessionStorage
 *
 * Base SessionStorageImplementation.
 * Backed by php sessions but with the ability to force non-blocking writes.
 *
 * @package Dotbcrm\Dotbcrm\Session
 */

class SessionStorage extends TrackableArray implements SessionStorageInterface
{
    protected static $shutdownRegisterd = false;

    protected static $instance;

    /**
     * True if the php session has been closed for writing.
     * @var bool
     */
    protected $closed = false;

    /**
     * The last used session ID
     *
     * @var string
     */
    protected $lastId;

    /**
     * {@inheritdoc} Checks for custom SessionStorage classes or alternate SessionStorage classes set in config.
     */
    public static function getInstance() {
        $className = \DotbConfig::getInstance()->get(
            'SessionStorageClass',
            'Dotbcrm\Dotbcrm\Session\SessionStorage'
        );
        if (!static::$instance) {
            $class = \DotbAutoLoader::customClass($className);
            static::$instance = new $class();
        }

        return static::$instance;
    }

    /**
     * {@inheritdoc} starts a normal php session.
     */
    public function start($lock = false)
    {
        session_start();
        $this->populateFromArray($_SESSION);
        //keep session values
        $previousUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        $this->lastId = $this->getId();

        $_SESSION = $this;
        $this->enableTracking();

        if (!$lock) {
            $this->unlock();
        }
        $this->registerShutdownFunction($previousUserId);
    }

    /**
     * {@inheritdoc} destroy the current php session.
     */
    public function destroy() {
        if ($this->closed) {
            $this->restart();
        }
        session_destroy();
        $_SESSION = $this;

        $this->getIterator()->rewind();
        foreach($this as $key => $val) {
            $this->offsetUnset($key);
        }
        $this->modifiedKeys = array();
        $this->unsetKeys = array();
    }

    /**
     * {@inheritdoc} Sets the php session id
     */
    public function setId($id)
    {
        return session_id($id);
    }

    /**
     * {@inheritdoc} Returns the current php session id (if it exists).
     */
    public function getId()
    {
        return session_id();
    }

    public function unlock()
    {
        if (!$this->getId()) {
            return;
        }
        if (function_exists('session_status') && session_status() != PHP_SESSION_ACTIVE) {
            return;
        }
        session_write_close();
        $_SESSION = $this;
        $this->closed = true;
    }

    /**
     * Returns true if the current session exists and has an ID.
     * @return bool
     */
    public function sessionHasId()
    {
        $session_id = $this->getId();

        return !empty($session_id);
    }

    /**
     * Returns true if the current session is closed for writing.
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed;
    }

    /**
     * Restart the last used php session without producing side effects.
     */
    protected function restart()
    {
        if (!$this->lastId) {
            return;
        }

        $options = array(
            'session.use_cookies' => false,
            'session.cache_limiter' => null,
        );

        $backup = array();
        foreach ($options as $key => $value) {
            $backup[$key] = ini_set($key, $value);
        }

        session_id($this->lastId);
        session_start();

        foreach ($backup as $key => $value) {
            ini_set($key, $value);
        }
    }

    protected static function registerShutdownFunction($previousUserId)
    {
        if (!static::$shutdownRegisterd) {
            register_shutdown_function(function () use ($previousUserId) {
                $logger = new LoggerTransition(\LoggerManager::getLogger());
                //Now write out the session data again during shutdown
                $sessionObject = $_SESSION;
                if ($sessionObject instanceof SessionStorage) {
                    if (!$sessionObject->isClosed()) {
                        $_SESSION = $sessionObject->getArrayCopy();
                    } else {
                        // session_start() sends http headers such as 'Cache-Control' depending on php configs
                        // flush ob to send out these headers so they won't be overwritten
                        while (@ob_end_flush());
                        $sessionObject->restart();
                        //First verify that the sessions still match and we didn't somehow switch users.
                        if ((!isset($_SESSION['user_id']) && $previousUserId) ||
                            ($previousUserId && isset($_SESSION['user_id']) && $previousUserId != $_SESSION['user_id'])
                        ) {
                            $logger->warning('Unexpected change in user or logout during session write at shutdown');
                        } else {
                            $sessionObject->applyTrackedChangesToArray($_SESSION);
                        }
                    }
                } else {
                    if (is_array($sessionObject)) {
                        $klass = "array";
                    } else {
                        $klass = get_class($sessionObject);
                    }
                    $logger->debug('$_SESSION changed from TrackableArray object to ' . $klass);
                }
                session_write_close();
            });
            static::$shutdownRegisterd = true;
        }
    }
}
