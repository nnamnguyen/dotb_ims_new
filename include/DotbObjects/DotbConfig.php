<?php

/**
 * Config manager
 * @api
 */
class DotbConfig implements SplSubject
{
    public $_cached_values = array();

    /**
     * Observers of the configuration changes
     *
     * @var SplObjectStorage|SplObserver[]
     */
    private $observers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    static function getInstance() {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new DotbConfig();
        }
        return $instance;
    }

    function get($key, $default = null) {
        if (!isset($this->_cached_values[$key])) {
            $this->_cached_values[$key] = isset($GLOBALS['dotb_config']) ?
                DotbArray::staticGet($GLOBALS['dotb_config'], $key, $default) :
                $default;
        }
        return $this->_cached_values[$key];
    }

    function clearCache($key = null) {
        if (is_null($key)) {
            $this->_cached_values = array();
        } else {
            unset($this->_cached_values[$key]);
        }

        $this->notify();
    }

    /**
     * {@inheritDoc}
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * {@inheritDoc}
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * {@inheritDoc}
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
